<?php

namespace App\Http\Controllers;

use App\BagColor;
use App\BagConfig;
use App\Mail;
use App\Po;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
/*        $this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $color_config = BagColor::whereDoesntHave('pages')->get();
        $banner = Po::where('type', 'home')->first();
        $banner = $banner->translate(App::getLocale(), 'pl');
        $info_post = Po::where('type', 'home_info')->first();
        $info_post = $info_post->translate(App::getLocale(), 'pl');
        $posts = Po::where('type', 'home_posts')->whereDoesntHave('pages')->take(3)->get();
        $posts = $posts->translate(App::getLocale(), 'pl');
        return view('home', compact('banner', 'posts', 'info_post', 'color_config'));
    }

    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'email|required',
            'name' => 'required|min:3',
            'content' => 'required|min:10'
        ]);
        if(!setting('site.contact_email')) return response()->json(['errors' => ['error' => ['Ta strona nie ma skonfigurowanej skrzynki email']]], 400);
        \Illuminate\Support\Facades\Mail::to(setting('site.contact_email'))->send(new Mail\ContactMail($request));
        return response()->json(true);
    }
    public function getColors(Request $request){
        $colors = BagColor::whereHas('pages', function ($q)use($request){
            $q->where('page_id', $request->page_id);
        })->get();
        return response()->json($colors);
    }
}
