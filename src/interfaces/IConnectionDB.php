<?php

declare(strict_types=1);

namespace EcoNote\src\interfaces;

use PDO;

interface IConnectionDB
{
    public function getConnection() : PDO;
}