<?php

namespace App\Http\Controllers;

use App\Services\ParkingService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    protected ParkingService $parkingService;

    public function __construct(ParkingService $parkingService)
    {
        $this->parkingService = $parkingService;
    }

    public function create(Request $request)
    {
        $spotId = $request->query('parking_id') ?? $request->query('spot_id');
        if (!$spotId) {
            return redirect()->route('parking.index')->with('warning', 'Please select a parking spot first.');
        }

        $spot = $this->parkingService->getParkingById($spotId);
        if (!$spot) {
            return redirect()->route('parking.index')->with('error', 'Selected parking location is invalid.');
        }

        return view('booking.create', compact('spot'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'spot_id' => 'required|integer',
            'duration' => 'required|string',
            'ev_addon' => 'nullable|boolean',
            'wash_addon' => 'nullable|boolean',
        ]);

        $calculation = $this->parkingService->calculatePrice(
            $request->input('spot_id'),
            $request->input('duration'),
            (bool) $request->input('ev_addon', false),
            (bool) $request->input('wash_addon', false)
        );

        return response()->json($calculation);
    }

    public function store(Request $request)
    {
        $request->validate([
            'spot_id' => 'required|integer',
            'vehicle_plate' => 'required|string|min:3|max:15',
            'vehicle_type' => 'required|string',
            'duration' => 'required|string',
            'entry_date' => 'required|date|after_or_equal:today',
            'entry_time' => 'required|string',
            'payment_method' => 'required|string',
            'ev_addon' => 'nullable|string',
            'wash_addon' => 'nullable|string',
        ]);

        $spot = $this->parkingService->getParkingById($request->input('spot_id'));
        if (!$spot) {
            return back()->with('error', 'Invalid parking spot.');
        }

        // Generate fake reservation summary
        $pricing = $this->parkingService->calculatePrice(
            $request->input('spot_id'),
            $request->input('duration'),
            $request->has('ev_addon'),
            $request->has('wash_addon')
        );

        $booking = [
            'booking_reference' => 'PK-' . strtoupper(Str::random(8)),
            'spot_name' => $spot['name'],
            'address' => $spot['address'],
            'vehicle_plate' => strtoupper($request->input('vehicle_plate')),
            'vehicle_type' => ucfirst($request->input('vehicle_type')),
            'entry_datetime' => $request->input('entry_date') . ' ' . $request->input('entry_time'),
            'duration' => $pricing['duration_label'],
            'total_price' => $pricing['final_total'],
            'currency_symbol' => $pricing['currency_symbol'],
            'currency_code' => $pricing['currency_code'],
            'passcode' => rand(100000, 999999),
        ];

        // Store mock booking in session to display on confirmation view
        session(['last_booking' => $booking]);

        return redirect()->route('booking.confirm');
    }

    public function confirm()
    {
        $booking = session('last_booking');
        if (!$booking) {
            return redirect()->route('parking.index')->with('info', 'No active reservation found.');
        }

        return view('booking.confirm', compact('booking'));
    }
}
