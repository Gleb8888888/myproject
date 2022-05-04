<?php

namespace App\Http\Controllers;

//use Illuminate\Database\QueryException;
use App\Models\Contact;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Symfony\Component\HttpKernel\Event\RequestEvent;

class MainController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function review()
    {
        $reviews = new Contact();
        return view('review', ['reviews' => $reviews->all()]);
    }

    public function review_check(Request $request)
    {
        $valid = $request->validate([
            'email' => 'required|min:4|max:100', // required- обяз-е для заполн-я
            'subject' => 'required|min:4|max:100',
            'message' => 'required|min:15|max:500',
        ]);
        $review = new Contact();
        $review->email = $request->input('email');
        $review->subject = $request->input('subject');
        $review->message = $request->input('message');
        $review->save();

        return redirect()->route('review');
    }
}
