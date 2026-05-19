<?php

namespace App\Helpers;

class ThemeHelper
{
    /**
     * Convert Hex to HSL.
     */
    public static function hexToHsl(string $hex): array
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        $h = 0;
        $s = 0;
        $l = ($max + $min) / 2;

        if ($max !== $min) {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }

            $h /= 6;
        }

        return [
            'h' => $h * 360,
            's' => $s * 100,
            'l' => $l * 100,
        ];
    }

    /**
     * Convert HSL to Hex.
     */
    public static function hslToHex(float $h, float $s, float $l): string
    {
        $h /= 360;
        $s /= 100;
        $l /= 100;

        $r = $l;
        $g = $l;
        $b = $l;

        $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);

        if ($v > 0) {
            $m = $l + $l - $v;
            $sv = ($v - $m) / $v;
            $h *= 6.0;
            $sextant = floor($h);
            $fract = $h - $sextant;
            $vsf = $v * $sv * $fract;
            $mid1 = $m + $vsf;
            $mid2 = $v - $vsf;

            switch ($sextant) {
                case 0:
                    $r = $v;
                    $g = $mid1;
                    $b = $m;
                    break;
                case 1:
                    $r = $mid2;
                    $g = $v;
                    $b = $m;
                    break;
                case 2:
                    $r = $m;
                    $g = $v;
                    $b = $mid1;
                    break;
                case 3:
                    $r = $m;
                    $g = $mid2;
                    $b = $v;
                    break;
                case 4:
                    $r = $mid1;
                    $g = $m;
                    $b = $v;
                    break;
                case 5:
                    $r = $v;
                    $g = $m;
                    $b = $mid2;
                    break;
            }
        }

        return sprintf(
            "#%02x%02x%02x",
            round($r * 255),
            round($g * 255),
            round($b * 255)
        );
    }

    /**
     * Convert hex to raw RGB string (e.g., "12 137 235").
     */
    public static function hexToRgbString(string $hex): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        return "$r $g $b";
    }

    /**
     * Generate 50 to 950 shades based on a single base hex color.
     */
    public static function generateShades(string $baseHex): array
    {
        $hsl = self::hexToHsl($baseHex);
        $h = $hsl['h'];
        $s = $hsl['s'];
        $baseL = $hsl['l'];

        // Define target lightness values for Tailwind shades
        $shadeLightness = [
            50 => 97,
            100 => 93,
            200 => 85,
            300 => 74,
            400 => 62,
            500 => $baseL, // Use exact base color lightness for shade 500
            600 => max(5, $baseL - ($baseL - 10) * 0.2), // progressive darkening
            700 => max(5, $baseL - ($baseL - 10) * 0.4),
            800 => max(5, $baseL - ($baseL - 10) * 0.6),
            900 => max(5, $baseL - ($baseL - 10) * 0.8),
            950 => max(2, $baseL - ($baseL - 5) * 0.9),
        ];

        $shades = [];
        foreach ($shadeLightness as $shade => $l) {
            $adjS = $s;
            if ($shade < 300) {
                $adjS = min(100, $s * 1.1);
            } elseif ($shade > 700) {
                $adjS = min(100, $s * 0.95);
            }
            
            if ($shade === 500) {
                $shades[$shade] = $baseHex;
            } else {
                $shades[$shade] = self::hslToHex($h, $adjS, $l);
            }
        }

        return $shades;
    }
}
