<?php
declare(strict_types=1);

namespace App\Interfaces;

interface ResourcesInterface{
    public function add();
    public function edit();
    public function update();
    public function delete(array $params);
}