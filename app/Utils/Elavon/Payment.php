<?php

namespace App\Utils\Elavon;
use Treestoneit\LaravelConvergeApi\Converge;

class Payment
{

    public function pay() {
        $converge = app(Converge::class);

        $createSale = $converge->authOnly([
            'ssl_card_number' => '5121212121212124',
            'ssl_exp_date' => '0325',
            'ssl_cvv2cvc2' => '321',
            'ssl_amount' => '250.00',
            'ssl_add_token' => 'Y',
        ]);

        return $createSale;

    }

}
