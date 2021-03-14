<?php

use App\Repositories\Contracts\BasketRepositoryContract;

if (!function_exists('int_to_decimal')) {
    function int_to_decimal(int $number): string
    {
        return number_format(($number / 100), 2);
    }
}
if (!function_exists('basket')) {

    function basket() //do not use auto complete live as is.
    {

        return app(BasketRepositoryContract::class);
    }
}
