<?php

namespace App\Http\Controllers;

use App\Services\ParkingService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected ParkingService $parkingService;

    public function __construct(ParkingService $parkingService)
    {
        $this->parkingService = $parkingService;
    }

    public function index()
    {
        $parkingSpots = array_slice($this->parkingService->getAllParking(), 0, 3);
        $locations = $this->parkingService->getUniqueLocations();

        // Sample static stats
        $stats = [
            'total_bookings' => '142K+',
            'happy_customers' => '99.8%',
            'cities' => '12+',
            'charging_points' => '450+',
        ];

        return view('home', compact('parkingSpots', 'locations', 'stats'));
    }
}
