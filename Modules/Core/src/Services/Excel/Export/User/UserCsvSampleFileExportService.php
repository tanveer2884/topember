<?php


namespace Topdot\Core\Services\Excel\Export\User;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Topdot\Core\Services\Excel\Export\AbstractCsvExportService;

class UserCsvSampleFileExportService extends AbstractCsvExportService
{
    private $users;
    protected array $columns;

    public function __construct()
    {
        $this->users = [];
        $this->columns = array_keys(config('core.imports.users.columnMapping',[]));
        parent::__construct();
    }

    public function handle()
    {
        return $this->download();
    }

    public function save()
    {
        
    }

    protected function prepareData(): array
    {
        $usersData = [];

        foreach ($this->users as $user){
            $usersData[] = $this->getDataFor($user);
        }

        return $usersData;
    }

    protected function prepareHeaders(): array
    {
        return array_map(function($column){
            return Str::of($column)->replace("_"," ")->title();
        },$this->columns);
    }

    private function getDataFor($user)
    {
        $userData = [];
        foreach ($this->columns as $column) {
            $userData [] = $user->{$column};
        }

        return $userData;
    }
}
