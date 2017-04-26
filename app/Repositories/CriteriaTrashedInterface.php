<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21/04/2017
 * Time: 18:04
 */

namespace CodePub\Repositories;


interface CriteriaTrashedInterface
{
    public function onlyTrashed();

    public function withTrashed();
}