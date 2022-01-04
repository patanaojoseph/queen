<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Brand;
use App\Models\Multipic;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function about(){
        return view('about');
    }

    // public function home(){
    //     $brands = Brand::get();
    //     $abouts = About::get();
    //     $sliders = Slider::get();
    //     $services = Service::get();
    //     $multipics = Multipic::get();
    //     return view('home',compact('brands','abouts','sliders','services','multipics'));
    // }
}
