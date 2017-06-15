<?php

namespace CodeEduBook\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $roleAuthor = \CodeEduUser\Models\Role::where('name', config('codeedubook.acl.role_author'))->first();
       $permissionsBook = \CodeEduUser\Models\Permission::where('name', 'like', 'book%')->pluck('id')->all();
       $permissionsCategory = \CodeEduUser\Models\Permission::where('name', 'like', 'category%')->pluck('id')->all();

       $roleAuthor->permissions()->attach($permissionsBook);
       $roleAuthor->permissions()->attach($permissionsCategory);
    }
}
