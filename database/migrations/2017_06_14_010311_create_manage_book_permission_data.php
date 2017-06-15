<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageBookPermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        list($name, $resourceName) = explode('/', config('codeedubook.acl.permissions.book_manager_all'));
        \CodeEduUser\Models\Permission::create([
            'name' => $name,
            'description' => 'Administração de livros',
            'resource_name' => $resourceName,
            'resource_description' => 'Gerenciar todos os livros'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        list($name, $resourceName) = explode('/', config('codeedubook.acl.permissions.book_manager_all'));
        $permission = \CodeEduUser\Models\Permission::where('name', $name)
            ->where('resource_name', $resourceName)
            ->first();
        $permission->roles()->detach();
        $permission->delete();
    }
}
