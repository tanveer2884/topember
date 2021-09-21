<?php

namespace App\Http\Livewire\Admin\Testimonials;
;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
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
        return view('livewire.admin.testimonials.table-component',[
            'testimonials' => $this->getTestimonials()
        ]);
    }

    public function delete(Testimonial $testimonial)
    {
        $testimonial->delete();
        $this->emit('alert-success','Testimonial Deleted Successfully');
    }

    private function getTestimonials()
    {
        return (new TestimonialRepository)->get(
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
