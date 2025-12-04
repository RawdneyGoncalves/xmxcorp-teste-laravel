<?php

namespace App\Presentation\Helpers;

class TagHelper
{
    public static function parseTags($tags): array
    {
        if (empty($tags)) {
            return [];
        }

        if (is_array($tags)) {
            return $tags;
        }

        if (is_string($tags)) {
            $decoded = json_decode($tags, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    public static function formatTags($tags): string
    {
        if (is_array($tags) && !empty($tags)) {
            return json_encode($tags);
        }

        return '';
    }
}
