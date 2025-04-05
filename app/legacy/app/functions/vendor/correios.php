<?php

function vendor_correios_calc_shipping_fee($code) {
	global $cart;

	$result = false;

	$shippingData = [
		'weight' => 0,
		'area' => 0,
		'height' => 0,
	];

	foreach ($cart->orders as $order) {
		$shippingData['weight'] += $order->item->shippingData['weight'];
		$shippingData['area'] += $order->item->shippingData['width'] * $order->item->shippingData['length'];
		if ($order->item->shippingData['height'] > $shippingData['height']) $shippingData['height'] =  $order->item->shippingData['height'];
	}

	$size = round(sqrt($shippingData['area']));

	$shippingData['weight'] = max($shippingData['weight'], 1);
	$shippingData['width'] = max(min($size, 100), 10);
	$shippingData['length'] = max(min($size, 100), 15);
	$shippingData['height'] = max(min($size, 100), 1);

	// fetch shipping data
	$shippingFeeEndpoint = 'http://ws.correios.com.br/calculador/calcprecoprazo.asmx/CalcPrecoPrazo';
	$queryFields = [
		'nCdEmpresa' => '',
		'sDsSenha' => '',
		'nCdServico' => $code,
		'sCepOrigem' => '95590000',
		'sCepDestino' => $cart->address->cep,
		'nVlPeso' => $shippingData['weight'],
		'nCdFormato' => 1,
		'nVlComprimento' => $shippingData['length'],
		'nVlAltura' => $shippingData['height'],
		'nVlLargura' => $shippingData['width'],
		'nVlDiametro' => 0,
		'sCdMaoPropria' => 'N',
		'nVlValorDeclarado' => 0,
		'sCdAvisoRecebimento' => 'N',
		'StrRetorno' => 'xml'
	];

	$response = new HttpResponse('POST', $shippingFeeEndpoint, $queryFields);
	$responseXML = $response->xml();
	$responseXML = $responseXML['Servicos']['cServico'] ?? false;

	if (isset($responseXML['Valor'])) {
		$result['price'] = str_replace(',', '.', $responseXML['Valor']);
		$result['daysMin'] = $responseXML['PrazoEntrega'];
		$result['daysMax'] = $responseXML['PrazoEntrega'];
	} else error_log('Correios error: ' . implode(' => ', $responseXML));

	return $result;
}
