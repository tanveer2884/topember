<?php


namespace Topdot\Coupon\Repositories;


use Illuminate\Http\Request;
use Topdot\Coupon\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;

class CouponRepository implements CanFilterRecords
{

    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = Coupon::query();

        if ($request->search){
            $query->where('name','LIKE',"%{$request->search}%")
                    ->orWhere('code','LIKE',"%{$request->search}%");
        }

        $query->orderBy($orderBy,$sortOrder);
        return false != $paginate ? $query->paginate($paginate) : $query->get();
    }

    public function store(Request $request)
    {
        DB::transaction(function () use($request){
            $coupon = Coupon::create([
                'name' => $request->name,
                'code' => $request->code,
                'value' => $request->value,
                'discount_type' => $request->discount_is_percent ? 'percent' : 'flat',
                'is_active' => $request->is_active ? true : false,
                'is_free_shipping' => $request->is_free_shipping ? true : false,
                'is_site_wide' => $request->is_site_wide ? true : false,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
            ]);

            // $coupon->categories()->sync($request->get('categories',[]));
            $coupon->products()->sync($request->get('products',[]));
            $coupon->users()->sync($request->get('users',[]));

            // foreach ($request->get('excludeCategories',[]) as $category){
            //     $coupon->categories()->attach($category,['exclude'=>true]);
            // }

            foreach ($request->get('excludeProducts',[]) as $product){
                $coupon->products()->attach($product,['exclude'=>true]);
            }

            return true;
        });
    }

    public function update(Request $request, Coupon $coupon)
    {
        DB::transaction(function () use($request,$coupon){
            $coupon->update([
                'name' => $request->name,
                'code' => $request->code,
                'value' => $request->value,
                'discount_type' => $request->discount_is_percent ? 'percent' : 'flat',
                'is_active' => $request->is_active ? true : false,
                'is_free_shipping' => $request->is_free_shipping ? true : false,
                'is_site_wide' => $request->is_site_wide ? true : false,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
            ]);

            // $coupon->categories()->sync([]);
            $coupon->products()->sync([]);
            $coupon->users()->sync([]);

            // $coupon->categories()->sync($request->categories);
            $coupon->products()->sync($request->get('products',[]));
            $coupon->users()->sync($request->get('users',[]));

            // foreach ($request->excludeCategories as $category){
            //     $coupon->categories()->attach($category,['exclude'=>true]);
            // }

            foreach ($request->get('excludeProducts',[]) as $product){
                $coupon->products()->attach($product,['exclude'=>true]);
            }

            return true;
        });
    }

    public function destroy(Coupon $coupon)
    {
        DB::transaction(function () use($coupon){
            $coupon->users()->sync([]);
            $coupon->categories()->sync([]);
            $coupon->products()->sync([]);
            $coupon->delete();
        });
    }

    public function getSingleCouponForEdit(Coupon $coupon)
    {
        $coupon->products = $coupon->includedProducts()->pluck('id')->toArray();
        $coupon->excludeProducts = $coupon->excludedProducts()->pluck('id')->toArray();
        $coupon->categories = $coupon->includedCategories()->pluck('id')->toArray();
        $coupon->excludeCategories = $coupon->excludedCategories()->pluck('id')->toArray();
        $coupon->users = $coupon->users()->pluck('id')->toArray();
        return $coupon;
    }

}
