<?php

namespace CodeEduUser\Console;

use CodeEduUser\Facade\PermissionReader;
use CodeEduUser\Repositories\PermissionRepository;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreatePermissionsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'codeeduuser:make-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação de permissões baseado em controllers e actions';
    /**
     * @var PermissionRepository
     */
    private $repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PermissionRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $permissions = PermissionReader::getPermissions();
        foreach ($permissions as $permission) {
            if(!$this->existsPermission($permission)) {
                $this->repository->create($permission);
            }
        }
        $this->info('<info>Permissões carregadas</info>');
    }

    private function existsPermission($permission)
    {
        $permission = $this->repository->findWhere([
           'name' => $permission['name'],
            'resource_name' => $permission['resource_name']
        ])->first();

        return $permission != null;
    }
}
