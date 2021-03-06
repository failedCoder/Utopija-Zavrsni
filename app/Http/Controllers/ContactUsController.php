<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;

use App\ContactUs;

use App\Product;

use App\Mail\ContactUsMail;

class ContactUsController extends Controller
{
    public function index()
    {
    	return view('frontend.contact');
    }
    public function store(ContactRequest $request)
    {
    	$message = ContactUs::create([
    		'name' => request('name'),
    		'email' => request('email'),
    		'message' => request('message'),
    	]);


    	$admin = 'pcoric1@outlook.com';

    	\Mail::to($admin)->send(new ContactUsMail($message));

    	session()->flash('message','Poruka je poslana!');

    	return back();
    }

    public function indexSpecific(Product $product)
    {
        return view('frontend.contactSpecific',compact('product'));
    }

    public function show()
    {
        $messages = ContactUs::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.showMessages',compact('messages'));
    }

    public function delete(ContactUs $message)
    {
       $message->delete();

       session()->flash('message','Obrisali ste poruku!');

       return redirect('/home/poruke');
    }
}
