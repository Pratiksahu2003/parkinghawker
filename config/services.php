<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google_adsense' => [
        'client' => env('ADSENSE_CLIENT_ID', 'ca-pub-2075682642541479'),
        'default_slot' => env('ADSENSE_DEFAULT_SLOT', '8842795632'),
        'force_show' => filter_var(env('ADSENSE_FORCE_SHOW', false), FILTER_VALIDATE_BOOLEAN),
        'slots' => [
            'welcome_bottom_banner' => env('ADSENSE_SLOT_WELCOME_BOTTOM', '8842795632'),
            'location_page_mid' => env('ADSENSE_SLOT_LOCATION_MID', '8842795632'),
            'location_page_sidebar_top' => env('ADSENSE_SLOT_LOCATION_SIDEBAR_TOP', '8842795632'),
            'location_page_sidebar_bottom' => env('ADSENSE_SLOT_LOCATION_SIDEBAR_BOTTOM', '8842795632'),
            'parking_detail_mid' => env('ADSENSE_SLOT_PARKING_DETAIL_MID', '8842795632'),
            'parking_detail_sidebar_top' => env('ADSENSE_SLOT_PARKING_DETAIL_SIDEBAR_TOP', '8842795632'),
            'parking_detail_sidebar_bottom' => env('ADSENSE_SLOT_PARKING_DETAIL_SIDEBAR_BOTTOM', '8842795632'),
            'parking_show_middle' => env('ADSENSE_SLOT_PARKING_SHOW_MIDDLE', '8842795632'),
            'parking_index_top_banner' => env('ADSENSE_SLOT_PARKING_INDEX_TOP', '8842795632'),
            'terms_top_banner' => env('ADSENSE_SLOT_TERMS_TOP', '8842795632'),
            'terms_middle_banner' => env('ADSENSE_SLOT_TERMS_MID', '8842795632'),
            'refund_top_banner' => env('ADSENSE_SLOT_REFUND_TOP', '8842795632'),
            'refund_middle_banner' => env('ADSENSE_SLOT_REFUND_MID', '8842795632'),
            'privacy_top_banner' => env('ADSENSE_SLOT_PRIVACY_TOP', '8842795632'),
            'privacy_middle_banner' => env('ADSENSE_SLOT_PRIVACY_MID', '8842795632'),
            'home_top_banner' => env('ADSENSE_SLOT_HOME_TOP', '8842795632'),
            'home_bottom_banner' => env('ADSENSE_SLOT_HOME_BOTTOM', '8842795632'),
            'faq_bottom_banner' => env('ADSENSE_SLOT_FAQ_BOTTOM', '8842795632'),
            'contact_bottom_banner' => env('ADSENSE_SLOT_CONTACT_BOTTOM', '8842795632'),
            'blog_show_top' => env('ADSENSE_SLOT_BLOG_SHOW_TOP', '8842795632'),
            'blog_show_bottom' => env('ADSENSE_SLOT_BLOG_SHOW_BOTTOM', '8842795632'),
            'blog_index_top_banner' => env('ADSENSE_SLOT_BLOG_INDEX_TOP', '8842795632'),
            'about_middle_banner' => env('ADSENSE_SLOT_ABOUT_MIDDLE', '8842795632'),
            'career_bottom_banner' => env('ADSENSE_SLOT_CAREER_BOTTOM', '8842795632'),
            'cities_bottom_banner' => env('ADSENSE_SLOT_CITIES_BOTTOM', '8842795632'),
            'event_mid_banner' => env('ADSENSE_SLOT_EVENT_MID', '8842795632'),
            'event_bottom_banner' => env('ADSENSE_SLOT_EVENT_BOTTOM', '8842795632'),
            'free_mid_banner' => env('ADSENSE_SLOT_FREE_MID', '8842795632'),
            'free_bottom_banner' => env('ADSENSE_SLOT_FREE_BOTTOM', '8842795632'),
            'monthly_mid_banner' => env('ADSENSE_SLOT_MONTHLY_MID', '8842795632'),
            'monthly_bottom_banner' => env('ADSENSE_SLOT_MONTHLY_BOTTOM', '8842795632'),
            'paid_mid_banner' => env('ADSENSE_SLOT_PAID_MID', '8842795632'),
            'paid_bottom_banner' => env('ADSENSE_SLOT_PAID_BOTTOM', '8842795632'),
            'rent_mid_banner' => env('ADSENSE_SLOT_RENT_MID', '8842795632'),
            'rent_bottom_banner' => env('ADSENSE_SLOT_RENT_BOTTOM', '8842795632'),
            'valet_mid_banner' => env('ADSENSE_SLOT_VALET_MID', '8842795632'),
            'valet_bottom_banner' => env('ADSENSE_SLOT_VALET_BOTTOM', '8842795632'),
            'press_bottom_banner' => env('ADSENSE_SLOT_PRESS_BOTTOM', '8842795632'),
            'review_bottom_banner' => env('ADSENSE_SLOT_REVIEW_BOTTOM', '8842795632'),
        ]
    ],

];
