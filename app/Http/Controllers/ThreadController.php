<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Models\Thread;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $threads = Thread::all();
        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

       $thread =  Thread::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'channel_id' => $request->channel_id
        ]);

        return redirect()->route('threads.show',[$thread->channel,$thread]);
    }

    /**
     * Display the specified resource.
     *
     * @param Channel $channel
     * @param Thread $thread
     * @return Factory|View
     */
    public function show($channel,Thread $thread)
    {
        return view('threads.show',compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Thread $thread
     * @return Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Thread $thread
     * @return Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Thread $thread
     * @return Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
