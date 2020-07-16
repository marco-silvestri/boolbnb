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
        $new_sponsorship_apartment = DB::table('apartments')->where('id', $id)->where('sponsorship_expiration');
        $exist = Payment::where('apartment_id', $id )->exists(); 

        if($exist){// se esiste
            $actual_exp_date = DB::table('payments')->where('apartment_id', $id )->value('sponsorship_expiration'); // stringa con il datetime
            $new_from_actual_exp_date = new Carbon($actual_exp_date); // nuova istanza di Carbon a partire da un timestamp
            $active_sponsorship = Payment::where('apartment_id', $id);
            $active_sponsorship_app = Apartment::where('id', $id);//Payment::where('apartment_id', $id);
            
            if ($new_from_actual_exp_date > now()) {
                $sponsorship_checked = Sponsorship::find($data['radioVal']);
                $duration = $sponsorship_checked->duration;
                $exp_date = Carbon::now()->addHour($duration);
                $updated_exp_date = $new_from_actual_exp_date->addHour($duration); // aggiungo le ore della nuova sponsorizzazione
                $active_sponsorship->update(['sponsorship_expiration' => $updated_exp_date]);
                $active_sponsorship_app->update(['sponsorship_expiration' => $updated_exp_date]);
            } else {
                // se la sponsorizzazione è scaduta sovrascrivo il timestamp con $exp_date (il timestamp di questo istante) e sommo le ore
                $sponsorship_checked = Sponsorship::find($data['radioVal']);
                $duration = $sponsorship_checked->duration;
                $new_exp_date = Carbon::now()->addHour($duration);
                $active_sponsorship->update(['sponsorship_expiration' => $new_exp_date]);
                $active_sponsorship_app->update(['sponsorship_expiration' => $new_exp_date]);
            }
        } else {
            // se non esiste la creo
            $new_sponsorship->apartment_id = $data['apartId'];
            $new_sponsorship->sponsorship_id = $data['radioVal'];
            $sponsorship_checked = Sponsorship::find($data['radioVal']);
            $duration = $sponsorship_checked->duration;
            $exp_date = Carbon::now()->addHour($duration);
            $new_sponsorship_apartment->sponsorship_expiration = $exp_date;
            $new_sponsorship->sponsorship_expiration  = $exp_date;
            $new_sponsorship->save();
            $new_sponsorship_apartment->update(['sponsorship_expiration' => $exp_date]);
        }
    } 
}
