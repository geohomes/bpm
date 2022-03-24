<?php

namespace App\Http\Controllers\Api;
use App\Models\{Credit, Property, Material, Profile, Promotion};
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use \Carbon\Carbon;
use \Exception;
use Validator;
use DB;

class PromotionsController extends Controller
{
    /**
     * Api promote a property
     */
    public function promote()
    {
        $data = request()->only(['credit', 'reference', 'type']);
        $validator = Validator::make($data, [
            'credit' => ['required', 'integer'],
            'reference' => ['required'],
            'type' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $type = $data['type'] ?? '';
        if (!in_array($type, Promotion::$types)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid promotion type.',
            ]);
        }

        $creditid = $data['credit'];
        $credit = Credit::find($creditid);
        if (empty($credit)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid credit.',
            ]);
        }

        $reference = $data['reference'] ?? 0;
        switch ($type) {
            case 'property':
                $product = Property::find($reference);
                if (empty($product)) {
                    return response()->json([
                        'status' => 0, 
                        'info' => 'Invalid promotion.',
                    ]);
                }

                if ($product->status !== 'active' || empty($product->image)) {
                    return response()->json([
                        'status' => 0, 
                        'info' => 'You can only promote activated properties with image',
                    ]);
                }
                break;

            case 'material':
                $product = Material::find($reference);
                if (empty($product)) {
                    return response()->json([
                        'status' => 0, 
                        'info' => 'Invalid promotion.',
                    ]);
                }

                if ($product->status !== 'active' || empty($product->image)) {
                    return response()->json([
                        'status' => 0, 
                        'info' => 'You can only promote activated materials with image',
                    ]);
                }
                break;
            case 'profile':
                $product = Profile::find($reference);
                if (empty($product)) {
                    return response()->json([
                        'status' => 0, 
                        'info' => 'Invalid promotion.',
                    ]);
                }

                if (empty($product->image)) {
                    return response()->json([
                        'status' => 0, 
                        'info' => 'You can only promote activated materials with image',
                    ]);
                }
                break;
            
            default:
                return response()->json([
                    'status' => 0, 
                    'info' => 'Invalid promotion',
                ]);
                break;
        }

        try {
            DB::beginTransaction();
            $credit->status = 'running';
            $credit->update();

            $days = $credit->duration ?? 0;
            Promotion::create([
                'credit_id' => $credit->id,
                'duration' => $days,
                'started' => Carbon::today(),
                'type' => $type,
                'expiry' => Carbon::today()->addDays($days),
                'status' => 'active',
                'user_id' => auth()->id(),
                'reference' => $reference,
            ]);

            $product->promoted = true;
            $product->update();

            DB::commit();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => '',
            ]);
            
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed',
            ]);
        }
    }
}