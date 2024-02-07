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
