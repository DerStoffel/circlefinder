<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PrivateMessagesController extends Controller
{
    private $items_per_page = 0;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->items_per_page = config('circle.listing.items_per_page');
    }

    /**
     * Show the messages overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $items = App\PrivateMessage::where('recipient_id', $user)->orderBy('created_at', 'desc')->get();

        return view('privatemessages.index')->with([
            'user' => $user,
            'items' => $items
        ]);
    }
}
