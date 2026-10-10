<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceCategory extends Model
{
    protected $fillable = ['school_id', 'name'];

    public static function remember(int $schoolId, ?string $name): ?string
    {
        $name = trim((string) $name);
        if ($name === '') {
            return null;
        }

        static::firstOrCreate(['school_id' => $schoolId, 'name' => $name]);

        return $name;
    }

    public static function namesFor(int $schoolId)
    {
        return static::where('school_id', $schoolId)->orderBy('name')->pluck('name')
            ->merge(Vendor::where('school_id', $schoolId)->whereNotNull('category')->pluck('category'))
            ->merge(Expense::where('school_id', $schoolId)->pluck('category'))
            ->map(fn ($n) => trim((string) $n))
            ->filter()
            ->unique()
            ->sort()
            ->values();
    }
}
