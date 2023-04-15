<?php
use App\Models\TripStations;
use App\Models\Booking;


 function checkSeatReservations($seat,$startStation ,$endStation,$trip_id )
{
    foreach($seat as $seatReservation)
    {
        $seat_from_stations_reservation =TripStations::where('trip_id',$trip_id)->where('station_id',$seatReservation->from_station_id)->first();
        $seat_to_stations_reservation=TripStations::where('trip_id',$trip_id)->where('station_id',$seatReservation->to_station_id)->first();
        if($startStation->order >=  $seat_to_stations_reservation->order || $endStation->order <=$seat_from_stations_reservation->order)
        {
            continue;
        }else
        {
            return false;
        }
    }
    return true;
}

 function getTripBookings($trip_id)
{
   return $bookings=Booking::where('trip_id',$trip_id)->get();
}
