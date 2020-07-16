<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Apartment;
use App\User;
use App\Option;
use App\Message;
use App\Sponsorship;

class ApartmentController extends Controller
{
    //Show all apartments for the logged user
    public function index(){
        $user_id = Auth::id();
        $user_name = Auth::user()->name;

        //Retrieve all his apartments
        $apartmentsForUser = Apartment::where('user_id', $user_id)->get();
        $hasApartments = $this->countApartments($apartmentsForUser);
        //Set a value to adjust the views
        if ( $hasApartments ) {
            //Return the view with the value
            return view('pages.user.dashboard', compact('apartmentsForUser', 'user_id', 'user_name'))->with('hasApartments', $hasApartments); 
        } else {
            $options = Option::all();
            return view('pages.user.apartment.create', compact('options'))->with('hasApartments', $hasApartments);
        } 
    }

        public function messageIndex()
        {
            $user_id = Auth::id();
            $user_name = Auth::user()->name;
            $totalMex = 0;

            //Retrieve all his apartments
            $apartmentForUser = Apartment::where('user_id', $user_id)->get();
            if(count($apartmentForUser) == 0){
                $feedBack = 1;
                $totalMex = 0;
                return view('pages.user.message.index', compact('user_name','feedBack','totalMex'));
            }else{
                $messageForApartment=[];
            foreach($apartmentForUser as $item){
                //Retrieve all his messages for all Apartments
                $messageForApartment[]= Message::where('apartment_id', $item['id'])->get();
            }

            foreach($messageForApartment as $message){
                if(count($message) != 0){
                    foreach($message as $item){
                        $totalMex ++;
                    }
                }else{
                    $feedBack = 2;
                }
            }
            
            return view('pages.user.message.index', compact('messageForApartment', 'user_id', 'user_name','feedBack', 'totalMex')); 
            }
        }

    //Return the create view
    public function create(){

        $user_id = Auth::id();
        //Retrieve all his apartments
        $apartmentsForUser = Apartment::where('user_id', $user_id)->get();
        $hasApartments = $this->countApartments($apartmentsForUser);

        //Retrieve all the extra option and pass them to the view for printing
        $options = Option::all();

        return view('pages.user.apartment.create', compact('options'))->with('hasApartments', $hasApartments);
    }

    //Store the data passed in the create view
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $sluggable = $data['name'] . ' ' . $data['address'];
        $data['slug'] = Str::slug($sluggable, '-');

        $latLong = geoCode('plZON97PJS4T', 
        '485e6334a610b0b3d89ac65d5c4ca0a4', 
        $request);
                
        $data['lat'] = $latLong['lat'];
        $data['long'] = $latLong['lng'];

        $newApartment = new Apartment();
        $newApartment->fill($data);

        if(!empty($newApartment['img'])){
            $newApartment['img'] = Storage::disk('public')->put('images' , $newApartment['img']);
        }
        
        $hasSaved = $newApartment->save();

        if ($hasSaved) {
            if (!empty($data['options'])){
                $newApartment->options()->attach($data['options']);
            }
        }
        return redirect()->route('user.apartment.index');
    }

    //Show a single apartment
    public function show(Apartment $apartment){
      
        $sponsorships = Sponsorship::all();
        if (empty($apartment)) {
            abort('404');
        }

        return view('pages.user.apartment.show', compact('apartment', 'sponsorships'));
    }

    //Edit 
    public function edit(Apartment $apartment)
    {
        $options = Option::all();
        return view('pages.user.apartment.edit', compact('apartment','options'));
    }

    //Store the updated value
    public function update(Request $request, Apartment $apartment){   
        $request->validate($this->validationRules());
        $data = $request->all();
        //dd($data);
       
            if (!empty($data['options'])){
                $apartment->options()->sync($data['options']);
            } else {
                $apartment->options()->detach();
            }
           

        if (!empty($data['img'])) {
            //delete img
            if (!empty($apartment->img)) {
                Storage::disk('public')->delete($apartment->img);
            }
            //remplace img
            $data['img'] = Storage::disk('public')->put('images', $data['img']);
        }

        $updated = $apartment->update($data);

        if ($updated){
            return redirect()->route('user.apartment.show', $apartment->id);
        }

    }

    //Destroy the aparment and all its linked resources
    public function destroy(Apartment $apartment)
    {
        
        //Check if exists
        if (empty($apartment)){
            abort('404');
        }

        //Store some values to pass as feedback
        $oldApartment = $apartment->name;
        
        //Remove elements in the pivots
        
        $apartment->options()->detach();
        $apartment->messages()->delete();
        //Return a boolean
        $hasDeleted = $apartment->delete();

        if ($hasDeleted){
            //Retrieve all his apartments
            $user_id = Auth::id();
            $user_name = Auth::user()->name;
            $apartmentsForUser = Apartment::where('user_id', $user_id)->get();
            $hasApartments = $this->countApartments($apartmentsForUser);

            //delet image
            if (!empty($apartment->img)) {
                Storage::disk('public')->delete($apartment->img);
            }

            //Set a value to adjust the views
            if ( $hasApartments ) {
                //Return the view with the value
                return redirect()->route('user.dashboard')->with('hasDeleted', $oldApartment);
            } else {
                return redirect()->route('user.apartment.create')->with('hasDeleted', $oldApartment);
            } 
        }
    }  

    protected function countApartments($apartmentsForUser){
        
        if ( !empty($apartmentsForUser[0]) ) {
            $hasApartments = true;
        } else {
            $hasApartments = false;
        } 

        return $hasApartments;
    }
    
    private function validationRules()
    {
        return[
            'name' => 'required',
            'description' => 'required',
            'room_numbers' => 'required|numeric|min:1',
            'bathrooms' => 'required|numeric|min:1',
            'beds' => 'required|numeric|min:1',
            'square_meters' => 'required|numeric|min:1',
            'address' => 'required',
            'img' => 'image',
            'options' => 'required|min:1',
            'visibility' => 'numeric',
        ];
    }
}
