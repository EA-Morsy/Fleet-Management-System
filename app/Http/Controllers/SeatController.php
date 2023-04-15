<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableSeatRequest;
use Illuminate\Http\Request;
use App\Services\SeatsService;

class SeatController extends Controller
{
    //
    protected $seatService;
    public function __construct(SeatsService $seatService)
    {
        $this->seatService = $seatService;
    }

    public function getAvailableSeats(AvailableSeatRequest $request)
    {
        return $this->seatService->getAvailableSeats($request);
    }
}
