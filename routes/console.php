<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Set distinct batch numbers for specific migrations
Artisan::command('set:migration-batches', function () {
    $migrations = [
        '2026_01_20_022420_create_allowances_table' => 5,
        '2026_01_20_022445_create_deductions_table' => 6,
        '2026_01_22_004008_create_employees_table' => 7,
        '2026_01_22_050000_create_payroll_configurations_table' => 8,
        '2026_01_22_173006_create_budgets_table' => 9,
        '2026_01_22_174434_create_budget_categories_table' => 10,
        '2026_01_23_214122_create_budget_departments_table' => 11,
    ];

    $updated = 0;
    foreach ($migrations as $name => $batch) {
        $affected = DB::table('migrations')
            ->where('migration', $name)
            ->update(['batch' => $batch]);
        $updated += $affected;
        $this->info("Migration '{$name}' set to batch {$batch} (rows affected: {$affected})");
    }

    if ($updated === 0) {
        $this->warn('No matching migration rows were updated. Verify names in migrations table.');
    } else {
        $this->info('Done. You can verify with `php artisan migrate:status`.');
    }
})->purpose('Assign distinct batch numbers to selected migrations');
