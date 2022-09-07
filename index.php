<?php
declare(strict_types=1);

namespace EcoNote;

use EcoNote\src\Router;
use EcoNote\src\Utils;

require_once __DIR__ . '/src/autoLoad.php';
require_once __DIR__ . '/src/main_error_handler.php';
//TODO Logs with error

Utils::error_show(false);

(new Router($_GET, $_POST))->start();