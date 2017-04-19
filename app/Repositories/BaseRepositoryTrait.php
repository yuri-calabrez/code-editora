<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 17/04/2017
 * Time: 22:55
 */

namespace CodePub\Repositories;


trait BaseRepositoryTrait
{
    public function lists($column, $key = null)
    {
        $this->applyCriteria();
        return $this->model->pluck($column, $key);
    }
}