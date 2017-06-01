<?php

namespace CodeEduUser\Repositories;

use CodeEduUser\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    public function update(array $attributes, $id)
    {
       $model = parent::update($attributes, $id);
       if(isset($attributes['permissions'])) {
           $model->permissions()->sync($attributes['permissions']);
       }

       return $model;
    }

    public function updatePermission(array $data, $id)
    {
        $role = $this->find($id);

        $role->permissions()->detach();

        if(count($data)) {
            $role->permissions()->sync($data);
        }

        return $role;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
