<?php

declare(strict_types=1);

namespace App;

class Validator
{
    public static function validate(string $captchaSecretKey, string $capchaResponse): int
    {
        if (isset($capchaResponse) && !empty($capchaResponse)) {
            $googleUrl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $captchaSecretKey . '&response=' . $capchaResponse;
            $replaceResponse = file_get_contents($googleUrl);
            $responseData = json_decode($replaceResponse, true);

            if ($responseData['success'] === true) {
                return 1;
            } else {
                return -1;
            }
        } else {
            return 0;
        }
    }
}
