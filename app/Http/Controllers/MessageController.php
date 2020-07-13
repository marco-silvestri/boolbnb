<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Apartment;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Apartment $apartment)
    {
        $aptId= $request['currentId'];
        $apartment = Apartment::find($aptId);
        

        $request->validate($this->validationRules());
        $data = $request->all();
        $data['apartment_id'] = $aptId;

        $newMessage = new Message();
        $newMessage->fill($data);

        $hasSaved = $newMessage->save();
        // dd($apartment);

        if ($hasSaved) {
            return redirect()->route('user.apartment.show' , compact('apartment'));
        };
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }

    private function validationRules()
    {
        return[
            'email' => 'required',
            'title' => 'required',
            'body' => 'required',
        ];
    }
}
