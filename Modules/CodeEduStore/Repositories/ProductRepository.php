<?php

namespace CodeEduStore\Repositories;


use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface ProductRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function home();
    public function findByCategory($categoryId);
    public function findBySlug($slug);
    public function like($search);
}