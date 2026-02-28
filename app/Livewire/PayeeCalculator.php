<?php

namespace App\Livewire;

use App\Models\NSSFPSSF;
use App\Models\PayeeRanges;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PayeeCalculator extends Component
{
    // Salary inputs
    public $baseSalary       = 0;
    public $allowances       = 0;
    public $taxableIncome    = 0;

    // Deduction amounts (actual values)
    public $nssfAmount       = 0;
    public $psssfAmount      = 0;
    public $taxDeduction     = 0;
    public $netSalary        = 0;

    //HESLB
    public $heslbDeduction   = 0;
    public $heslbEnabled     = false;

    // Internal state (must be public in Livewire to persist between updates)
    public $PayeeRules      = [];
    public $taxContribution = [];

    public function mount(): void
    {
        $this->calculateHESLBDeduction();
        $this->loadPayeeRules();
        $this->taxContribution = $this->loadNSSFPSSF();
        $this->calculateNetSalary();
        $this->emitPayeeCalculation();
    }

    /**
     * Load NSSF/PSSSF config for the school (called once in mount)
     */
    private function loadNSSFPSSF(): array
    {
        $user = Auth::user();
        $school_id = $user?->school_id
            ?? $user?->teachers?->first()?->school_id
            ?? 1;

        $config = NSSFPSSF::where('school_id', $school_id)->first();

        if (!$config) {
            return ['nssfContribution' => 0.1, 'psssfContribution' => 0];
        }

        return match($config->contribution_type) {
            'nssf'  => ['nssfContribution' => $config->nssf_contribution,  'psssfContribution' => 0],
            'psssf' => ['nssfContribution' => 0, 'psssfContribution' => $config->psssf_contribution],
            default => ['nssfContribution' => 0, 'psssfContribution' => 0],
        };
    }

    /**
     * Load PAYE brackets from DB (called once in mount)
     */
    private function loadPayeeRules(): void
    {
        $this->PayeeRules = PayeeRanges::whereYear('effective_year', '>=', now()->subYear()->year)
            ->orderBy('lower_bound', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * Gross = base salary + allowances
     */
    private function calculateGrossSalary(): float
    {
        return (float) $this->baseSalary + (float) $this->allowances;
    }

    /**
     * HESLB = Gross - 15% of gross
     * HEskb percentage is fixed at 15% as per HESLB guidelines
     */
    private function calculateHESLBDeduction(): float
    {
        $gross = $this->calculateGrossSalary();
        if (!$this->heslbEnabled) {
            return (float) $this->heslbDeduction = 0;
        }

        return (float) $this->heslbDeduction = $gross * 0.15;
    }

    /**
     * Taxable income = gross - NSSF or PSSSF employee contribution
     * Contributions are already decimals e.g 0.1 = 10%
     */
    private function calculateTaxableIncome(): float
    {
        if (empty($this->taxContribution)) {
            $this->taxContribution = $this->loadNSSFPSSF();
        }

        $gross = $this->calculateGrossSalary();

        $this->nssfAmount  = $gross * ($this->taxContribution['nssfContribution']  ?? 0);
        $this->psssfAmount = $gross * ($this->taxContribution['psssfContribution'] ?? 0);

        return $this->taxableIncome = $gross - $this->nssfAmount - $this->psssfAmount;
    }

    /**
     * Calculate PAYE from taxable income using bracket rules
     */
    private function calculatePaye(): void
    {
        if (empty($this->PayeeRules)) {
            $this->loadPayeeRules();
        }

        $this->taxableIncome = $this->calculateTaxableIncome();

        if (empty($this->PayeeRules)) {
            $this->taxDeduction = 0;
            return;
        }

        foreach ($this->PayeeRules as $rule) {
            $withinLower = $this->taxableIncome >= $rule['lower_bound'];
            $withinUpper = $rule['upper_bound'] === null || $this->taxableIncome <= $rule['upper_bound'];

            if ($withinLower && $withinUpper) {
                $this->taxDeduction = $rule['added_amount'] + (($this->taxableIncome - $rule['lower_bound']) * $rule['percentage']);
                break;
            }
        }

        $this->taxDeduction = $this->taxDeduction ?? 0;
    }

    /**
     * Net salary = gross - NSSF/PSSSF amount - PAYE
     */
    private function calculateNetSalary(): void
    {
        $this->calculateHESLBDeduction();
        $this->calculatePaye();

        $gross           = $this->calculateGrossSalary();
        $totalDeductions = $this->taxDeduction + $this->nssfAmount + $this->psssfAmount + $this->heslbDeduction;

        $this->netSalary = max(0, $gross - $totalDeductions);
    }

    private function emitPayeeCalculation(): void
    {
        $this->dispatch('payee-calculated',
            taxDeduction: $this->taxDeduction,
            netSalary: $this->netSalary,
            nssfAmount: $this->nssfAmount,
            psssfAmount: $this->psssfAmount,
            taxableIncome: $this->taxableIncome,
            heslbDeduction: $this->heslbDeduction
        );
    }

    #[\Livewire\Attributes\On('update:baseSalary')]
    public function updatedBaseSalary($value): void
    {
        $this->baseSalary = $value;
        $this->calculateNetSalary();
        $this->emitPayeeCalculation();
    }

    #[\Livewire\Attributes\On('update:allowances')]
    public function updatedAllowances($value): void
    {
        $this->allowances = $value;
        $this->calculateNetSalary();
        $this->emitPayeeCalculation();
    }

    #[\Livewire\Attributes\On('update:heslbEnabled')]
    public function updatedHeslbEnabled($value): void
    {
        $this->heslbEnabled = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $this->calculateNetSalary();
        $this->emitPayeeCalculation();
    }

    public function render()
    {
        return view('livewire.payee-calculator');
    }
}

