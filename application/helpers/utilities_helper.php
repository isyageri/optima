<?php

function jsonDecode($data) {

	if (empty($data)) return array();

    $items = json_decode($data, true);

    if ($items == NULL){
        throw new Exception('JSON items could not be decoded');
    }

    return $items;
}

function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
}

function html_spaces($number=1) {
    $result = "";
    for($i = 1; $i <= $number; $i++) {
        $result .= "&nbsp;";
    }
    return $result;
}

function getMonth($num) {
    $months = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    return $months[$num-1];
}

function numberFormat($number, $decimals =  2, $dec_point = ',' , $thousands_sep = '.'){
    return number_format($number, $decimals, $dec_point, $thousands_sep);
}
?>