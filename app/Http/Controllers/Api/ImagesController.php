<?php

namespace App\Http\Controllers\Api;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Validator;

/**
 * Hnadles the uploading all images
 */
class ImagesController extends Controller
{

    /**
     * Upload properties images
     */
    public function upload(Request $request)
    {
        $image = $request->file('image');
        $validator = Validator::make(['image' => $image], [
            'image' => ['required', 'image']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        /**
         * model_id could be auto increment id from property, material, profile model etc
         */
        $model_id = $request->id ?? '';
        if (empty($model_id) || empty($request->type) || empty($request->folder)) {
            return response()->json([
                'status' => 0, 
                'info' => 'Invalid Operation.'
            ]);
        }

        // try {
            $dimention = Image::$dimentions[$request->type];
            $extension = $image->getClientOriginalExtension();
            //dd($extension);
            $filename = $image->getRealPath();
            if (empty($request->public_id)) {
                $public_id = Str::uuid();
                \Cloudder::upload($filename, $public_id, [
                    'folder' => $request->folder,
                    'overwrite' => false,
                    'resource_type' => 'image', 
                    'responsive' => true, 
                    'transformation' => [
                        'quality' => 100, 
                        'width' => $dimention['width'], 
                        'height' => $dimention['height'], 
                        'crop' => 'scale'
                    ]
                ]);

                Image::create([
                    'type' => $request->type,
                    'public_id' => $public_id,
                    'model_id' => $model_id,
                    'link' => \Cloudder::show($public_id).'.'.$extension,
                    'role' => $request->role,
                ]);

                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation successful.'
                ]);
            }

            $image = Image::where([
                'public_id' => $request->public_id,
                'type' => $request->type, 
                'model_id' => $model_id, 
                'role' => $request->role,
            ])->first();

            \Cloudder::delete($image->public_id);
            \Cloudder::upload($filename, Str::uuid(), [
                'folder' => $request->folder,
                'overwrite' => false,
                'resource_type' => 'image', 
                'responsive' => true, 
                'transformation' => [
                    'quality' => 100, 
                    'width' => $dimention['width'], 
                    'height' => $dimention['height'], 
                    'crop' => 'scale'
                ]
            ]);

            $public_id = \Cloudder::getPublicId();
            $link = \Cloudder::show($public_id).'.'.$extension;
            $image->link = $link;
            $image->update();


            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful.'
            ]);
        // } catch (Exception $error) {
        //     return response()->json([
        //         'status' => 0, 
        //         'error' => 'Unknown error. Try again.'
        //     ]);
        // }
            
    }

}