<?php
/**
 * Franciscus Cornelis — site configuration.
 * Edit the values here; the page reads everything from this file.
 */

$site = [
    'name'      => 'Franciscus Cornelis',
    'first'     => 'Franciscus',
    'last'      => 'Cornelis',
    'role'      => 'Model',
    'base'      => 'Amsterdam, Holland',
    'email'     => 'bookings@franciscuscornelis.com', // placeholder — replace with the real inbox
    'phone'     => '+31 6 28742487',
    'whatsapp'  => '31628742487',                     // digits only, used for wa.me links
];

$socials = [
    ['name' => 'Instagram', 'url' => 'https://www.instagram.com/franciscusbalemans/', 'icon' => 'instagram'],
    ['name' => 'WhatsApp',  'url' => 'https://wa.me/' . $site['whatsapp'],            'icon' => 'whatsapp'],
    ['name' => 'TikTok',    'url' => '#',                                              'icon' => 'tiktok'],   // add link
    ['name' => 'Email',     'url' => 'mailto:' . $site['email'],                       'icon' => 'mail'],
];

// Comp card — placeholder measurements, update with the real ones.
$measurements = [
    'Height' => '188 cm',
    'Chest'  => '96 cm',
    'Waist'  => '76 cm',
    'Inseam' => '86 cm',
    'Shoes'  => 'EU 44',
    'Suit'   => 'EU 50',
    'Hair'   => 'Dark Brown',
    'Eyes'   => 'Brown',
];

// Portfolio. cat: editorial | fashion | swim | portrait
$gallery = [
    ['src' => 'fc-02.jpg', 'cat' => 'editorial', 'title' => 'Knit Study'],
    ['src' => 'fc-17.jpg', 'cat' => 'fashion',   'title' => 'Tailored Chaos'],
    ['src' => 'fc-31.jpg', 'cat' => 'swim',      'title' => 'Golden Hour'],
    ['src' => 'fc-14.jpg', 'cat' => 'portrait',  'title' => 'Atelier'],
    ['src' => 'fc-28.jpg', 'cat' => 'editorial', 'title' => 'Street Noir'],
    ['src' => 'fc-20.jpg', 'cat' => 'fashion',   'title' => 'Texture'],
    ['src' => 'fc-05.jpg', 'cat' => 'swim',      'title' => 'Under the Pier'],
    ['src' => 'fc-01.jpg', 'cat' => 'portrait',  'title' => 'Winter Fur'],
    ['src' => 'fc-22.jpg', 'cat' => 'editorial', 'title' => 'Leather'],
    ['src' => 'fc-19.jpg', 'cat' => 'fashion',   'title' => 'Stripes'],
    ['src' => 'fc-12.jpg', 'cat' => 'editorial', 'title' => 'Dune Stories'],
    ['src' => 'fc-23.jpg', 'cat' => 'portrait',  'title' => 'Form'],
    ['src' => 'fc-07.jpg', 'cat' => 'swim',      'title' => 'Shadow Play'],
    ['src' => 'fc-30.jpg', 'cat' => 'editorial', 'title' => 'Duet'],
    ['src' => 'fc-18.jpg', 'cat' => 'fashion',   'title' => 'Loose Ends'],
    ['src' => 'fc-03.jpg', 'cat' => 'portrait',  'title' => 'Beret'],
    ['src' => 'fc-25.jpg', 'cat' => 'editorial', 'title' => 'Raw'],
    ['src' => 'fc-11.jpg', 'cat' => 'editorial', 'title' => 'Marram Grass'],
    ['src' => 'fc-21.jpg', 'cat' => 'fashion',   'title' => 'Off Duty'],
    ['src' => 'fc-16.jpg', 'cat' => 'portrait',  'title' => 'Quiet'],
    ['src' => 'fc-08.jpg', 'cat' => 'swim',      'title' => 'Sand'],
    ['src' => 'fc-24.jpg', 'cat' => 'editorial', 'title' => 'Monochrome'],
    ['src' => 'fc-32.jpg', 'cat' => 'editorial', 'title' => 'Window Light'],
    ['src' => 'fc-27.jpg', 'cat' => 'editorial', 'title' => 'Cobblestone'],
];

// Series shown in the horizontal-scroll section.
$series = [
    ['no' => '01', 'title' => 'Dune Stories',   'meta' => 'Editorial — North Sea Coast', 'img' => 'fc-09.jpg'],
    ['no' => '02', 'title' => 'Under the Pier', 'meta' => 'Underwear — Scheveningen',    'img' => 'fc-06.jpg'],
    ['no' => '03', 'title' => 'Studio Archive', 'meta' => 'Fashion — Amsterdam',         'img' => 'fc-17.jpg'],
    ['no' => '04', 'title' => 'Street Noir',    'meta' => 'Campaign — Old Town',         'img' => 'fc-29.jpg'],
    ['no' => '05', 'title' => 'Atelier',        'meta' => 'Portrait — Studio',           'img' => 'fc-15.jpg'],
    ['no' => '06', 'title' => 'Golden Hour',    'meta' => 'Swim — Summer',               'img' => 'fc-31.jpg'],
];

$services = [
    [
        'title' => 'Editorial',
        'desc'  => 'Magazine stories and concept shoots with a strong narrative. Comfortable with experimental styling, movement and mood-driven direction.',
        'tags'  => ['Magazines', 'Concept shoots', 'Black & white', 'Beauty'],
        'img'   => 'fc-25.jpg',
    ],
    [
        'title' => 'Commercial',
        'desc'  => 'Clean, natural and on-brand. Lookbooks, e-commerce and catalogue days with fast turnarounds and a consistent look.',
        'tags'  => ['Lookbooks', 'E-commerce', 'Catalogue', 'Social content'],
        'img'   => 'fc-21.jpg',
    ],
    [
        'title' => 'Campaign',
        'desc'  => 'Fashion and lifestyle campaigns for print, digital and out-of-home. Brings character to a story while keeping the product front and centre.',
        'tags'  => ['Print', 'Digital', 'Out-of-home', 'Video'],
        'img'   => 'fc-28.jpg',
    ],
    [
        'title' => 'Swim & Fit',
        'desc'  => 'Swimwear, underwear and athletic brand shoots. Trained physique, at ease on location from beaches to the studio.',
        'tags'  => ['Swimwear', 'Underwear', 'Sportswear', 'Fitness'],
        'img'   => 'fc-05.jpg',
    ],
    [
        'title' => 'Runway',
        'desc'  => 'Fashion week shows, presentations and showrooms. Strong walk, quick fittings and calm under backstage pressure.',
        'tags'  => ['Fashion week', 'Presentations', 'Showroom', 'Fittings'],
        'img'   => 'fc-24.jpg',
    ],
];

$process = [
    ['title' => 'Enquiry',      'desc' => 'Send the brief, dates and location through the form or WhatsApp.'],
    ['title' => 'Option',       'desc' => 'Your date is held on option while details are being finalised.'],
    ['title' => 'Confirmation', 'desc' => 'Rate, usage and call sheet are agreed and the booking is confirmed.'],
    ['title' => 'Shoot day',    'desc' => 'On time, prepared and ready to create — on set or on location.'],
];

// Availability. Keys are 'YYYY-MM'; any month not listed shows as 'available'.
// Status: available | limited | booked
// The page shows the next 6 months from the visitor's current date (rendered in main.js).
$availability = [
    '2026-11' => 'limited',
    '2027-01' => 'booked',
];

$locations = ['Amsterdam', 'Rotterdam', 'Paris', 'Milan', 'London', 'Worldwide travel'];

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
