<?php

namespace CodeEduBook\Repositories;

use CodePub\Repositories\CriteriaTrashedInterface;
use CodePub\Repositories\RepositoryRestoreInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BookRepository
 * @package namespace CodePub\Repositories;
 */
interface BookRepository extends RepositoryInterface,
    RepositoryCriteriaInterface, CriteriaTrashedInterface, RepositoryRestoreInterface
{
    //
}
