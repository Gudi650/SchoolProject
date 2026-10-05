<?php

if (! function_exists('money_format_app')) {
    function money_format_app(float|int|string|null $amount, ?int $decimals = null): string
    {
        $symbol = config('currency.symbol', 'Tsh');
        $decimals ??= (int) config('currency.decimals', 0);

        return $symbol . ' ' . number_format((float) ($amount ?? 0), $decimals);
    }
}
