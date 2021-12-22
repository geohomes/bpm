<?php

namespace App\Http\Controllers\Admin;
<<<<<<< HEAD
use App\Models\{Category, Property, Country, Image, Division};
use App\Http\Controllers\Controller;
use \Exception;
use Validator;
=======
use App\Models\{Category, Property, Country};
use App\Http\Controllers\Controller;
>>>>>>> b0e72cfb0b42dc80ca26a72be07e041bc89300f5

class PropertiesController extends Controller
{
    /**
     * Admin Properties list view
     */
    public function index()
    {
<<<<<<< HEAD
        $properties = Property::latest('created_at')->paginate(12);
        return view('admin.properties.index')->with(['properties' => $properties, 'categories' => Category::where(['type' => 'property'])->get(), 'countries' => Country::all(), 'divisions' => Division::all()]);
=======
        return view('admin.properties.index')->with(['allProperties' => Property::paginate(21)]);
>>>>>>> b0e72cfb0b42dc80ca26a72be07e041bc89300f5
    }

    /**
     * Admin add Property
     */
    public function add()
    {
<<<<<<< HEAD
        $data = request()->all();
        $validator = Validator::make($data, [
            'country' => ['required', 'integer'],
            'state' => ['required', 'string'],
            'category' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'action' => ['required', 'string'],
            'dimension' => ['required', 'string'],
            'additional' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $property = Property::create([
            'country_id' => $data['country'],
            'state_id' => $data['state'],
            'address' => $data['address'],
            'city' => $data['city'],
            'action' => $data['action'],
            'category_id' => $data['category'],
            'measurement' => $data['dimension'],
            'user_id' => auth()->user()->id ?? 0,
            'additional' => $data['additional'],
            'reference' => \Str::uuid(),
            'price' => $data['price'],
        ]);

        if ($property) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route('admin.property.edit', ['id' => $property->id, 'category' => $property->category->name ?? 'any']),
            ]); 
        }else {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed',
            ]);   
        }

    }

    /**
     * Admin edit Property view
     */
    public function edit($id = 0, $category = 'any')
    {
        return view('admin.properties.edit')->with(['categories' => Category::where(['type' => 'property'])->get(), 'property' => Property::find($id), 'category' => $category, 'countries' => Country::all()]);
    }

    /**
     * Admin [post] edit Property
     */
    public function update($id = 0, $category = 'any')
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'country' => ['required', 'integer'],
            'state' => ['required', 'integer'],
            'category' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'action' => ['required', 'string'],
            'measurement' => ['required', 'string'],
            'additional' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $property = Property::find($id);
        $property->country_id = $data['country'];
        $property->state_id = $data['state'];
        $property->address = $data['address'];
        $property->city = $data['city'];
        $property->action = $data['action'];
        $property->category_id = $data['category'];
        $property->measurement = $data['measurement'];
        $property->additional = $data['additional'];
        $property->price = $data['price'];
        $updated = $property->update();

        if ($updated) {
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful',
                'redirect' => route('admin.property.edit', [
                    'id' => $property->id, 
                    'category' => $category
                ]),
            ]);
        }else {
            return response()->json([
                'status' => 0, 
                'info' => 'Operation failed',
            ]);
        }

            
    }

    /**
     * Admin property add images
     */
    public function image($id = 0, $role = 'main')
    {
        $image = request()->file('image');
        $validator = Validator::make(['image' => $image], [
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg|max:10240']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0, 
                'error' => $validator->errors()
            ]);
        }

        $extension = $image->getClientOriginalExtension();
        $filename = \Str::uuid().'.'.$extension;
        $path = 'images/properties';
        $link = env('APP_URL')."/images/properties/{$filename}";

        /**
         * Delete previous image file if any
         */
        $delete = function($imageurl = '') use($path) {
            $prevfile = explode('/', $imageurl);
            $previmage = end($prevfile);
            $file = "{$path}/{$previmage}";
            if (file_exists($file)) {
                unlink($file);
            }
        };

        $property = Property::find($id);
        if (is_string($role) && $role === 'main') {
            $imageurl = $property->image ?? '';
            if (!empty($imageurl)) $delete($imageurl);
            $property->image = $link;

            $image->move($path, $filename);
            $property->update();
            return response()->json([
                'status' => 1, 
                'info' => 'Operation successful'
            ]);
        }else {
            $imageid = $role;
            $picture = Image::where(['type_id' => $id, 'id' => $imageid])->first();
            if (empty($picture)) {
                $lastid = Image::create([
                    'type_id' => $id,
                    'link' => $link,
                    'type' => 'property',
                ])->id;

                if($lastid) {
                    $image->move($path, $filename);
                    return response()->json([
                        'status' => 1, 
                        'info' => 'Operation successful'
                    ]);
                }else {
                    return response()->json([
                        'status' => 1, 
                        'info' => 'Operation failed'
                    ]);
                }
            }

            $imageurl = $picture->link ?? '';
            if (!empty($imageurl)) $delete($imageurl);
            $picture->link = $link;
            $success = $picture->update();

            if ($success) {
                $image->move($path, $filename);
                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation successful'
                ]);
            }else {
                return response()->json([
                    'status' => 1, 
                    'info' => 'Operation failed'
                ]);
            }
                
        }     
    }

    /**
     * Admin get properties by country
     */
    public function country($countryid = 0)
    {
        $properties = Property::whereHas('country', function ($query) use ($countryid) {
            $query->where(['id' => $countryid]);
        })->paginate(12);

        $categories = Category::where(['type' => 'property'])->get();
        return view('admin.properties.country')->with(['properties' => $properties, 'categories' => $categories]);
    }

    /**
     * Admin get properties by user
     */
    public function user($userid = 0)
    {
        $properties = Property::whereHas('user', function ($query) use ($userid) {
            $query->where(['id' => $userid]);
        })->paginate(12);

        $categories = Category::where(['type' => 'property'])->get();
        return view('admin.properties.user')->with(['properties' => $properties, 'categories' => $categories]);
    }

    /**
     * Admin get properties by category
     */
    public function category($categoryname = 'lands')
    {
        $properties = Property::whereHas('category', function ($query) use ($categoryname) {
            $query->where(['name' => $categoryname]);
        })->paginate(12);

        $categories = Category::where(['type' => 'property'])->get();
        return view('admin.properties.category')->with(['properties' => $properties, 'categories' => $categories]);
    }

    /**
     * Admin search Properties
     */
    public function search()
    {
        $properties = Property::search(request()->query)->paginate(16);
        return view('admin.properties.index')->with(['properties' => $properties, 'categories' => Category::where(['type' => 'property'])->get()]);
    }
=======
        return view('admin.properties.add')->with(['propertiesCategories' => Category::where(['type' => 'property'])->get(), 'allCountries' => Country::all()]);
    }

    /**
     * Admin Properties categories
     */
    public function categories()
    {
        return view('admin.properties.categories')->with(['propertiesCategories' => Category::where(['type' => 'property'])->get()]);
    }

>>>>>>> b0e72cfb0b42dc80ca26a72be07e041bc89300f5

}
