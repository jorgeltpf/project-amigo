<?php

/**
 * Returns default string 'active' if route is active.
 *
 * @param $route
 * @param string $str
 * @return string
 */
function set_active($route, $str = 'active') {

  return call_user_func_array('Request::is', (array)$route) ? $str : '';

}


// Converte dinheiro para formato nacional
function convertCurrency($currency) {
	$number = number_format($currency, 2, ',', '.');
	return $number;
}

// Converte dinheiro para formato de banco
function convertCurrencyDB($currency) {
	$number = floatval(str_replace(',', '.', str_replace('.', '', $currency)));
	return $number;
}

// Converte datas para formato internacional
function convertDate($date) {
	return date('d/m/Y', strtotime($date));
}

// Converte datas para formato de banco
function convertDateDB($date) {
	return date('Y-m-d', strtotime($date));
}