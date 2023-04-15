<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function bookingSeat(BookingRequest $request)
    {
        return $this->bookingService->bookSeat($request);
    }
}
