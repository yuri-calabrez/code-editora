<?php

namespace CodeEduBook\Repositories;

use CodePub\Criteria\CriteriaTrashedTrait;
use CodePub\Repositories\RepositoryRestoreTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Models\Book;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'title' => 'like',
        'author.name',
        'categories.name' => 'like'
    ];

    public function create(array $attributes)
    {

        $model = null;
        $create = function() use ($attributes, &$model){
            $model = parent::create($attributes);
        };
        $create = \Closure::bind($create, $this);
        if(!isset($attributes['published'])) {
            Book::withoutSyncingToSearch($create);
        } else {
            $create();
        }
        $model->categories()->sync($attributes['categories']);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = $this->find($id);
        if($model->published && empty($attributes['published'])) {
            $model->unsearchable();
        }
        $model = parent::update($attributes, $id);
        $model->categories()->sync($attributes['categories']);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
