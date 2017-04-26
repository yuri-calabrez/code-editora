<?php

namespace CodePub\Repositories;

use CodePub\Criteria\CriteriaTrashedTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Models\Category;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use BaseRepositoryTrait;
    use CriteriaTrashedTrait;

    protected $fieldSearchable = [
        'name' => 'like'
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function listsWithMutators($column, $key = null)
    {
        $collection = $this->all();
        return $collection->pluck($column, $key);
    }
}
