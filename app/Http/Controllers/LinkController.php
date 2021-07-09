<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LinkController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }



    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('create');
    }



    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $request->merge([
            'token' => Hash::make($request->source),
        ]);
        $link = Link::create($request->all());
        return view('index', ['message' => $link->token]);
    }



    /**
     * Display the specified resource.
     *
     * @param \App\Models\Link $link
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Link $link
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Link         $link
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Link $link
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        //
    }



    public function redirect($source)
    {
        $link        = Link::whereSource($source)->first();
        $destination = $link ? $link->destination : '/';
        $link->stats()->save(
            new Stat([
                'ip'      => \request()->ip(),
            ])
        );
        return redirect($destination, 302);
    }
}
