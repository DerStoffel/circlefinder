<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;

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
     * Show message inbox
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        $user = auth()->user();

        $items = App\PrivateMessage::where('recipient_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->get();

        return view('privatemessages.index')->with([
            'user' => $user,
            'items' => $items,
            'inbox' => true
        ]);
    }

    /**
     * Show message sent
     *
     * @return \Illuminate\Http\Response
     */
    public function sent()
    {
        $user = auth()->user();

        $items = App\PrivateMessage::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->get();

        return view('privatemessages.index')->with([
            'user' => $user,
            'items' => $items,
            'inbox' => false
        ]);
    }

    /**
     * Create private message form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $recipients = App\User::where('id', '<>', \auth()->user()->getAuthIdentifier())->get()->mapWithKeys(function($item) {
            return [$item['id'] => $item['name']];
        });

        //$this->authorize('create', \App\PrivateMessage::class);
        return view('privatemessages.create')->with([
            'recipients' => $recipients,
        ]);
    }

    /**
     * Send private message
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function send(Request $request)
    {
        $privateMessage = new App\PrivateMessage();
        $privateMessage->fill($request->all());
        $privateMessage->user_id = Auth::id();
        $privateMessage->recipient_id = $request['recipient'];
        $privateMessage->save();

        return redirect()->route('private_messages.inbox')->with('success', 'Message sent successfully.');
    }
}
