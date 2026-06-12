<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $team = [
            ['name' => 'Marcus Vance', 'role' => 'Chief Executive Officer', 'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=300'],
            ['name' => 'Sophia Lin', 'role' => 'VP of Smart Infrastructure', 'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=300'],
            ['name' => 'Devon Carter', 'role' => 'Director of Product Engineering', 'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=300'],
        ];

        $awards = [
            ['year' => '2025', 'title' => 'Green Mobility Innovation Award', 'issuer' => 'Urban Transit Group'],
            ['year' => '2024', 'title' => 'Best Smart City Infrastructure Project', 'issuer' => 'Metro Planning Council'],
            ['year' => '2023', 'title' => 'Top Customer Experience Design', 'issuer' => 'Product Design Forum'],
        ];

        return view('about', compact('team', 'awards'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function faq()
    {
        $faqs = [
            'booking' => [
                ['q' => 'How early can I book a parking spot?', 'a' => 'You can book up to 30 days in advance on our website. Early bookings often get the best pricing options.'],
                ['q' => 'Can I cancel or modify my reservation?', 'a' => 'Yes, reservations can be cancelled up to 2 hours before your scheduled entry time for a full refund. Simply visit your dashboard or link in the booking email.'],
            ],
            'payments' => [
                ['q' => 'What payment methods do you accept?', 'a' => 'We accept all major credit cards (Visa, Mastercard, American Express), Apple Pay, and Google Pay.'],
                ['q' => 'Is my payment secure?', 'a' => 'Absolutely. We use industry-standard SSL encryption and point-to-point tokenization to secure your billing details. We never store raw card numbers.'],
            ],
            'security' => [
                ['q' => 'Are the parking structures secure?', 'a' => 'Yes, our premium lots feature 24/7 CCTV surveillance, automated license plate recognition, and on-site patrols or security attendants.'],
            ]
        ];

        return view('faq', compact('faqs'));
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'requirement' => 'required|string',
            'message' => 'required|string|min:10|max:1000',
        ]);

        // Simulating email sending or DB storage
        return back()->with('success', 'Thank you for your message! Our parking support team will contact you shortly.');
    }
}
