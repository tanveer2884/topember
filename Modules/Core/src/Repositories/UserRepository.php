<?php


namespace Topdot\Core\Repositories;


use Illuminate\Http\Request;
use Topdot\Core\Models\User;
use Illuminate\Support\Facades\Auth;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;

class UserRepository implements CanFilterRecords
{
    public function get(Request $request,$paginate=50,$sortOrder='Asc',$orderBy='id')
    {
        $query = User::query();

        if ( $request->name ){
            $query->where('name',"LIKE","%{$request->name}%");
        }

        if ($request->email) {
            $query->where('email',"LIKE","%{$request->email}%");
        }

        if ( $request->active != -1){
            $query->where('is_active',$request->active);
        }

        $query->orderBy($orderBy,$sortOrder);

        return $paginate == false ? $query->get() : $query->paginate($paginate);
    }

    public function store(Request $request)
    {
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        return User::create($userData);
    }

    public function update(User $user, Request $request)
    {
        $userData = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->password) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);
    }

    public function getSingleUser(User $user)
    {
        return $user;
    }
}
