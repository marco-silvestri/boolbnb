<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Apartment;
use App\Sponsorship;
use App\Payment;

class PaymentController extends Controller
{
    public function store_sponsorship(Request $request){
        
        $data = $request->all();
        $id = $data['apartId'];
        
        // Storia delle sponsorizzazioni
        $new_sponsorship = new Payment();
        $exist = Apartment::where('id', $id )->exists(); 

        if($exist){ // se esiste
            $actual_exp_date = DB::table('apartments')->where('id', $id )->value('sponsorship_expiration'); // stringa con il datetime
            $new_from_actual_exp_date = new Carbon($actual_exp_date); // nuova istanza di Carbon a partire da un timestamp
            $active_sponsorship = Apartment::where('id', $id);//Payment::where('apartment_id', $id);
            
            if ($new_from_actual_exp_date > now()) {
                $sponsorship_checked = Sponsorship::find($data['radioVal']);
                $duration = $sponsorship_checked->duration;
                $exp_date = Carbon::now()->addHour($duration);
                $updated_exp_date = $new_from_actual_exp_date->addHour($duration); // aggiungo le ore della nuova sponsorizzazione
                $active_sponsorship->update(['sponsorship_expiration' => $updated_exp_date]);
            } else {
                // se la sponsorizzazione è scaduta sovrascrivo il timestamp con $exp_date (il timestamp di questo istante) e sommo le ore
                $sponsorship_checked = Sponsorship::find($data['radioVal']);
                $duration = $sponsorship_checked->duration;
                $new_exp_date = Carbon::now()->addHour($duration);
                $active_sponsorship->update(['sponsorship_expiration' => $new_exp_date]);
            }
        } else {
            // se non esiste la creo
            $new_sponsorship->apartment_id = $data['apartId'];
            $new_sponsorship->sponsorship_id = $data['radioVal'];
            $sponsorship_checked = Sponsorship::find($data['radioVal']);
            $duration = $sponsorship_checked->duration;
            $exp_date = Carbon::now()->addHour($duration);
            $new_sponsorship->expiration_date = $exp_date;
            $new_sponsorship->save();
        }
    } 
}
