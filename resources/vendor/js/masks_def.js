$(document).ready(function() {
 	$('.st_number').mask('99999');
 	$('.cep').mask('99999-999');
 	$('.phone_with_ddd').mask('(00) 0000-0000');
	$('.cnpj').mask('99.999.999/9999-99');
  	$('.time').mask('00:00');
 	$('.money').mask('000.000.000.000.000,00', {reverse: true});
  	$('.money2').mask("#.##0,00", {reverse: true});
  	$('.date').mask('00/00/0000');
});