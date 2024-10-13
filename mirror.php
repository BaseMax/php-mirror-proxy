<?php
/**
 * @Author: Max Base
 * @Date: 10/13/2024
 * @Email: maxbasecode [@] gmail [.] com
 * @URL: https://github.com/BaseMax
 * 
 */

if (!isset($_GET['url']) || empty($_GET['url'])) {
	die('Error: No URL provided.');
}

$targetUrl = filter_var($_GET['url'], FILTER_VALIDATE_URL);

if (!$targetUrl) {
	die('Error: Invalid URL.');
}

$ch = curl_init($targetUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$method = $_SERVER['REQUEST_METHOD'];
$content = file_get_contents('php://input') ?? "";

switch (strtoupper($method)) {
	case 'POST':
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		break;
	case 'PUT':
	case 'DELETE':
	case 'PATCH':
	case 'OPTIONS':
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		break;
	case 'GET':
	default:
		break;
}

$headers = [];
foreach (getallheaders() as $key => $value) {
	$headers[] = "$key: $value";
}
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

if (curl_errno($ch)) {
	$error_msg = curl_error($ch);
	curl_close($ch);
	die('cURL Error: ' . $error_msg);
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

http_response_code($httpCode);

echo $response;
