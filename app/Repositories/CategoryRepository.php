<?php

namespace CodePub\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodePub\Repositories;
 */
interface CategoryRepository extends RepositoryInterface, CriteriaTrashedInterface
{
    public function listsWithMutators($column, $key = null);
}
