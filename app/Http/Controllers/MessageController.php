<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Apartment;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
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

        if ($hasSaved) {
            if(Auth::check()){
                return redirect()->route('user.apartment.show' , compact('apartment'))->with('hasSaved', $newMessage);
            }else{
                return redirect()->route('guest.apartment.show' , compact('apartment'))->with('hasSaved', $newMessage);
            }
        };
    }

    private function validationRules()
    {
        return[
            'email' => 'required',
            'title' => 'required',
            'body' => 'required',
        ];
    }
}
