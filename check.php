<?php
$domain = $_REQUEST["domain"];

$parameter = array_values($_GET);
$parameter = implode(',', $parameter);

if($parameter) {
    $parameter = str_replace(' ', '', $parameter);
    $domains = explode(",", $parameter);
}

$domains = array_filter($domains, function($domain) {
    return $domain !== '';
});

$domains = array_filter($domains, function($domain) {
    return strpos($domain, '.') > 0;
});

$domains = array_unique($domains);

// Get maximum of 3 domain per request, chanmge the last number if you want to increase or decrease.
$domains = array_slice($domains, 0, 3);

function getCertificate($domain) {
    $url = "https://$domain";
    $orignal_parse = parse_url($url, PHP_URL_HOST);
    $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
    $read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
    $cert = stream_context_get_params($read);
    $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
    return $certinfo;
}

$certs = [];
foreach ($domains as $domain) {
    $rawCert = getCertificate($domain);
    $cert = [];
    $cert['domain'] = $domain;
    $cert['serialNumber'] = $rawCert['serialNumber'];
    $cert['validFrom'] = gmdate("Y-m-d\TH:i:s\Z", $rawCert['validFrom_time_t']);
    $cert['validTo'] = gmdate("Y-m-d\TH:i:s\Z", $rawCert['validTo_time_t']);
    $cert['validToUnix'] = $rawCert['validTo_time_t'];
    $cert['issuer'] = $rawCert['issuer']['CN'];
    $cert['days'] = (intval($cert['validToUnix']) - time())/60/60/24;
    $certs[] = $cert;
}

$validTo = array();
foreach ($certs as $key => $row) {
    $validTo[$key] = $row['validToUnix'];
}
array_multisort($validTo, SORT_ASC, $certs);

$bar = str_repeat('=', 80);
$format = "$bar\n %s (%d days)\n$bar\n from: %s\n until: %s\n serial: %s\n issuer: %s\n$bar\n\n";

$output = '';
foreach ($certs as $cert) {
    $output .= sprintf($format, $cert['domain'], $cert['days'], $cert['validFrom'], $cert['validTo'], $cert['serialNumber'], $cert['issuer']);
    echo $read;
}
if (empty($output)) {
	printf("<pre>Invalid domain/domain does not exist.</pre>");
}else{
	printf("<pre>\n%s\n</pre>", $output);
}
?>