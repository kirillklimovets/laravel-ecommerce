<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $featuredProducts = Product::where('featured', true)->take(8)->inRandomOrder()->get();
        $newProducts      = Product::latest()->take(8)->get();

        return view('pages.landing.index', compact('featuredProducts', 'newProducts'));
    }


}
