<?php

declare(strict_types=1);

set_error_handler(function () {
    header('Location: /econote/500_problems.php');
    exit();
});

set_exception_handler(function () {
    header('Location: /econote/500_problems.php');
    exit();
});