<?php

namespace App\Services;

use App\Repositories\ParkingRepositoryInterface;

class ParkingService
{
    protected ParkingRepositoryInterface $parkingRepository;

    public function __construct(ParkingRepositoryInterface $parkingRepository)
    {
        $this->parkingRepository = $parkingRepository;
    }

    public function getAllParking(): array
    {
        return $this->parkingRepository->all();
    }

    public function getParkingById($id): ?array
    {
        return $this->parkingRepository->find($id);
    }

    public function searchParking(array $filters): array
    {
        return $this->parkingRepository->search($filters);
    }

    public function getUniqueLocations(): array
    {
        return $this->parkingRepository->getUniqueLocations();
    }

    public function calculatePrice(int $spotId, string $duration, bool $evAddon = false, bool $washAddon = false): array
    {
        $spot = $this->getParkingById($spotId);
        if (!$spot) {
            return ['error' => 'Parking spot not found'];
        }

        $pricePerHour = $spot['price_per_hour'];
        $pricePerDay = $spot['price_per_day'];
        $evFee = $spot['ev_fee'] ?? 150.00;
        $washFee = $spot['wash_fee'] ?? 300.00;
        $currencySymbol = $spot['currency_symbol'] ?? '₹';
        $currencyCode = $spot['currency_code'] ?? 'INR';

        // Determine price based on duration string (e.g. "2 hours", "1 day", "3 days")
        $value = (int) filter_var($duration, FILTER_SANITIZE_NUMBER_INT);
        $value = $value > 0 ? $value : 1;

        $totalPrice = 0;
        $label = "";

        if (str_contains(strtolower($duration), 'day')) {
            $totalPrice = $pricePerDay * $value;
            $label = "$value Day(s)";
        } else {
            // Assume hours
            if ($value >= 24) {
                $days = ceil($value / 24);
                $totalPrice = $pricePerDay * $days;
                $label = "$value Hours ($days Day(s))";
            } else {
                $totalPrice = $pricePerHour * $value;
                $label = "$value Hour(s)";
            }
        }

        $evSurcharge = $evAddon ? $evFee : 0;
        $washSurcharge = $washAddon ? $washFee : 0;
        $subtotal = $totalPrice + $evSurcharge + $washSurcharge;
        $tax = round($subtotal * 0.08, 2);
        $finalTotal = round($subtotal + $tax, 2);

        return [
            'spot_id' => $spotId,
            'spot_name' => $spot['name'],
            'duration' => $duration,
            'duration_label' => $label,
            'unit_price' => $pricePerHour,
            'total_price' => $totalPrice,
            'ev_surcharge' => $evSurcharge,
            'wash_surcharge' => $washSurcharge,
            'tax' => $tax,
            'final_total' => $finalTotal,
            'currency_symbol' => $currencySymbol,
            'currency_code' => $currencyCode,
        ];
    }
}
