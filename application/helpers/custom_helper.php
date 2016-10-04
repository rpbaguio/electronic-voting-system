<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Usage:
 * 1] Load helper in the controller or autoload
 * 2] Call the function in view
 */

if (!function_exists('is_connected' || 'str_to_title' || 'convert_number_to_words' || 'position' || 'candidate' || 'max_selection' || 'role' || 'count_votes' || 'count_voters' || 'noun_forms')) {

    function is_connected()
    {
        $connected = @fsockopen("www.google.com", 80);

        if ($connected) {
            $is_conn = TRUE;
            fclose($connected);
        } else {
            $is_conn = FALSE;
        }
        return $is_conn;
    }

    function str_to_title($title)
    {
        // Our array of 'small words' which shouldn't be capitalised if
        // they aren't the first word. Add your own words to taste.
        $small_words_array = array(
            'of', 'a', 'the', 'and', 'an', 'or', 'nor', 'but', 'is', 'if', 'then', 'else', 'when',
            'at', 'from', 'by', 'on', 'off', 'for', 'in', 'out', 'over', 'to', 'into', 'with', 'del', 'de'
        );

        // Split the string into separate words
        $words = explode(' ', $title);
        foreach ($words as $key => $word) {
            // If this word is the first, or it's not one of our small words, capitalise it
            // with ucwords().
            if ($key == 0 or !in_array($word, $small_words_array))
                $words[$key] = ucwords($word);
        }
        // Join the words back into a string
        $new_title = implode(' ', $words);
        return $new_title;
    }

    function convert_number_to_words($number) {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

    function position() {
        $CI = & get_instance();

        $CI->load->model('position_model');

        $obj = $CI->position_model->_get_position();

        return $obj;
    }

    function candidate($id) {
        $CI = & get_instance();

        $CI->load->model('person_model');

        $obj = $CI->person_model->_get_person_by_position_id($id);

        return $obj;
    }

    function max_selection($id) {
        $CI = & get_instance();

        $CI->load->model('position_model');

        $obj = $CI->position_model->_get_position_by_id($id);

        if ($obj) {
            foreach ($obj as $row) {
                return $row->max_selection;
            }
        }
    }

    function role($id)
    {
        $CI = &get_instance();

        $data = $CI->person_model->_get_person_by_role_id($id);

        foreach ($data as $row) {
            return $role = $row->role_name;
        }
    }

    function count_votes($id) {
        $CI = & get_instance();

        $CI->load->model('tally_model');

        $obj = $CI->tally_model->_count_votes_by_candidate($id);

        return $obj;
    }

    function count_voters() {
        $CI = & get_instance();

        $CI->load->model('person_model');

        $obj = $CI->person_model->_count_voters();

        return $obj;
    }

    function noun_forms($param)
    {
        return $n = ($param > 1) ? 's' : '';
    }

}
