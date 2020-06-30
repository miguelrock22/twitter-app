<?php
class Strings{
    /**
     * Default Regex
     */
    const REGEX_EMAIL = '/[a-zA-Z0-9]+[@][a-zA-Z0-9]+[.][a-zA-Z 0-9]+/m';
    const REGEX_USERNAME = '/^(?=.*\d).{2,}(?=.*\S).{4,}$/m';
    const REGEX_PHONE = '/^\d{10}$/';
    const REGEX_PASSWORD = '/^(?=.*[A-Z]).{1}(?=.*[-]).{6,}$/m';

    /**
     * Validate string format with the given regex
     * @param String email
     * 
     * @return int
     */
    public static function validateString($regex,$string){
        return preg_match($regex,$string) === 0 ? false : true;
    }
}