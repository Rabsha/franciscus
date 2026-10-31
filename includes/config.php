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
    ['title' => 'Editorial',   'desc' => 'Magazine stories and concept shoots with a strong narrative.', 'img' => 'fc-02.jpg'],
    ['title' => 'Commercial',  'desc' => 'Brand lookbooks, e-commerce and catalogue work.',               'img' => 'fc-21.jpg'],
    ['title' => 'Campaign',    'desc' => 'Fashion and lifestyle campaigns for print and digital.',        'img' => 'fc-28.jpg'],
    ['title' => 'Swim & Fit',  'desc' => 'Swimwear, underwear and athletic brand shoots.',                'img' => 'fc-05.jpg'],
    ['title' => 'Runway',      'desc' => 'Fashion week shows, presentations and showrooms.',              'img' => 'fc-24.jpg'],
];

// Availability for the next months. Keys are 'Y-m'; anything not listed is 'available'.
// Status: available | limited | booked
$availabilityOverrides = [
    date('Y-m', strtotime('first day of +1 month')) => 'limited',
    date('Y-m', strtotime('first day of +3 months')) => 'booked',
];

$availability = [];
for ($i = 0; $i < 6; $i++) {
    $ts  = strtotime("first day of +$i months");
    $key = date('Y-m', $ts);
    $availability[] = [
        'month'  => date('M', $ts),
        'year'   => date('Y', $ts),
        'status' => $availabilityOverrides[$key] ?? 'available',
    ];
}

$locations = ['Amsterdam', 'Rotterdam', 'Paris', 'Milan', 'London', 'Worldwide travel'];

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
