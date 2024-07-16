<?php
// Function to get the client's IP address
function getClientIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// Function to get all possible client IPs
function getAllClientIPs() {
    $ips = [];
    if (isset($_SERVER['HTTP_CLIENT_IP'])) $ips[] = $_SERVER['HTTP_CLIENT_IP'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ips[] = $_SERVER['HTTP_X_FORWARDED_FOR'];
    if (isset($_SERVER['HTTP_X_FORWARDED'])) $ips[] = $_SERVER['HTTP_X_FORWARDED'];
    if (isset($_SERVER['HTTP_FORWARDED_FOR'])) $ips[] = $_SERVER['HTTP_FORWARDED_FOR'];
    if (isset($_SERVER['HTTP_FORWARDED'])) $ips[] = $_SERVER['HTTP_FORWARDED'];
    if (isset($_SERVER['REMOTE_ADDR'])) $ips[] = $_SERVER['REMOTE_ADDR'];
    return $ips;
}

// Determine the output mode
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'plaintext';

// Output based on mode
if ($mode == 'json') {
    header('Content-Type: application/json');
    $ips = getAllClientIPs();
    echo json_encode(['ip' => getClientIP(), 'all_ips' => $ips]);
} else {
    header('Content-Type: text/plain');
    echo getClientIP();
}
?>
