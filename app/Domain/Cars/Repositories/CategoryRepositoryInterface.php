<?php
namespace App\Domain\Cars\Repositories;

use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function getAllCached(): Collection;
}
