<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'full_name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'bio' => $this->bio,
            'stripe_customer_id' => $this->customer_id,
            'is_lender' => $this->is_lender,
            'stripe_lender_id' => $this->when(
                $this->is_lender,
                function () {
                    return $this->stripe_vendor_account_id;
                }
            ),

            'balance' => $this->when(
                $this->is_lender,
                function () {
                    return $this->balance;
                }
            ),
            'profile_image' => $this->when(
                $this->is_lender,
                function () {
                    return $this->getFirstMediaUrl('avatar');
                }
            ),
            'profile_banner' => $this->when(
                $this->is_lender,
                function () {
                    return $this->getFirstMediaUrl('banner');
                }
            ),


        ];
    }
}
