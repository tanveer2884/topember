<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Faq;
use App\Repositories\FaqRepository;
use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\InteractsWithRequests;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Traits\WithUniqueId;

class TableComponent extends Component
{
    use WithPagination,
        HasSorting,
        WithUniqueId,
        InteractsWithRequests,
        ResetsPagination;

    protected $listeners = [
        'delete' => 'delete'
    ];

    public $search;

    public function mount()
    {
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.admin.faq.table-component',[
            'faqs' => $this->getFaqs()
        ]);
    }

    public function delete(Faq $faq)
    {
        (new FaqRepository)->delete($faq);
        $this->emit('alert-success','Faq Deleted Successfully');
    }

    private function getFaqs()
    {
        return (new FaqRepository)->get(
            $this->getSearchAttributes(),
            50,
            $this->sortOrder,
            $this->orderBy
        );
    }

    private function getSearchAttributes()
    {
        return $this->getRequest([
            'search' => $this->search
        ]);
    }
}
