<?php

namespace App\Livewire\Admin\System\Role;

use App\Livewire\Admin\System\SystemAbstract;
use App\Livewire\Traits\Notifies;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

abstract class RoleAbstract extends SystemAbstract
{
    use Notifies;

    public Role $role;

    /**
     * The current staff assigned permissions.
     */
    public Collection $rolePermissions;

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    protected function rules()
    {
        return [
            'role.name' => [
                'required',
                'string',
                'max:30',
                Rule::unique($this->role->getTable(), 'name')
                    ->ignore($this->role),
            ],
        ];
    }

    /**
     * Sync the set permissions with the staff member.
     *
     * @return void
     */
    protected function syncPermissions()
    {
        $this->role->syncPermissions(
            $this->rolePermissions->toArray()
        );
    }

    /**
     * Toggle a permission for a staff member.
     *
     * @param  string  $handle
     * @param  array<mixed>  $children
     * @return void
     */
    public function togglePermission($handle, $children = [])
    {
        $index = $this->rolePermissions->search($handle);

        if ($index !== false) {
            $this->removePermission($handle);
            foreach ($children as $child) {
                $this->removePermission($child);
            }

            return;
        }

        $this->addPermission($handle);
    }

    /**
     * Add a permission to the staff member.
     *
     * @param  string  $handle
     * @return void
     */
    public function addPermission($handle)
    {
        if ($this->rolePermissions->contains($handle)) {
            return;
        }
        $this->rolePermissions->push($handle)->flatten();
    }

    /**
     * Remove a permission from a staff member.
     *
     * @param  string  $handle
     * @return void
     */
    public function removePermission($handle)
    {
        /** @var int $index */
        $index = $this->rolePermissions->search($handle);
        $this->rolePermissions->splice($index, 1);
    }
}
