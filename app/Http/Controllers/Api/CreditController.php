<?php

namespace App\Http\Controllers\Api;
use App\Models\{Unit, Payment, Credit};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\Paystack;
use \Exception;
use Validator;

class CreditController extends Controller
{

    /**
     * Buy ads credit
     */
    public function buy()
    {
        $data = request()->only(['unit']);
        $validator = Validator::make($data, [
            'unit' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $unit = Unit::find($data['unit']);
        if (empty($unit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid ads unit'
            ]);
        }

        try {
            $amount = $unit->price ?? 0;
            $reference = \Str::uuid();

            DB::beginTransaction();
            $payment = Payment::create([
                'reference' => $reference,
                'amount' => $amount,
                'type' => 'advert',
                'status' => 'initialized',
                'user_id' => auth()->user()->id,
            ]);

            Credit::create([
                'price' => $amount,
                'payment_id' => $payment->id,
                'duration' => $unit->duration,
                'unit_id' => $unit->id,
                'units' => $unit->units,
                'reference' => $reference,
                'status' => 'initialized',
                'user_id' => auth()->user()->id,
            ]);

            DB::commit();
            $paystack = (new Paystack())->initialize([
                'amount' => $amount * 100, //in kobo
                'email' => auth()->user()->email, 
                'reference' => $reference,
                'currency' => 'NGN',
                'callback_url' => route('credit.buy.verify')
            ]);

            if ($paystack) {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Payment initialized. Please wait . . .',
                    'redirect' => $paystack->data->authorization_url,
                ]);
            }
            
            return response()->json([
                'status' => 0, 
                'info' => 'Payment initialization failed. Try again.',
            ]);
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0, 
                'info' => 'An error occured. Refresh the page and try again.'
            ]);
        }         
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify() {
        $reference = request('reference');
        if(empty($reference)) {
            return [
                'status' => 0,
                'info' => 'Invalid payment verification'
            ];
        }

        DB::beginTransaction();
        $payment = Payment::where(['reference' => $reference])->first();
        if (empty($payment)) {
            return [
                'status' => 0,
                'info' => 'Invalid payment transaction'
            ];
        }elseif (strtolower($payment->status) === 'paid') {
            return [
                'status' => 1,
                'info' => 'Payment already verified.'
            ];
        }

        try {
            $verify = (new Paystack())->verify($reference);
            if (empty($verify) || $verify === false) {
                return [
                    'status' => 0,
                    'info' => 'Verification failed.'
                ];
            }

            if ('success' === $verify->data->status && 'NGN' === strtoupper($verify->data->currency) && $verify->data->customer->email === auth()->user()->email && ((int)$verify->data->amount/100) === (int)$payment->amount) {

                $payment->status = 'paid';
                $payment->update();
                $credit = Credit::where(['reference' => $reference, 'user_id' => auth()->user()->id])->first();
                $credit->status = 'paused';
                $credit->update();
                DB::commit();

                return [
                    'status' => 1,
                    'info' => 'Transaction successfull.'
                ];
            }

            $payment->status = 'failed';
            $payment->update();
            return [
                'status' => 0,
                'info' => 'Payment verification failed. Refresh you page.'
            ];
        } catch (Exception $error) {
            DB::rollback();
            return [
                'status' => 0,
                'info' => 'Unknown error. Try again.'
            ];
        }    
            
    }

}