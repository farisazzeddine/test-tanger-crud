<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Validator;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients =Client::all();
        return view('client',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }


    public function store(Request $request)
    {
        $validate_client = Validator::make(request()->all(),[
            'nom'       => 'required|string|max:50',
            'prenom'    => 'required|string|max:50',
            'email'     => 'required|string|max:50',
            'telephone' => 'required|numeric|min:50',
            'cin'       => 'required|string|unique:clients|max:20',
            'sex'       => 'required|boolean',
            'photo'     => 'mimes:jpeg,jpg,png,gif|required|max:4096'
        ]);

        if ($validate_client->fails()) {
            return redirect()->back()->withErrors($validate_client)->withInput();
        }

        $input = $request->all();
        $input['photo'] = $request->file('photo');
        $img_new_name = rand().'.'.$input['photo']->getClientOriginalExtension();
        $input['photo']->move(public_path('storage/img'),$img_new_name);
        $input['photo']=$img_new_name;
        $client=Client::create($input);
        if(!is_object($client)){
               return redirect()->back()->with('message','error d\'insertion');

           }
           else{
                return back()->with('message','client '.$client->nom.' '.$client->prenom. ' enregistre avec succès');
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client_edit=Client::find($id);
      return view('updateClient', compact('client_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate_client = Validator::make(request()->all(),[
            'nom'       => 'required|string|max:50',
            'prenom'    => 'required|string|max:50',
            'email'     => 'required|string|max:50',
            'telephone' => 'required|numeric|min:50',
            'cin'       => 'required|string|unique:clients|max:20',
            'sex'       => 'required|boolean',
            'photo'     => 'mimes:jpeg,jpg,png,gif|required|max:4096'
        ]);

        $input['photo']= $request->file('photo');
        $img_update= $request->hidden_img;

        if($input['photo'] != ''){
            $img_new_name = rand().'.'.$input['photo']->getClientOriginalExtension();
            $input['photo']->move(public_path('storage/img'),$img_new_name);
            $input = $request->except(['hidden_img','_token','_method']);
            $input['photo']=$img_new_name;
            Client::whereId($id)->update($input);
        }else{

            $input['photo']=$request->hidden_img;
            $input = $request->except(['hidden_img','_token','_method']);
            Client::whereId($id)->update($input);
        }
             return redirect(url('/client'))->with('message','client  modifier avec succès');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_client=Client::find($id);
        $delete_client->delete();
        return back()->with('message','client  supprimer avec succès');

    }
}
