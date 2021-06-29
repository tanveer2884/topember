<?php


namespace Topdot\Core\Repositories;


use Exception;
use Illuminate\Http\Request;
use Topdot\Core\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RolesRepository implements CanFilterRecords
{
    /**
     * @param Request $request
     * @param int $paginate
     * @param string $sortOrder
     * @param string $orderBy
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function get(Request $request, $paginate = 50, $sortOrder = 'ASC', $orderBy = 'id')
    {
        $query = Role::query();
        return $paginate == false ? $query->get() : $query->paginate($paginate);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws RoleCreateException
     */
    public function store(Request  $request)
    {
        return Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    /**
     * @param Role $role
     * @param Request $request
     * @return bool
     * @throws RoleUpdateException
     */
    public function update(Role $role, Request $request)
    {
        return $role->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    /**
     * @param Role $role
     */
    public function delete(Role $role)
    {
        if (!$role->isDeleteable()) {
            abort(403, 'Role is not Deleteable');
        }

        $role->permissions()->sync([]);
        $role->users()->sync([]);
        $role->delete();
    }
}
