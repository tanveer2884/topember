<?php

namespace Topdot\Core\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Core\Models\User;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Repositories\UserRepository;
use Topdot\Core\Traits\InteractsWithRequests;

class TableComponent extends Component
{
    protected string $paginationTheme = 'bootstrap';
    use withPagination,
        InteractsWithRequests,
        HasSorting,
        ResetsPagination;

    public string $name;
    public string $email;
    public ?string $designer;
    public ?string $active;
    public string $cratedAt;
    public ?string $approved;
    public string $downloadLink;
    public $selectedUsers;

    public function mount()
    {
        $this->name = '';
        $this->email = '';
        $this->designer = -1;
        $this->active = -1;
        $this->cratedAt = '';
        $this->approved = -1;
        $this->orderBy = 'id';
        $this->sortOrder = 'DESC';
        $this->sortArrow = '';
        $this->selectedUsers = [];
        $this->downloadLink = route(config('core.routeNamePrefix').'users.export.csv');
    }

    public function render()
    {
        $this->downloadLink = route(config('core.routeNamePrefix').'users.export.csv',$this->getAttributes());
        return view('core::livewire.table-component',[
            'users' => $this->getUsers()
        ]);
    }

    public function getUsers()
    {
        return (new UserRepository())->get($this->getRequest($this->getAttributes()),10,$this->sortOrder,$this->orderBy);
    }

    public function markActive()
    {
        $users = array_keys(array_filter($this->selectedUsers,function($value){
            return $value;
        }));

        User::whereIn('id',$users)->update([
            'is_active' => true
        ]);
    }

    public function markInactive()
    {
        $users = array_keys(array_filter($this->selectedUsers,function($value){
            return $value;
        }));

        User::whereIn('id',$users)->update([
            'is_active' => false
        ]);
    }

    public function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'designer' => $this->designer,
            'active' => $this->active,
            'approved' => $this->approved,
            'createdAt' => $this->cratedAt,
        ];
    }
}
