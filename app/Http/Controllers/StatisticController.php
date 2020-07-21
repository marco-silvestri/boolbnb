<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Message;
use App\Statistic;
use App\Charts\StatisticChart;

class StatisticController extends Controller
{
    public function index()
    {
        $totalView = 0;
        $statisticView[] = Apartment::where('view_count', 0)
                                ->get()
                                ->pluck('view_count','created_at');

        if(count($statisticView) == 0){
            $totalView = 0;
            return view('pages.user.statistic.index', compact('totalView'));
        }
        foreach($statisticView as $view){
            if(count($view) != 0){
                foreach($view as $item){

                    $totalView ++;
                }
            }else{
                $totalView = 0;
            }
        }
       // return view('pages.user.statistic.index', compact('statisticView','totalView'));

        $totalMex = 0;
        $statisticMex[] = Message::where('apartment_id', '!=' , 0)
                                    ->get()
                                    ->pluck('apartment_id','created_at');
        if(count($statisticMex) == 0){
            $totalMex = 0;
            return view('pages.user.statistic.index', compact('totalMex'));
        }
        foreach($statisticMex as $message){
            if(count($message) != 0){
                foreach($message as $item){
                    $totalMex ++;
                }
            }else{
                $totalMex = 0;
            }
        }
        //return view('pages.user.statistic.index', compact('statisticMex','totalMex'));

        $statisticChart = new StatisticChart;
        $statisticChart->labels(['Jan', 'Feb', 'Mar']);
        $statisticChart->dataset('Users by trimester', 'bar', [10, 25, 13]);
        return view('pages.user.statistic.index', [ 'statisticChart' => $statisticChart ] );
       
       
       
       
       
        $StatisticChart->labels([$StatisticView->random()]);
        $StatisticChart->dataset('Messages', 'bar', [$statisticView->random()])
            ->BackgroundColor('red');

            $statisticChartM->dataset('views', 'bar', [$statisticMex->random()])
            ->BackgroundColor('green');

        return view('pages.user.statistic.index',compact('totalView','totalMex'),['Aid' => $Aid]);
    }
}
