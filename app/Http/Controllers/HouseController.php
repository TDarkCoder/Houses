<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class HouseController extends Controller
{

    public function index(){

        $minimum = House::orderBy('price', 'asc')->pluck('price')->first(); // This variable is important to assign minimum price for vue component working with features of houses while filtering

        $maximum = House::orderBy('price', 'desc')->pluck('price')->first(); // This variable is important to assign maximum price for vue component working with features of houses while filtering

        return view('welcome', compact('minimum', 'maximum'));

    }

    public function filter(Request $request){

        // Pipeline is handled to accept features coming from form and send proper filtered data
        return app(Pipeline::class)->send(House::query())->through([
            \App\Filters\Name::class, \App\Filters\Bedrooms::class, \App\Filters\Bathrooms::class, \App\Filters\Garages::class, \App\Filters\Storeys::class, \App\Filters\Min::class, \App\Filters\Max::class
        ])->thenReturn()->offset(request('offset'))->take(15)->get();

    }
}
