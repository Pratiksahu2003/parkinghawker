@props([
    'title' => 'Premium Parking Management & Smart Reservations',
    'description' => 'Experience the future of parking with our premium, Apple-level automated booking engine. Find EV charging, secure CCTV garages, and valet services instantly.',
    'image' => null,
    'canonical' => null,
    'type' => 'website',
    'schema' => null
])

@php
    $siteName = 'ParkingHawker';
    $fullTitle = $title . ' | ' . $siteName;
    $canonicalUrl = $canonical ?? request()->url();
    $defaultImage = 'https://images.unsplash.com/photo-1506521788723-868151859b87?auto=format&fit=crop&q=80&w=800';
    $metaImage = $image ?? $defaultImage;
@endphp

<!-- Meta Tags -->
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:site_name" content="{{ $siteName }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $canonicalUrl }}">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $metaImage }}">

<!-- Schema Markup -->
@if($schema)
    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@else
    <!-- Default LocalBusiness Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ParkingFacility",
            "name": "ParkingHawker Premium Parking",
            "description": "Premium automated parking and EV charging reservations nationwide.",
            "url": "{{ url('/') }}",
            "logo": "{{ $defaultImage }}",
            "priceRange": "$$",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "455 Mission St",
                "addressLocality": "San Francisco",
                "addressRegion": "CA",
                "postalCode": "94105",
                "addressCountry": "US"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 37.7897,
                "longitude": -122.4014
            },
            "openingHoursSpecification": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                    "Sunday"
                ],
                "opens": "00:00",
                "closes": "23:59"
            }
        }
    </script>
@endif
