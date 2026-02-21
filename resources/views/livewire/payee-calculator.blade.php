<div class="space-y-4">
    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
        <h6 class="font-semibold text-slate-900 text-sm">PAYE Calculator</h6>
        <p class="text-xs text-slate-600 mt-1">Auto-calculated using PAYE brackets and NSSF/PSSSF configuration.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-200 rounded-lg p-3">
            <p class="text-xs text-slate-500">NSSF Amount</p>
            <p class="text-lg font-semibold text-slate-900 mt-1">${{ number_format($nssfAmount, 2) }}</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-lg p-3">
            <p class="text-xs text-slate-500">PSSSF Amount</p>
            <p class="text-lg font-semibold text-slate-900 mt-1">${{ number_format($psssfAmount, 2) }}</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-lg p-3">
            <p class="text-xs text-slate-500">Taxable Income</p>
            <p class="text-lg font-semibold text-slate-900 mt-1">${{ number_format($taxableIncome, 2) }}</p>
        </div>
    </div>

    <!-- Calculated Tax Display -->
    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
        <div class="flex justify-between items-center">
            <div>
                <h6 class="font-semibold text-slate-900 text-sm">Auto-Calculated Tax</h6>
                <p class="text-xs text-slate-600 mt-1">Based on salary bracket rules from database</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-amber-600">${{ number_format($taxDeduction, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Net Salary Display -->
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
        <div class="flex justify-between items-center">
            <div>
                <h6 class="font-semibold text-slate-900 text-sm">Net Salary</h6>
                <p class="text-xs text-slate-600 mt-1">Base + Allowances - Tax</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-indigo-600">${{ number_format($netSalary, 2) }}</p>
            </div>
        </div>
    </div>

    <input type="hidden" id="livewire_tax_deduction" value="{{ $taxDeduction }}">
    <input type="hidden" id="livewire_net_salary" value="{{ $netSalary }}">
    <input type="hidden" id="livewire_nssf_amount" value="{{ $nssfAmount }}">
    <input type="hidden" id="livewire_psssf_amount" value="{{ $psssfAmount }}">
</div>
