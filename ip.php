<?php
// Function to get the client's IP addresses and separate them into IPv4 and IPv6
function getClientIPs() {
    $ips = ['IPv4' => [], 'IPv6' => []];
    
    if (isset($_SERVER['HTTP_CLIENT_IP'])) addIP($_SERVER['HTTP_CLIENT_IP'], $ips);
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) addIP($_SERVER['HTTP_X_FORWARDED_FOR'], $ips);
    if (isset($_SERVER['HTTP_X_FORWARDED'])) addIP($_SERVER['HTTP_X_FORWARDED'], $ips);
    if (isset($_SERVER['HTTP_FORWARDED_FOR'])) addIP($_SERVER['HTTP_FORWARDED_FOR'], $ips);
    if (isset($_SERVER['HTTP_FORWARDED'])) addIP($_SERVER['HTTP_FORWARDED'], $ips);
    if (isset($_SERVER['REMOTE_ADDR'])) addIP($_SERVER['REMOTE_ADDR'], $ips);
    
    return $ips;
}

// Helper function to add IP to the appropriate category
function addIP($ip, &$ips) {
    $ip = trim($ip);
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        if (!in_array($ip, $ips['IPv4'])) $ips['IPv4'][] = $ip;
    } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        if (!in_array($ip, $ips['IPv6'])) $ips['IPv6'][] = $ip;
    }
}

// Function to get the first valid IP address (IPv4 or IPv6)
function getFirstIP($ips) {
    return !empty($ips['IPv4']) ? $ips['IPv4'][0] : (!empty($ips['IPv6']) ? $ips['IPv6'][0] : 'UNKNOWN');
}

// Determine the output mode
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'plaintext';

// Get client IPs
$ips = getClientIPs();

// Output based on mode
if ($mode == 'json') {
    header('Content-Type: application/json');
    echo json_encode(['ip' => getFirstIP($ips), 'all_ips' => $ips]);
} else {
    header('Content-Type: text/plain');
    echo getFirstIP($ips);
}
?>
