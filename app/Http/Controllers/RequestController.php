<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $response = $client->get('http://localhost/laravel/itemapi/public/api/items');
        $items = json_decode($response->getBody()->getContents());
        return view('index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'text' => 'required',
            'body' => 'required'
        ]);

        $client = new Client();
        try {
        $response = $client->post('http://localhost/laravel/itemapi/public/api/items?text='.$request->input('text').'&body='.$request->input('body'));
        } catch(RequestException $e) {
            if ($e->hasResponse()){
                $msg = $e->getResponse();
            } else {
                $msg = 'The item could not be created';
            }
            return redirect()->to('/')->with('error', $msg);
        }

        return redirect()->to('/')->with('message', 'Item successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = new Client();
        $response = $client->get('http://localhost/laravel/itemapi/public/api/items/'.$id);
        $item = json_decode($response->getBody()->getContents());

        return view('edit')->with('item',$item);
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
        $this->validate($request,[
            'text' => 'required',
            'body' => 'required'
        ]);

        $client = new Client();
        try {
        $response = $client->post('http://localhost/laravel/itemapi/public/api/items/'.$id.'?text='.$request->input('text').'&body='.$request->input('body').'&_method=PUT');
        } catch(RequestException $e) {
            if ($e->hasResponse()){
                $msg = $e->getResponse();
            } else {
                $msg = 'The item could not be created';
            }
            return redirect()->to('/')->with('error', $msg);
        }

        return redirect()->to('/')->with('message', 'Item successfully created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client();

        $response = $client->post('http://localhost/laravel/itemapi/public/api/items/'.$id.'?_method=DELETE');
        $contents = json_decode($response->getBody()->getContents());
        $success = $contents->success;

        if($success){
            return redirect()->to('/')->with('message', 'Item successfully deleted');
        } else {
            return redirect()->to('/')->with('error', 'Item could not be deleted');
        }

    }
}
