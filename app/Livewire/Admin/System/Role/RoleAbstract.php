<?php

namespace App\Livewire\Admin\System\Role;

use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use App\Livewire\Traits\Notifies;
use App\Livewire\Admin\System\SystemAbstract;

abstract class RoleAbstract extends SystemAbstract
{
    use Notifies;

    public Role $role;

    /**
     * The current staff assigned permissions.
     *
     * @var Collection
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
                Rule::unique($this->role->getTable(),'name')
                    ->ignore($this->role)
            ]
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
