<?php

namespace Topdot\Coupon\Http\Livewire;

use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\InteractsWithRequests;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Traits\WithUniqueId;
use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Coupon\Models\Coupon;
use Topdot\Coupon\Repositories\CouponRepository;

class TableComponent extends Component
{
    use WithPagination,
        WithUniqueId,
        InteractsWithRequests,
        ResetsPagination,
        HasSorting;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';

    public function render()
    {
        return view('coupon::livewire.table-component',[
            'coupons' => $this->getCoupons()
        ]);
    }

    public function toggleStatus(Coupon $coupon)
    {
        $coupon->markActive(
            !$coupon->isActive()
        );
        $this->emit('alert-success','Coupon Status updated');
    }

    public function delete(Coupon $coupon)
    {
        try {
            (new CouponRepository())->destroy($coupon);
            $this->emit('alert-success','Coupon Deleted');
        }catch (\Exception $exception){
            $this->emit('alert-danger','Error: '.$exception->getMessage());
        }

    }

    public function getCoupons()
    {
        return (new CouponRepository())->get(
            $this->getRequest(
                $this->getRequestAttributes()
            ),
            10,
            $this->sortOrder,
            $this->orderBy
        );
    }

    public function getRequestAttributes()
    {
        return [
            'search' => $this->search
        ];
    }
}
