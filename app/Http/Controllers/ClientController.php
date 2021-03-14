<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client)
    {
        return Client::find($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->all());
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Client::destroy($id);
    }

    /**
     * 	Display all the clients with an outstanding loan balance arranged by name
     *
     * @return \Illuminate\Http\Response
     */
    public function balance() {
        return Client::where('loan', '>', 0)->orderBy('name')->get();
    }

    /**
     * 	Display all the clients' names and dividends
     *  the dividend is computed by 2.3% of their total capitalization
     *
     * @return \Illuminate\Http\Response
     */
    public function dividend(){
        $clients = Client::get();

        return $clients->map(function($clients){
                    $dividend = $clients->capitalization * 0.023;
                    $clients->setRelation('dividend', $dividend);
                    return $clients->only(['name', 'capitalization', 'dividend']);
                });
        ;


    }

    public function deposit(Request $request, $client){
        $findClient = Client::find($client);
        $findClient->update(['capitalization' => $findClient->capitalization + $request->amount]);
        return $client;
    }
}
