<?php
/** Inline SVG icons. */
function icon(string $name, string $class = 'w-5 h-5'): string
{
    $paths = [
        'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.6" fill="currentColor"/>',
        'whatsapp'  => '<path d="M20.5 11.6a8.5 8.5 0 0 1-12.6 7.4L3.5 20.5l1.5-4.3A8.5 8.5 0 1 1 20.5 11.6Z"/><path d="M9 8.5c0 3.6 2.9 6.5 6.5 6.5l1-1.6-2-1-1 .8a4.6 4.6 0 0 1-2.7-2.7l.8-1-1-2L9 8.5Z" fill="currentColor" stroke="none"/>',
        'tiktok'    => '<path d="M14 3v11.5a3.5 3.5 0 1 1-3.5-3.5"/><path d="M14 3c.5 2.6 2.4 4.4 5 4.6"/>',
        'mail'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 7 8.5-7"/>',
        'phone'     => '<path d="M5 3.5h3.2l1.6 4.2-2 1.3a11 11 0 0 0 5.2 5.2l1.3-2 4.2 1.6V17a2 2 0 0 1-2 2A15.5 15.5 0 0 1 3 5.5a2 2 0 0 1 2-2Z"/>',
        'pin'       => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/>',
        'arrow'     => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'arrow-up'  => '<path d="M12 19V5M6 11l6-6 6 6"/>',
        'close'     => '<path d="M6 6l12 12M18 6 6 18"/>',
        'prev'      => '<path d="M15 6l-6 6 6 6"/>',
        'next'      => '<path d="M9 6l6 6-6 6"/>',
    ];
    $p = $paths[$name] ?? '';
    return '<svg class="' . $class . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg>';
}

/** FC monogram logo. */
function logo_mark(string $class = 'w-10 h-10'): string
{
    return '<svg class="' . $class . '" viewBox="0 0 64 64" aria-hidden="true">'
        . '<circle cx="32" cy="32" r="30.5" fill="none" stroke="currentColor" stroke-width="1"/>'
        . '<circle cx="32" cy="32" r="26.5" fill="none" stroke="currentColor" stroke-width="0.5" opacity=".45"/>'
        . '<text x="25" y="42" text-anchor="middle" font-family="Instrument Serif, Georgia, serif" font-size="30" fill="currentColor">F</text>'
        . '<text x="38" y="44" text-anchor="middle" font-family="Instrument Serif, Georgia, serif" font-style="italic" font-size="30" fill="var(--accent, #c9a46c)">C</text>'
        . '</svg>';
}
