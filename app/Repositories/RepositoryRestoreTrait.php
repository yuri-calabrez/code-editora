<?php

namespace CodePub\Repositories;


trait RepositoryRestoreTrait
{
    public function restore($id)
    {
        $this->applyScope();

        $_skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        $model->restore();
    }
}