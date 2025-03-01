<?php

namespace App\Interfaces\V1;

interface ProductRepositoryInterface
{
    public function index();
    public function findById(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);

}
