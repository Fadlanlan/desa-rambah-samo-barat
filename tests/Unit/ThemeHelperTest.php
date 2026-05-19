<?php

use App\Helpers\ThemeHelper;

test('it converts hex to HSL correctly', function () {
    $hsl = ThemeHelper::hexToHsl('#0c89eb');
    
    expect($hsl)->toBeArray();
    expect($hsl)->toHaveKeys(['h', 's', 'l']);
    expect($hsl['h'])->toBeGreaterThanOrEqual(0);
    expect($hsl['h'])->toBeLessThanOrEqual(360);
    expect($hsl['s'])->toBeGreaterThanOrEqual(0);
    expect($hsl['s'])->toBeLessThanOrEqual(100);
    expect($hsl['l'])->toBeGreaterThanOrEqual(0);
    expect($hsl['l'])->toBeLessThanOrEqual(100);
});

test('it converts HSL to hex correctly', function () {
    $hex = ThemeHelper::hslToHex(207.2, 90.2, 48.2);
    
    expect($hex)->toBeString();
    expect($hex)->toMatch('/^#[0-9a-fA-F]{6}$/');
});

test('it converts hex to raw RGB string', function () {
    $rgbString = ThemeHelper::hexToRgbString('#0c89eb');
    
    expect($rgbString)->toBeString();
    expect($rgbString)->toBe('12 137 235');
});

test('it generates shades from 50 to 950', function () {
    $shades = ThemeHelper::generateShades('#0c89eb');
    
    expect($shades)->toBeArray();
    expect($shades)->toHaveCount(11);
    expect($shades)->toHaveKeys([50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950]);
    expect($shades[50])->toMatch('/^#[0-9a-fA-F]{6}$/');
    expect($shades[500])->toBe('#0c89eb'); // Shade 500 should match base hex exactly
});
