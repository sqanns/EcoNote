<?php

declare(strict_types=1);

namespace EcoNote\src;

class Utils
{
    static function error_show(bool $displayAllErrors): void
    {
        if ($displayAllErrors) {
            error_reporting(E_ALL);
            ini_set('display_error', '1');
            return;
        }

        error_reporting(0);
        ini_set('display_error', '0');
    }

    static function removeQuote(string $quoteString): string
    {
        return stripslashes(substr($quoteString, 1, -1));
    }
}
