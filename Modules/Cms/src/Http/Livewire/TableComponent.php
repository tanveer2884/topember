<?php

namespace Topdot\Cms\Http\Livewire;

use Exception;
use Livewire\Component;
use Topdot\Cms\Models\Page;
use Livewire\WithPagination;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Cms\Repositories\PageRepository;
use Topdot\Core\Traits\InteractsWithRequests;

class TableComponent extends Component
{
    protected string $paginationTheme = 'bootstrap';
    use withPagination,
        InteractsWithRequests,
        HasSorting,
        ResetsPagination;

    protected $listeners = [
        'delete' => 'delete'
    ];

    public string $title;
    public string $active;
    public string $cratedAt;


    public function mount()
    {
        $this->title = '';
        $this->active = '-1';
        $this->cratedAt = '';
        $this->orderBy = 'id';
        $this->sortOrder = 'DESC';
        $this->sortArrow = '';
    }


    public function render()
    {
        return view('cms::livewire.table-component',[
            'pages' => $this->getPages()
        ]);
    }

    public function delete(Page $page)
    {
        try {
            (new PageRepository())->delete($page);
            $this->emit('alert-success','Page Deleted');
        }catch (Exception $exception){
            $this->emit('alert-danger',$exception->getMessage());
        }
    }


    public function getPages()
    {
        return (new PageRepository())->get($this->getRequest($this->getAttributes()),10,$this->sortOrder,$this->orderBy);
    }

    public function getAttributes(): array
    {
        return [
            'title' => $this->title,
//            'status' => $this->active,
            'createdAt' => $this->cratedAt,
        ];
    }

}
