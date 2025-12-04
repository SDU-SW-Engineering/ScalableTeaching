<?php

namespace App\Helpers;

class GitLabNameSanitizer
{
    public static function sanitize(string $name): string
    {
        // Convert to lowercase
        $name = strtolower($name);

        // Remove accents (convert accented characters to non-accented)
        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $name);

        // Remove any characters that aren't letters, digits, _, -, or .
        $name = preg_replace('/[^a-z0-9._-]/', '', $name);

        // Replace consecutive dashes with single dash
        $name = preg_replace('/--+/', '-', $name);

        // Remove leading -, _, or .
        $name = ltrim($name, '-_.');

        // Remove trailing -, _, or .
        $name = rtrim($name, '-_.');

        // Remove .git or .atom suffixes
        $name = preg_replace('/\.(git|atom)$/', '', $name);

        return $name;
    }
}
