<?php

namespace CodeEduBook\Repositories;


use CodeEduBook\Models\Chapter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class ChapterRepositoryEloquent extends BaseRepository implements ChapterRepository
{


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chapter::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
