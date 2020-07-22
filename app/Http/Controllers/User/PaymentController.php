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
        
        // Initialize payment
        $paymentRecord = new Payment();
        $exist = Apartment::where('id', $id )->exists(); 

        // Read values
        $radioChecked = Sponsorship::find($data['radioVal']); // Read from the radio
        $duration = $radioChecked->duration;

        // Set new dates
        $newExpiry = Carbon::now()->addHour($duration);

        // Set values for payment record
        $paymentRecord->update([
            'apartment_id' => $id,
            'sponsorship_id' => $data['radioVal'],
            'expiration_date' => $newExpiry,
        ]);

        if($exist){ // se esiste
            $actualExpiry = new Carbon(Apartment::where('id', $id )->value('sponsorship_expiration'));
            $active_sponsorship = Apartment::where('id', $id);

            if ($actualExpiry > now()) {
                $topupValue = $actualExpiry->addHour($duration); // aggiungo le ore della nuova sponsorizzazione
                $active_sponsorship->update(['sponsorship_expiration' => $topupValue]);
                $paymentRecord->update(['expiration_date' => $topupValue]);
            } else {
                $active_sponsorship->update(['sponsorship_expiration' => $newExpiry]);
                $paymentRecord->update(['expiration_date' => $newExpiry]);
            } 
        } else {
            $paymentRecord->save();
        }
    } 
}
