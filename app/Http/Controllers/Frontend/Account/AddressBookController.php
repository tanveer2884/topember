<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('frontend.account.addressBook.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontend.account.addressBook.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Address $address)
    {
        if ( $address->user_id != Auth::id() ){
            throw new NotFoundHttpException();
        }
        return view('frontend.account.addressBook.edit',compact('address'));
    }
}
