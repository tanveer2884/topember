<?php

namespace Topdot\Core\Services\Excel\Import;

use Topdot\Core\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Topdot\Core\Services\Excel\Import\AbstractImportService;

class UserImportService extends AbstractImportService
{
    public function __construct(UploadedFile $file)
    {
        parent::__construct(
            $this->getStoragePath(
                $this->importFile($file)
            )
        );
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function handle()
    {
        $errored = collect();

        foreach ($this->prepareImportedData() as $user) {
            try {
                
                if ( ( $vResult = $this->validate($user) ) && $vResult === true ){
                    User::create($user);
                    continue;
                }
                
                $user['errors'] = $vResult;
                unset($user['password']);
                unset($user['created_at']);
                unset($user['updated_at']);
                $errored->push( $user );

            } catch (\Exception $ex) {
                unset($user['password']);
                unset($user['created_at']);
                unset($user['updated_at']);
                $user['errors'] = $ex->getMessage();
                $errored->push( $user );
            }
        }

        return $errored;
    }

    public function prepareImportedData()
    {
        return array_map(function ($user) {
            $userData = [];

            foreach (config('core.imports.users.columnMapping', []) as $dbColumn => $csvColumn) {
                $userData[$dbColumn] = optional($user)[$csvColumn];
            }

            foreach (config('core.imports.users.defaults', []) as $dbColumn => $defaultValue) {
                $userData[$dbColumn] = $defaultValue;
            }

            foreach (config('core.imports.users.hash', []) as $dbColumn => $defaultValue) {
                $userData[$dbColumn] = bcrypt($defaultValue);
            }

            return $userData;
        }, array_slice($this->getDataAsArray(), 1));
    }

    private function validate($user)
    {
        $v = Validator::make($user,[
            "username" => 'required|unique:users,username',
            "name" => 'required',
            "last_name" => 'required',
            "email" => 'required|unique:users,email',
            "phone" => 'required|max:20',
            "address" => 'required|max:191',
            "address2" => 'nullable|max:191',
            "city" => 'required|max:191',
            "state" => 'required|max:191',
            "zipCode" => 'required',
        ]);

        if ( !$v->fails() ){
            return true;
        }

        return collect($v->errors()->toArray())->flatten()->join(' | ');

    }
}
