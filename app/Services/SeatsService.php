<?php
namespace App\Services;

use App\Http\Requests\AvailableSeatRequest;
use App\Models\TripStations;
use App\Models\Trip;
class SeatsService{


    public function getAvailableSeats(AvailableSeatRequest $request)
    {
        $from_station=$request->from_station_id;
        $to_station=$request->to_station_id;

       
       
        $trips = Trip::WhereHas('tripStations',function($query)use ($from_station,$to_station) {
                    $query->where('station_id', $from_station);
                })->WhereHas('tripStations',function($query)use ($to_station) {
                    $query->where('station_id', $to_station);
                })->pluck('id');
        $availableSeats=[];
        $tripsAvailableSeats=[];
        foreach($trips as $trip)
        {   
            $startStation=TripStations::where('trip_id',$trip)->where('station_id',$from_station)->first();
            $endStation=TripStations::where('trip_id',$trip)->where('station_id',$to_station)->first();
            $allBookings=getTripBookings($trip)->groupBy('seat_id');
            foreach($allBookings as $key=>$seat)
                 {     
                    if(checkSeatReservations($seat,$startStation,$endStation,$trip))              
                    {
                        $availableSeats[]=$key;
                       
                    }   
                    
                }
                $tripsAvailableSeats[] = [
                    $trip => $availableSeats,   
                 ];  
        }

        return responseSuccess($tripsAvailableSeats);
    }

 
}