<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 13/06/2017
 * Time: 23:09
 */

namespace CodeEduBook\Criteria;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByBook implements CriteriaInterface
{
    private $bookId;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }


    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('book_id', $this->bookId);
    }
}