<?php

if (!function_exists('formatPhoneNumber')) {
    function formatNumbers($phoneNumber): string
    {
        $charactersToRemove = ['(', ')', '-', '+', ' ','_'];
        return str_replace($charactersToRemove, '', $phoneNumber);
    }
}
