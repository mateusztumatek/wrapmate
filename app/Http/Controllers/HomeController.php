<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Mail;
use App\Page;
use App\Po;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

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
    public function contact(Request $request){
        $page = Page::where('slug', 'kontakt')->first();
        if(!$page) return Redirect::back()->withErrors(['Nie ma takiej strony']);
        $faqs = Faq::all();
        $faqs = $faqs->groupBy('group');

        return view('page.contact', compact('page', 'faqs'));
    }
    public function index()
    {


        $info_post = Po::where('type', 'home_info')->first();
        if($info_post){
            $info_post = $info_post->translate(App::getLocale(), 'pl');
        }

        $posts = Po::where('type', 'home_posts')->whereDoesntHave('pages')->take(3)->get();
        $posts = $posts->translate(App::getLocale(), 'pl');
        $second_post = Po::where('type', 'home_info')->first();
        if($second_post) $second_post->translate(App::getLocale(), 'pl');
        return view('home', compact('banner', 'posts', 'second_post'));
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
    public function message(Request $request){
        $request->validate([
            'topic' => 'required',
            'email' => 'required|email',
            'content' => 'required|min:3'
        ]);
        \Illuminate\Support\Facades\Mail::to(setting('site.email'))->send(new Mail\ContactMail($request->all()));
        return response()->json(true);
    }
}
