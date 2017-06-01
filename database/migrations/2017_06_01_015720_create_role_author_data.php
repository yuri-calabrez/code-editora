<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \CodeEduUser\Models\Role::create([
           'name' => config('codeedubook.acl.role_author'),
            'description' => 'Autor de livros no sistema'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $role = \CodeEduUser\Models\Role::where('name', config('codeedubook.acl.role_author'))->first();
        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();
    }
}
