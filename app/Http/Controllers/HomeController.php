<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use DB;
use PDF;
use Hash;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $menu = DB::table('products')->where('category', 'regular')->get();
 
        $breakfast = DB::table('products')->where('category', 'special')->where('session', 0)->get();
        $lunch     = DB::table('products')->where('category', 'special')->where('session', 1)->get();
        $dinner    = DB::table('products')->where('category', 'special')->where('session', 2)->get();

        if (Auth::user()) {
            $cart_amount = DB::table('carts')
                ->where('user_id', Auth::user()->id)
                ->where('product_order', 'no')
                ->count();
        } else {
            $cart_amount = 0;
        }

        $banners  = DB::table('banners')->get();

        return view("home", compact('menu', 'breakfast', 'lunch', 'dinner', 'cart_amount', 'banners'));
    }

    public function redirects()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        // Admin dashboard removed, redirect everyone to home
        return redirect('/');
    }

public function reservation_confirm(Request $req)
{
    $data = [];
    $data['name'] = $req->name;
    $data['email'] = $req->email;
    $data['phone'] = $req->phone;
    $data['no_guest'] = $req->no_guest;
    $data['date'] = $req->date;
    $data['time'] = $req->time;
    $data['message'] = $req->message;

    DB::table('reservations')->insert($data);

    $data['title'] = 'Reservation Confirmation';
    $data['body']  = 'Your reservation has been placed successfully.';

    $toEmail = $data['email']; // send to form email even if not login

    $pdf = PDF::loadView('mails.Reserve', $data);

    try {
        \Mail::send('mails.Reserve', $data, function ($message) use ($data, $pdf, $toEmail) {
            $message->to($toEmail)
                ->subject($data['title'])
                ->attachData($pdf->output(), 'Reservation Copy.pdf');
        });
    } catch (\Exception $e) {
        // if smtp fail, dont crash
        \Log::error('Mail send failed: ' . $e->getMessage());
    }

    return view('Reserve_order');
}

    public function rate($id)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $already_rate = DB::table('rates')
            ->where('product_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();

        $find_rate = DB::table('rates')
            ->where('product_id', $id)
            ->where('user_id', Auth::user()->id)
            ->value('star_value');

        $products = DB::table('products')->where('id', $id)->first();

        $total_rate = DB::table('rates')->where('product_id', $id)->sum('star_value');
        $total_voter = DB::table('rates')->where('product_id', $id)->count();

        if ($total_voter > 0) {
            $per_rate = $total_rate / $total_voter;
        } else {
            $per_rate = 0;
        }

        $per_rate = number_format($per_rate, 1);

        if ($already_rate > 0) {
            return view('rate_view', compact('products', 'find_rate', 'already_rate', 'total_rate', 'total_voter', 'per_rate'));
        }

        return view('rate', compact('products', 'find_rate', 'already_rate', 'total_rate', 'total_voter', 'per_rate'));
    }

    public function store_rate($value)
    {
        $product_id = Session::get('product_id');
        $user_id = Auth::user()->id;

        $data = [];
        $data['user_id'] = $user_id;
        $data['product_id'] = $product_id;
        $data['star_value'] = $value;

        $rate = DB::table('rates')
            ->where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->count();

        if ($rate > 0) {
            DB::table('rates')
                ->where('product_id', $product_id)
                ->where('user_id', $user_id)
                ->update($data);
        } else {
            DB::table('rates')->insert($data);
        }

        return view('Place_rate');
    }

    public function delete_rate()
    {
        $product_id = Session::get('product_id');
        $user_id = Auth::user()->id;

        DB::table('rates')
            ->where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->delete();

        return view('delete_rate_confirm');
    }

    public function edit_rate($id)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $find_rate = DB::table('rates')
            ->where('product_id', $id)
            ->where('user_id', Auth::user()->id)
            ->value('star_value');

        $products = DB::table('products')->where('id', $id)->first();

        $total_rate = DB::table('rates')->where('product_id', $id)->sum('star_value');
        $total_voter = DB::table('rates')->where('product_id', $id)->count();

        if ($total_voter > 0) {
            $per_rate = $total_rate / $total_voter;
        } else {
            $per_rate = 0;
        }

        $per_rate = number_format($per_rate, 1);

        return view('rate', compact('products', 'find_rate', 'total_rate', 'total_voter', 'per_rate'));
    }

    public function top_rated()
    {
        $products = DB::table('rates')->get();

        $data = [];

        foreach ($products as $product) {
            $data[$product->product_id] = 0;
        }

        foreach ($products as $product) {
            $data[$product->product_id] = $data[$product->product_id] + $product->star_value;
        }

        rsort($data);

        dd($data);
    }

    public function register(Request $req)
    {
        $data = [];
        $data['name'] = $req->name;
        $data['phone'] = $req->phone;
        $data['email'] = $req->email;
        $data['password'] = Hash::make($req->password);

        $email = DB::table('users')->where('email', $req->email)->count();
        if ($email > 0) {
            session()->flash('wrong', 'Email already registered !');
            return back();
        }

        $phone = DB::table('users')->where('phone', $req->phone)->count();
        if ($phone > 0) {
            session()->flash('wrong', 'Phone already registered !');
            return back();
        }

        if (strlen($req->password) < 8) {
            session()->flash('wrong', 'Password lenght at least 8 words!');
            return back();
        }

        if ($req->password != $req->password_confirmation) {
            session()->flash('wrong', 'Password do not match !');
            return back();
        }

        DB::table('users')->insert($data);

        return redirect('/');
    }
}
