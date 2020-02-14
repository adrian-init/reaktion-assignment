<?php

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * Class MultiLineStrPad
 * @package App\Helpers
 */
class MultiLineStrPad
{
    /**
     * @param string $input
     * @param int $padLength
     * @param string $padString
     * @param int $padType [optional] <p>
     * Optional argument pad_type can be
     * STR_PAD_RIGHT, STR_PAD_LEFT,
     * or STR_PAD_BOTH. If
     * pad_type is not specified it is assumed to be
     * STR_PAD_RIGHT.
     * </p>
     * @param string $encoding
     * @return string
     */
    public function strPad(string $input, int $padLength, string $padString = ' ', int $padType = STR_PAD_LEFT, string $encoding = null): string
    {
        $lines = explode(PHP_EOL, $input);
        $paddedLines = array_map(function($line) use($padLength, $padString, $padType, $encoding) {
            return str_pad($line, Str::length($line, $encoding) + $padLength, $padString, $padType);
        }, $lines);

        return implode(PHP_EOL, $paddedLines);
    }
}
