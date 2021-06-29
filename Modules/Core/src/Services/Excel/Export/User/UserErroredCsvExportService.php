<?php


namespace Topdot\Core\Services\Excel\Export\User;


use Illuminate\Support\Str;
use Topdot\Core\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Topdot\Core\Services\Excel\Export\AbstractCsvExportService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class UserErroredCsvExportService extends UserCsvExportService
{
    public function __construct(Collection $users)
    {
        $users = $users->map(function($user){
            return (object)$user;
        });
        $eloquentCollection = EloquentCollection::make($users);

        parent::__construct($eloquentCollection);
        $this->columns = array_keys( (array) $users->first());
    }
}
