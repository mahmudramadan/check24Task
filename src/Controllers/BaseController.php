<?php
declare(strict_types=1);

namespace App\Controllers;

class BaseController
{
    public function view(string $filePath,array $data)
    {
        require __DIR__ . "/../../src/views/main_layout.php";
    }
}