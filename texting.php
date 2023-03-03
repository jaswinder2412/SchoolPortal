<?php
$api_key = 'sandbox_key_129952f89055f8c1b74c8608857462ce';
$api_secret = '173b33beac3f18a36267af3e317fecd84615ad5c90c4c20f24357294545baae5';
$date = gmdate('D, d M Y H:i:s') . ' GMT';

function createDigest($data) {
return 'SHA-256=' . base64_encode(hash('sha256', $data, true));
}

function createAuthorization($api_key, $api_secret, $date, $request_target, $digest) {

$signing_string = array(
"(request-target): " . $request_target,
"date: " . $date,
"digest: " . $digest);
$signing_string = implode("\n", $signing_string);

$signature = hash_hmac('sha256', $signing_string, $api_secret, true);
$signature = base64_encode($signature);

$authorization = array(
'Signature keyId="' . $api_key . '"',
'algorithm="hmac-sha256"',
'headers="(request-target) date digest"',
'signature="' . $signature . '"'
);
$authorization = implode(",", $authorization);
return $authorization;
}

function request($url, $body, $date, $digest, $authorization) {

$content_type = 'application/vnd.api+json';
$accept_type = 'application/vnd.api+json';
$version = '2016-09-01';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body); //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
"Content-Type: $content_type",
"Accept: $accept_type",
"Cognito-Version: $version",
"Date: $date",
"Digest: $digest",
"Authorization: $authorization",
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$server_output = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($status != 201) {
echo "Invalid Fields";
}

curl_close($ch);
$response = json_decode($server_output, true);


echo "<br>";
return $response;

}

function getProfileID($api_key, $api_secret, $date) {
$post_data = array(
'data' => array('type' => 'profile')
);

$body = json_encode($post_data);
$request_target = 'post /profiles';
$url = 'https://sandbox.cognitohq.com/profiles';
$digest = createDigest($body);
$authorization = createAuthorization($api_key, $api_secret, $date, $request_target, $digest);
$result = request($url, $body, $date, $digest, $authorization);
$id = $result['data']['id'];

return $id;
}

$myid = getProfileID($api_key, $api_secret, $date);

$post_datass = array (
'data' =>
array (
'type' => 'identity_search',
'attributes' =>
array (
'phone' =>
array (
'number' => '+16508007985',
),
),
'relationships' =>
array (
'profile' =>
array (
'data' =>
array (
'type' => 'profile',
'id' => "".$myid."",
),
),
),
),
);

$body = json_encode($post_datass);
$request_target = 'post /identity_searches';
$url = 'https://sandbox.cognitohq.com/identity_searches';
$digest = createDigest($body);
$authorization = createAuthorization($api_key, $api_secret, $date, $request_target, $digest);
$results = request($url, $body, $date, $digest, $authorization);

echo json_encode($results);

?>