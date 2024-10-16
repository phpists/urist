<?php

if (!function_exists('formatPhoneNumber')) {
    function formatNumbers($phoneNumber): string
    {
        $charactersToRemove = ['(', ')', '-', '+', ' ','_'];
        return str_replace($charactersToRemove, '', $phoneNumber);
    }
}

if (!function_exists('truncate_by_words')) {
    function truncate_by_words($text, $maxLength, $end = '...'): string
    {
        if (mb_strlen($text) <= $maxLength) {
            return $text;
        }

        // Знаходимо останнє повноцінне слово перед максимальною довжиною
        $lastSpace = mb_strrpos(mb_substr($text, 0, $maxLength), ' ');

        // Відкидаємо символи після останнього пробілу, якщо вони є
        if ($lastSpace !== false) {
            $truncatedText = mb_substr($text, 0, $lastSpace);
        } else {
            $truncatedText = mb_substr($text, 0, $maxLength);
        }

        return $truncatedText . $end;
    }
}

if (!function_exists('get_setting_value_by_name')) {
    function get_setting_value_by_name($name): string
    {
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

        return \Str::replace($needle, "<span style='background-color: yellow'>{$needle}</span>", $text);
    }
}
