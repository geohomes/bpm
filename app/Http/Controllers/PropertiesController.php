<?php

namespace App\Http\Controllers;
use App\Models\{Category, Property, Country};

class PropertiesController extends Controller
{
    /**
     * Properties home view
     */
    public function index()
    {
        return view('frontend.properties.index')->with(['categories' => Category::where(['type' => 'property'])->get(), 'properties' => Property::where('action', '!=', 'sold')->paginate(15),]);
    }

    /**
     * Find Single Property
     */
    public function property($category = 'land', $id = 45, $slug = '')
    {
        $property = Property::findOrFail($id);
        return view('frontend.properties.property')->with([
            'categories' => Category::where(['type' => 'property'])->get(), 'property' => $property, 'related' => Property::where(['category' => $category, 'country_id' => $property->country_id ?? 0])->paginate(6)]); 
    }

    /**
     * Find Properties by category
     */
    public function category($category = 'land')
    {
        $properties = Property::where(['category' => $category])->where('action', '!=', 'sold')->paginate(16);
        return view('frontend.properties.category')->with(['properties' => $properties, 'soldProperties' => Property::where(['action' => 'sold'])->paginate(3), 'name' => $category]);
    }

    /**
     * Find Properties by country
     */
    public function country($iso2 = 'us')
    {
        $country = Country::where('iso2', 'LIKE', $iso2)->first();
        $countryProperties = Property::where(['country_id' => $country->id])->where('action', '!=', 'sold')->paginate(16);
        return view('frontend.properties.country')->with(['countryProperties' => $countryProperties, 'propertyCategories' => Category::where(['type' => 'property'])->get(), 'soldProperties' => Property::where(['status' => 'sold off'])->paginate(3), 'country' => $country]);
    }

    public function search()
    {
        $term = request()->get('query');
        $term = '%'.request()->get('query').'%';
        $properties = Property::where([['action', '!=', 'sold'], [
                function($query) use($term) {
                    $query->orWhere('city', 'LIKE', $term)->orWhere('state', 'LIKE', $term)->orWhere('group', 'LIKE', $term)->orWhere('price', 'LIKE', $term)->orWhere('address', 'LIKE', $term)->orWhere('category', 'LIKE', $term)->get();
                }
            ],
        ])->orderBy('id', 'desc')->paginate(25);
        return view('frontend.properties.search')->with(['properties' => $properties]);
    }

    /**
     * Find Properties by action like for sale, for lease etc
     */
    public function action($action = 'lease')
    {
        $properties =  Property::where(['action' => $action])->where('action', '!=', 'sold')->paginate(16);
        return view('frontend.properties.action')->with(['properties' => $properties]);
    }

}
