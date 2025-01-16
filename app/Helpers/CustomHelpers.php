<?php

if (!function_exists('formatPhoneNumber')) {
    function formatNumbers($phoneNumber): string
    {
        $charactersToRemove = ['(', ')', '-', '+', ' ','_'];
        return str_replace($charactersToRemove, '', $phoneNumber);
    }
}

if (!function_exists('truncate_by_words')) {
    function truncate_by_words($html, $maxLength, $end = '...', $isUtf8 = true): string
    {
        $output = '';
        $printedLength = 0;
        $position = 0;
        $tags = [];

        // For UTF-8, we need to count multibyte sequences as one character.
        $re = $isUtf8
            ? '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;|[\x80-\xFF][\x80-\xBF]*}'
            : '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}';

        while ($printedLength < $maxLength && preg_match($re, $html, $match, PREG_OFFSET_CAPTURE, $position))
        {
            list($tag, $tagPosition) = $match[0];

            // Print text leading up to the tag.
            $str = substr($html, $position, $tagPosition - $position);
            if ($printedLength + strlen($str) > $maxLength)
            {
                $output .= substr($str, 0, $maxLength - $printedLength);
                $printedLength = $maxLength;
                break;
            }

            $output .= $str;
            $printedLength += strlen($str);
            if ($printedLength >= $maxLength) break;

            if ($tag[0] == '&' || ord($tag) >= 0x80)
            {
                // Pass the entity or UTF-8 multibyte sequence through unchanged.
                $output .= $tag;
                $printedLength++;
            }
            else
            {
                // Handle the tag.
                $tagName = $match[1][0];
                if ($tag[1] == '/')
                {
                    // This is a closing tag.

                    $openingTag = array_pop($tags);
                    assert($openingTag == $tagName); // check that tags are properly nested.

                    $output .= $tag;
                }
                else if ($tag[strlen($tag) - 2] == '/')
                {
                    // Self-closing tag.
                    $output .= $tag;
                }
                else
                {
                    // Opening tag.
                    $output .= $tag;
                    $tags[] = $tagName;
                }
            }

            // Continue after the tag.
            $position = (int) $tagPosition + strlen($tag);
        }

        // Print any remaining text.
        if ($printedLength < $maxLength && $position < strlen($html))
            $output .= substr($html, $position, $maxLength - $printedLength);

        // Close any open tags.
        while (!empty($tags))
            $output .= '</'.array_pop($tags).'>';

        return $output . $end;
    }
}

if (!function_exists('get_setting_value_by_name')) {
    function get_setting_value_by_name(string|\App\Enums\SettingEnum $name): ?string
    {
        if ($name instanceof \App\Enums\SettingEnum)
            $name = $name->value;

        return \App\Services\SettingService::getValueByName($name);
    }
}


if (!function_exists('can_user')) {
    function can_user(string $action): bool
    {
        return request()->user()->isSuperAdmin() || request()->user()->activeSubscription()->exists() || request()->user()->can($action);
    }
}



if (!function_exists('get_highlighted_text')) {
    function get_highlighted_text(string $text, string $needle = null): string
    {
        if (!$needle)
            return $text;

        return \Str::replace(
            $needle,
            "<span class='highlighted'>{$needle}</span>",
            Str::replace(mb_ucfirst($needle), "<span class='highlighted'>".mb_ucfirst($needle)."</span>", $text),
            false);
    }
}
