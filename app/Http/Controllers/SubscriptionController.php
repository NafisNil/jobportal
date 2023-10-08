<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\isEmployer;
class SubscriptionController extends Controller
{
    //
    const WEEKLY_AMOUNT = 20;
    const MONTHLY_AMOUNT = 80;
    const YEARLY_AMOUNT = 200;
    const CURRENCY = 'USD';
    public function __construct(){
        $this->middleware(['auth', isEmployer::class]);
    }
    public function subscribe(){
        return view('subscription.index');
    }

    public function initialPayment(Request $request){
        $plans = [
            'weekly' => [
                'name' => 'weekly',
                'description' => 'weekly payment',
                'amount' => SELF::WEEKLY_AMOUNT,
                'currency' => SELF::CURRENCY,
                'quantity' => 1
            ],
        ];
    }
}
