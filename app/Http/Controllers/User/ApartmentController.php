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
use App\Payment;
use App\Charts\StatisticChart;
use Carbon\Carbon;



class ApartmentController extends Controller
{
    //Show all apartments for the logged user
    public function index(){
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        
        //Retrieve all his apartments
        $apartmentsForUser = Apartment::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(7);
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

    public function messageIndex(){

        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        $totalMex = 0;
        $feedBack = 0;

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
    return view('pages.user.message.index', compact('messageForApartment', 'user_id', 'user_name','mex')); 
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
        $request->validate($this->validationImg());

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
        $payments = Payment::all();
        $now = Carbon::now();
        $message = Message::where('apartment_id', $apartment->id)->count();
        
        if (empty($apartment)) {
            abort('404');
        }
        
        $total_views = $apartment->view_count += 1;
        $apartment->update(['view_count' => $total_views]);
		
        $message = Message::where('apartment_id', $apartment->id)->count();                      
        $tot_view_count = Apartment::all()->sum('view_count');
        $message1 = Message::where('apartment_id',  $apartment->id)->where('created_at','>=',date('2020-07-10'))->count();
        $data=date_create(date('Y-m-d H:i:s',));
        $tot_mex_for_month=array();
        setlocale(LC_TIME, 'en', 'en_EN');
        $labels = [];
        for ($i=0; $i < 12; $i++) { 
            $data_end_month= clone $data;
            $data_end_month->modify('first day of');
            $labels[]=strftime("%B %Y",date_timestamp_get($data_end_month));
            $data->modify('last day of');
            date_add($data, date_interval_create_from_date_string('1 day'));
            $message1 = Message::where('apartment_id', $apartment->id)->where('created_at','<=',$data)->where('created_at','>=', $data_end_month)->count();
            $tot_mex_for_month[]=$message1 ;
        }
        
        //$tot_mex_for_month= array_reverse($tot_mex_for_month);
        //print_r($tot_messaggi_per_mes);
		$statisticChart = new StatisticChart;
        $statisticChart->labels($labels, 'highcharts');
        $statisticChart->dataset('Message', 'bar', $tot_mex_for_month)
        ->BackgroundColor(['#5DA2D5','','#F3d250','#5DA2D5','#F3d250','#5DA2D5','#F3d250','#5DA2D5','#F3d250','#5DA2D5','#F3d250','#5DA2D5',]);
        $statisticChart->options([
            'scales' => [
                'yAxes' => [
                    [
                        'display'=>false,
                        'gridLines' => [
                        'display' => false
                        ]
                    ]
                ],
                'xAxes' => [
                    [
                        'gridLines' => [
                            'display' => false
                        ]
                    ]
                ]
            ]
        ]);
       

        $statisticView = new StatisticChart;
        $statisticView->labels(['views of your apartment','views of all apartments']);
        $statisticView->dataset('Views', 'pie', [$total_views,$tot_view_count - $total_views])
        ->BackgroundColor(['#5DA2D5','#F3d250']);
        $statisticView->options([
            'scales' => [
                'yAxes' => [
                    [
                        'display'=>false,
                        'gridLines' => [
                            'display' => false
                        ]
                    ]
                ]
            ]
        ]);
        
        return view('pages.show', compact('apartment', 'sponsorships','message','payments','statisticChart','statisticView'));
		

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

        $latLong = geoCode('plZON97PJS4T', 
        '485e6334a610b0b3d89ac65d5c4ca0a4', 
        $data['address']);
                
        $data['lat'] = $latLong['lat'];
        $data['long'] = $latLong['lng'];

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

    private function validationImg()
    {
        return[
            'img' => 'required|image',
        ];
    }
    
}
