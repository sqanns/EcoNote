<?php
declare(strict_types=1);

namespace EcoNote\src;

Utils::error_show(false);

class View
{
    static function render(string $page = "ExploreNote", ViewParams $params = null): void
    {
        include_once "templates/MainLayout.php";
    }
}