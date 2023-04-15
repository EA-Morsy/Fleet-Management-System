<?php
namespace App\Services;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\TripStations;
use Illuminate\Support\Facades\Auth;


class BookingService{

public function bookSeat( BookingRequest $request)
{
    $from_station=$request->from_station_id;
    $to_station=$request->to_station_id;

    $startStation=TripStations::where('trip_id',$request->trip_id)->where('station_id',$from_station)->first();
    $endStation=TripStations::where('trip_id',$request->trip_id)->where('station_id',$to_station)->first();
   
    //check if the requested trip is included within the main trip

     $trip = Trip::with('tripStations')->where('id',$request->trip_id)->whereHas('tripStations', function ($query) use ($from_station) {
        $query->where('station_id', $from_station);
    })->whereHas('tripStations', function ($query) use ($to_station) {
        $query->where('station_id', $to_station);
    })->first();
    if(!$trip)
    {
        return responseFail('Your Destination is not supported in the givin trip');
    }

    //check if there's an available seats
    $allBookings=getTripBookings($request->trip_id)->groupBy('seat_id');

    if(count($allBookings) < 12)
    { 
        $availableSeat=$this->getNextAvailableSeats($request->trip_id);
        $booking=new Booking();
        $booking->user_id=Auth::user()->id;
        $booking->seat_id=$availableSeat;
        $booking->trip_id=$trip->id;
        $booking->bus_id=$trip->bus_id;
        $booking->from_station_id=$from_station;
        $booking->to_station_id=$to_station;
        $booking->save();
        return responseSuccess($booking);
    }else{
       foreach($allBookings as $key=>$seat)
       {     
           if(checkSeatReservations($seat,$startStation,$endStation,$request->trip_id))
           {
                $booking=new Booking();
                $booking->user_id=Auth::user()->id;
                $booking->seat_id=$key;
                $booking->trip_id=$trip->id;
                $booking->bus_id=$trip->bus_id;
                $booking->from_station_id=$from_station;
                $booking->to_station_id=$to_station;
                $booking->save();
                return responseSuccess($booking);
           }        
       }
       return responseFail('no available seat for your trip');
    }

    return $request;
}

public function getNextAvailableSeats($trip_id)
{
    $tripSeats=Seat::pluck('id')->toArray();
    $bookedSeats=Booking::where('trip_id',$trip_id)->pluck('seat_id')->toArray();
    $availableSeats=array_diff($tripSeats,$bookedSeats);
   return $nextAvailableSeat=reset($availableSeats);
}


}