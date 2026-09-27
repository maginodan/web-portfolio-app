<?php

namespace App\Helpers;

class ColorHelper
{
    public static function generateShades(string $hex): array
    {
        [$h, $s, $l] = self::hexToHsl($hex);

        // Lightness targets roughly matching Tailwind's default blue scale
        $lightnessMap = [
            50 => 97, 100 => 92, 200 => 83, 300 => 72,
            400 => 60, 500 => 48, 600 => $l, 700 => max($l - 10, 10),
            800 => max($l - 20, 8), 900 => max($l - 30, 5),
        ];

        $shades = [];
        foreach ($lightnessMap as $key => $lightness) {
            $shades[$key] = self::hslToHex($h, $s, $lightness);
        }

        return $shades;
    }

    private static function hexToHsl(string $hex): array
    {
        $hex = ltrim($hex, '#');
        [$r, $g, $b] = array_map(fn($c) => hexdec($c) / 255, str_split($hex, 2));

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;

        if ($max === $min) {
            $h = $s = 0;
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            $h = match ($max) {
                $r => (($g - $b) / $d + ($g < $b ? 6 : 0)),
                $g => ($b - $r) / $d + 2,
                $b => ($r - $g) / $d + 4,
            } / 6;
        }

        return [$h * 360, $s * 100, $l * 100];
    }

    private static function hslToHex(float $h, float $s, float $l): string
    {
        $h /= 360; $s /= 100; $l /= 100;

        if ($s == 0) {
            $r = $g = $b = $l;
        } else {
            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;
            $r = self::hueToRgb($p, $q, $h + 1/3);
            $g = self::hueToRgb($p, $q, $h);
            $b = self::hueToRgb($p, $q, $h - 1/3);
        }

        return sprintf('#%02x%02x%02x', round($r * 255), round($g * 255), round($b * 255));
    }

    private static function hueToRgb(float $p, float $q, float $t): float
    {
        if ($t < 0) $t += 1;
        if ($t > 1) $t -= 1;
        if ($t < 1/6) return $p + ($q - $p) * 6 * $t;
        if ($t < 1/2) return $q;
        if ($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
        return $p;
    }
}