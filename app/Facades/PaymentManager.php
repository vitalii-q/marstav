<?php

namespace App\Facades;

use App\Models\Payment;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentManager
{
    public function addPayment(Request $request)
    {
        $rate = Rate::query()->where('code', $request->rate_code)->first();

        if ($rate) {
            Payment::query()->insert([
                'user_id' => Auth::user()->id,
                'rate_id' => $rate->id,
                'price' => $rate->price,
                'count' => $request->count,
                'currency' => 'RUB',
                'status' => 'new',
                'code' => $request->payment_code
            ]);
        } else {
            Payment::query()->insert([
                'user_id' => Auth::user()->id,
                'rate_id' => $rate->id,
                'price' => 0,
                'count' => 1,
                'status' => 'error',
                'note' => 'Такого продукта не существует.'
            ]);
            return false;
        }

        return 1;
    }

    public static function checkPayment($payment, $paid, $currency)
    {
        if (($payment->price * $payment->count) != $paid OR $currency != $payment->currency) {
            return false;
        }

        return 1;
    }

    public static function error($payment, $text, $return = false)
    {
        $payment->update([
            'status' => 'error',
            'note' => $text
        ]);

        return $return;
    }

    public static function success($payment, $text, $return = true)
    {
        $payment->update([
            'status' => 'success',
            'note' => $text
        ]);

        return $return;
    }
}
