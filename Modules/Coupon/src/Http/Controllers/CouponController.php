<?php

namespace Topdot\Coupon\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Topdot\Category\Models\Category;
use Topdot\Coupon\Http\Requests\CreateCouponRequest;
use Topdot\Coupon\Http\Requests\UpdateCouponRequest;
use Topdot\Coupon\Models\Coupon;
use Topdot\Coupon\Repositories\CouponRepository;
use Topdot\Product\Models\Product;

class CouponController extends Controller
{
    public function __construct()
    {
        view()->composer(
            [
                'coupon::create',
                'coupon::edit'
            ],
            function ($view) {
                return $view->with('allProducts', Product::select('id','name')->get())
                    ->with('allCategories', Category::select('id','name')->get())
                    ->with('allUsers', User::select('id','name')->get());
            }
        );
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('coupon::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('coupon::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateCouponRequest $request
     * @param CouponRepository $couponRepository
     * @return Renderable
     */
    public function store(CreateCouponRequest $request, CouponRepository $couponRepository)
    {
        try {
            $couponRepository->store($request);
            session()->flash('alert-success', 'Coupon Saved Successfully');
            return redirect()->route(config('coupon.routeNamePrefix').'coupons.index');
        } catch (\Exception $exception) {
            session()->flash('alert-danger', $exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Coupon $coupon
     * @param CouponRepository $couponRepository
     * @return Renderable
     */
    public function edit(Coupon $coupon, CouponRepository $couponRepository)
    {
        $coupon = $couponRepository->getSingleCouponForEdit($coupon);
        return view('coupon::edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCouponRequest $request
     * @param Coupon $coupon
     * @param CouponRepository $couponRepository
     * @return Renderable
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon, CouponRepository $couponRepository)
    {
        try {
            $couponRepository->update($request, $coupon);
            session()->flash('alert-success', 'Coupon Saved Successfully');
            return redirect()->route(config('coupon.routeNamePrefix').'coupons.index');
        } catch (\Exception $exception) {
            session()->flash('alert-danger', $exception->getMessage());
            return back()->withInput();
        }
    }
}
