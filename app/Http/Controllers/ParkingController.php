<?php

namespace App\Http\Controllers;

use App\Services\ParkingService;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    protected ParkingService $parkingService;

    public function __construct(ParkingService $parkingService)
    {
        $this->parkingService = $parkingService;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'city', 'parking_type', 'vehicle_type', 'ev_charging', 'valet', 'security', 'sort'
        ]);

        $spots = $this->parkingService->searchParking($filters);
        $locations = $this->parkingService->getUniqueLocations();

        return view('parking.index', compact('spots', 'locations', 'filters'));
    }

    public function show($id)
    {
        $spot = $this->parkingService->getParkingById($id);
        if (!$spot) {
            abort(404, 'Parking location not found');
        }

        // Suggest other nearby spots
        $allSpots = $this->parkingService->getAllParking();
        $nearby = array_filter($allSpots, function ($item) use ($spot) {
            return $item['id'] !== $spot['id'] && $item['city'] === $spot['city'];
        });

        if (empty($nearby)) {
            $nearby = array_slice(array_filter($allSpots, function ($item) use ($spot) {
                return $item['id'] !== $spot['id'];
            }), 0, 2);
        }

        return view('parking.show', compact('spot', 'nearby'));
    }
}
