<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\isEmployer;
use Stripe\Stripe;
use Stripe\Checkout\Session;
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
            'yearly' => [
                'name' => 'yearly',
                'description' => 'yearly payment',
                'amount' => SELF::YEARLY_AMOUNT,
                'currency' => SELF::CURRENCY,
                'quantity' => 1
            ],
            'monthly' => [
                'name' => 'monthly',
                'description' => 'monthly payment',
                'amount' => SELF::MONTHLY_AMOUNT,
                'currency' => SELF::CURRENCY,
                'quantity' => 1
            ]
           
           
        ];
 #initiate payment
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            //code...
            $secretPlan = null;
            if($request->is('pay/weekly')){
                $secretPlan = $plans['weekly'];
                $billingEnds = now()->addWeek()->startOfDay()->toDateString();
            }elseif($request->is('pay/monthly')){
                $secretPlan = $plans['monthly'];
                $billingEnds = now()->addMonth()->startOfDay()->toDateString();
            }elseif($request->is('pay/yearly')){
                $secretPlan = $plans['yearly'];
                $billingEnds = now()->addYear()->startOfDay()->toDateString();
            }
            if ($secretPlan) {
                # code...
                $successURL = URL::signedRoute('payment.success',[
                    'plan' => $secretPlan['name'],
                    'billing_ends' => $billingEnds
                ]);
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'mode' => 'payment',
                    'line_items' =>  [
                        [
                           
                         'price_data' => [
                          
                           'unit_amount' => $secretPlan['amount'] * 100,
                           'currency' => $secretPlan['currency'],
                           'product_data' => [
                             'name' => $secretPlan['name'],
                             'description' => $secretPlan['description']
                           ]
                         ],
                         'quantity' => $secretPlan['quantity'],
                        
                        ],
 
                     ],
                    'success_url' => $successURL,
                    'cancel_url' => route('payment.cancel')
                ]);

                return redirect($session->url);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function paymentSuccess(Request $request){

    }

    public function cancelPayment(){

    }
}
