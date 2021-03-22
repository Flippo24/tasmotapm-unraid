<?php
$tasmotapm_cfg = parse_ini_file( "/boot/config/plugins/tasmotapm/tasmotapm.cfg" );
$tasmotapm_device_ip	= isset($tasmotapm_cfg['DEVICE_IP']) ? $tasmotapm_cfg['DEVICE_IP'] : "";
$tasmotapm_use_pass	= isset($tasmotapm_cfg['DEVICE_USE_PASS']) ? $tasmotapm_cfg['DEVICE_USE_PASS'] : "false";
$tasmotapm_device_user	= isset($tasmotapm_cfg['DEVICE_USER']) ? $tasmotapm_cfg['DEVICE_USER'] : "";
$tasmotapm_device_pass	= isset($tasmotapm_cfg['DEVICE_PASS']) ? $tasmotapm_cfg['DEVICE_PASS'] : "";
$tasmotapm_costs_price	= isset($tasmotapm_cfg['COSTS_PRICE']) ? $tasmotapm_cfg['COSTS_PRICE'] : "0.0";
$tasmotapm_costs_unit	= isset($tasmotapm_cfg['COSTS_UNIT']) ? $tasmotapm_cfg['COSTS_UNIT'] : "USD";


if ($tasmotapm_device_ip == "") {
	die("Tasmota Device IP missing!");
}

$Url = "http://" . $tasmotapm_device_ip . "/cm?";

if ($tasmotapm_use_pass == 1) {
	if ($tasmotapm_device_user == "") {
		die("Tasmota username missing!");
	}
	if ($tasmotapm_device_pass == "") {
		die("Tasmota password missing!");
	}

	$Url = $Url . "user=" . $tasmotapm_device_user . "&password=" . $tasmotapm_device_pass . "&";
}

$Url = $Url . "cmnd=Status%208";

$datajson = file_get_contents($Url);
$data = json_decode($datajson, true); 

$json = array(
		'Total' => $data['StatusSNS']['ENERGY']['Total'],
		'Today' => $data['StatusSNS']['ENERGY']['Today'],
		'Yesterday' => $data['StatusSNS']['ENERGY']['Yesterday'],
		'Voltage' => $data['StatusSNS']['ENERGY']['Voltage'],
		'Current' => $data['StatusSNS']['ENERGY']['Current'],
		'ApparentPower' => $data['StatusSNS']['ENERGY']['ApparentPower'],
		'ReactivePower' => $data['StatusSNS']['ENERGY']['ReactivePower'],
		'Factor' => $data['StatusSNS']['ENERGY']['Factor'],
		'Power' => $data['StatusSNS']['ENERGY']['Power'],
		'Costs_Price' => $tasmotapm_costs_price,
		'Costs_Unit' => $tasmotapm_costs_unit
	);

header('Content-Type: application/json');
echo json_encode($json);
?>