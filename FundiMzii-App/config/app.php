<?php

return [
    /*
     * FundiMzii Application Configuration
     */

    'name' => 'FundiMzii',
    'version' => '1.0.0',
    'description' => 'Web-Based Application for Recording and Tracing Client Measurements for Tailors',

    /*
     * Application Settings
     */
    'app' => [
        'timezone' => 'Africa/Nairobi',
        'locale' => 'en',
        'fallback_locale' => 'en',
        'currency' => 'KES',
        'currency_symbol' => 'KES ',
    ],

    /*
     * Features Configuration
     */
    'features' => [
        'offline_mode' => true,
        'photo_upload' => true,
        'pdf_export' => true,
        'reports' => true,
        'search' => true,
    ],

    /*
     * File Upload Configuration
     */
    'uploads' => [
        'photos' => [
            'max_size' => 2048, // KB
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif'],
            'directory' => 'measurements',
        ],
    ],

    /*
     * Measurement Units
     */
    'measurements' => [
        'unit' => 'cm',
        'unit_label' => 'Centimeters',
        'fields' => [
            'chest' => 'Chest',
            'waist' => 'Waist',
            'hip' => 'Hip',
            'length' => 'Length',
            'sleeve_length' => 'Sleeve Length',
            'shoulder_width' => 'Shoulder Width',
            'inseam' => 'Inseam',
        ],
    ],

    /*
     * Order Statuses
     */
    'order_statuses' => [
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    /*
     * Pagination
     */
    'pagination' => [
        'per_page' => 20,
        'clients_per_page' => 20,
        'orders_per_page' => 10,
        'measurements_per_page' => 10,
    ],

    /*
     * Reports Configuration
     */
    'reports' => [
        'recent_clients_count' => 5,
        'recent_orders_count' => 10,
        'show_statistics' => true,
        'show_charts' => true,
    ],

    /*
     * PDF Export Settings
     */
    'pdf' => [
        'paper_size' => 'A4',
        'orientation' => 'portrait',
        'margin_top' => 10,
        'margin_bottom' => 10,
        'margin_left' => 10,
        'margin_right' => 10,
        'font_size' => 10,
    ],

    /*
     * Language Support
     */
    'languages' => [
        'en' => [
            'name' => 'English',
            'flag' => '🇬🇧',
        ],
        'sw' => [
            'name' => 'Kiswahili',
            'flag' => '🇰🇪',
        ],
    ],

    /*
     * Email Configuration (for future notifications)
     */
    'mail' => [
        'from' => 'noreply@fundimzii.local',
        'reply_to' => 'support@fundimzii.local',
    ],

    /*
     * Security Configuration
     */
    'security' => [
        'password_min_length' => 8,
        'session_timeout' => 3600, // seconds
        'remember_me_duration' => 30, // days
    ],

    /*
     * Development Settings
     */
    'debug' => [
        'show_errors' => true,
        'log_level' => 'debug',
        'enable_profiling' => false,
    ],

    /*
     * Branding
     */
    'branding' => [
        'logo_url' => '/img/logo.png',
        'favicon_url' => '/img/favicon.ico',
        'primary_color' => '#0d6efd',
        'secondary_color' => '#6c757d',
    ],

    /*
     * Contact Information
     */
    'contact' => [
        'email' => 'support@fundimzii.local',
        'phone' => '+254 (TBD)',
        'website' => 'www.fundimzii.local',
    ],
];
?>
