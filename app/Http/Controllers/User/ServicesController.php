<?php

namespace App\Http\Controllers\User;
use App\Models\Service;
use App\Http\Controllers\Controller;
use Validator;


class ServicesController extends Controller
{
	/**
     * User services list view
     */
    public function index()
    {
        return view('user.services.index')->with(['services' => service::where(['user_id' => auth()->id()])->get()]);
    }

    /**
     * Buy ads credit
     */
    public function create()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'description' => ['required', 'string', 'max:200'],
            'skill' => ['required', 'integer',],
            'price' => ['required', 'numeric'],
        ]);

        $service = Service::where([
            'user_id' => auth()->user()->id, 
            'skill_id' => $data['skill']
        ])->first();

        if (!empty($service)) {
            return response()->json([
                'status' => 0, 
                'info' => 'You have already created a service with the service selected.'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        Service::create([
            'description' => $data['description'],
            'skill_id' => $data['skill'],
            'price' => $data['price'],
            'status' => 'active',
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);       
    }

    /**
     * Buy ads credit
     */
    public function edit($id)
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'description' => ['required', 'string', 'max:200'],
            'skill' => ['required', 'integer',],
            'price' => ['nullable', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $service = Service::find($id);
        $service->description = $data['description'];
        $service->skill_id = $data['skill'];
        $service->price = $data['price'];
        $service->update();

        return response()->json([
            'status' => 1, 
            'info' => 'Operation successful',
            'redirect' => '',
        ]);       
    }

}