<?php
error_reporting(0);

function getUserIP() {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    }
    // If IP is from shared internet or proxy
    elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Sanitize IP to avoid XSS or any malicious content
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : 'unknown';
}

function isValidUrl($url) {
    // Check if the URL is valid and does not point to an internal IP or localhost
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }

    // Parse the URL to extract the host
    $parsedUrl = parse_url($url);
    $host = $parsedUrl['host'];

    // Check for local IPs or localhost
    $blockedHosts = ['localhost', '127.0.0.1', '0.0.0.0', '::1'];
    if (in_array($host, $blockedHosts)) {
        return false;
    }

    // block private IP ranges:
    $blockedIps = [
        '192.168.', // Class C private IP range
        '10.',      // Class A private IP range
        '172.16.',  // Class B private IP range
        '169.254.'  // Link-local addresses
    ];
    
    foreach ($blockedIps as $blockedIp) {
        if (strpos($host, $blockedIp) === 0) {
            return false;
        }
    }

    // Ensure that only HTTP/HTTPS protocols are used
    if (!in_array($parsedUrl['scheme'], ['http', 'https'])) {
        return false;
    }

    return true;
}

function curl_get_contents($u) {
    // Validate the URL to prevent SSRF
    if (!isValidUrl($u)) {
        return false;  // Return false if the URL is not valid
    }

    $cget = curl_init($u);
    curl_setopt($cget, CURLOPT_URL, $u);
    curl_setopt($cget, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cget, CURLOPT_ENCODING, '');
    curl_setopt($cget, CURLOPT_MAXREDIRS, 10);
    curl_setopt($cget, CURLOPT_TIMEOUT, 0);
    curl_setopt($cget, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($cget, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($cget, CURLOPT_CUSTOMREQUEST, 'GET');
    $response = curl_exec($cget);

    // Handle cURL errors
    if (curl_errno($cget)) {
        echo 'Curl error: ' . htmlspecialchars(curl_error($cget), ENT_QUOTES, 'UTF-8');
    }

    curl_close($cget);
    return $response;
}

$t = time();

// Get the user's IP
$ip2 = getUserIP();

// Fetch public IP using ipify
$ip3 = @file_get_contents("https://api.ipify.org/");

// Fetch additional data about the IP using IPData API
$url3 = "https://api.ipdata.co/" . urlencode($ip3) . "/carrier?api-key=5778f15bce9a28eaadb01e71577ad926737ba460f2f028e4d3e2e01f";
$url4 = "https://vpnapi.io/api/".$ip2."?key=d068d1dc6e4245d788280fc3a04ce801";
$url5 = "https://api.ipdata.co/?api-key=5778f15bce9a28eaadb01e71577ad926737ba460f2f028e4d3e2e01f";
$url6 = "https://api64.ipify.org";

// File paths for storing visitor data
$visitorbulklist = "visitorbulklist/" . date("Y-m-d");
file_put_contents($visitorbulklist, PHP_EOL . htmlspecialchars($ip2), FILE_APPEND);

// Add timestamp to the file for tracking
$visitorbulklist = "visitorbulklist/" . date("Y-m-d") . "-t";
file_put_contents($visitorbulklist, PHP_EOL . htmlspecialchars($ip2) . " - " . date(DATE_RFC822) . " [" . $t . "]", FILE_APPEND);

// Load file into Array and prevent directory traversal by using basename
$visitorFile = "visitorbulklist/" . basename(date("Y-m-d"));
$v = file($visitorFile);

// Remove duplicates
$uniques = array_unique($v);

// Write back to sanitized file path
$visitorbulklist_u = "visitorbulklist/" . basename(date("Y-m-d")) . "-u";
file_put_contents($visitorbulklist_u, implode($uniques));

// Get list of unique visitors
$visitor = @file_get_contents($visitorbulklist_u, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$visitors = substr_count($visitor, "\n");

// Fetch additional data about the IP using the IPData API
$mobile = @file_get_contents($url3);

// Fetch and update Tor exit list
$filetorbulkexitlist = "torbulkexitlist/" . date("Y-m");
$filetorbulkexitlistupdate = @file_get_contents("https://check.torproject.org/torbulkexitlist");
file_put_contents($filetorbulkexitlist, $filetorbulkexitlistupdate);

// Fetch VPN data using the VPN API
$cek = json_decode(curl_get_contents($url4));
$cek2 = json_decode(curl_get_contents($url5));


    // error_reporting(0);
    // // error_reporting(E_ERROR | E_WARNING | E_PARSE);
    // function getUserIP()
    // {
        
    //     // Get real visitor IP behind CloudFlare network
    //     if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    //         $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    //         $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    //     }

    //     $client  = @$_SERVER['HTTP_CLIENT_IP'];
    //     $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

    //     if (filter_var($client, FILTER_VALIDATE_IP)) {
    //         $ip = $client;
    //     } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
    //         $ip = $forward;
    //     }

    //     //whether ip is from share internet
    //     elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //         $ip = $_SERVER['HTTP_CLIENT_IP'];
    //     }
    //     //whether ip is from proxy
    //     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //     }
    //     //whether ip is from remote address
    //     else {
    //         $ip = $_SERVER['REMOTE_ADDR'];
    //     }

    //     return $ip;
    // }
    
    // function curl_get_contents($u)
    // {
    //   $cget = curl_init($u);
    //   curl_setopt($cget, CURLOPT_URL, $u);
    //   curl_setopt($cget, CURLOPT_RETURNTRANSFER, 1);
    //   curl_setopt($cget, CURLOPT_ENCODING, '');
    //   curl_setopt($cget, CURLOPT_MAXREDIRS, 10);
    //   curl_setopt($cget, CURLOPT_TIMEOUT, 0);
    //   curl_setopt($cget, CURLOPT_FOLLOWLOCATION, 1);
    //   curl_setopt($cget, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    //   curl_setopt($cget, CURLOPT_CUSTOMREQUEST, 'GET');
    //   $response = curl_exec($cget);
    //   curl_close($cget);
    //   return $response;
    // }
    
    // $t=time();
    
    // $url = "https://check.torproject.org/torbulkexitlist";
    // $url2 = "https://api.ipify.org/";
    
    // $ip2 = getUserIP();
    // $ip3 = @file_get_contents($url2);
    
    // $url3 = "https://api.ipdata.co/" . $ip3 . "/carrier?api-key=5778f15bce9a28eaadb01e71577ad926737ba460f2f028e4d3e2e01f";
    // $url4 = "https://vpnapi.io/api/".$ip2."?key=d068d1dc6e4245d788280fc3a04ce801";
    // $url5 = "https://api.ipdata.co/?api-key=5778f15bce9a28eaadb01e71577ad926737ba460f2f028e4d3e2e01f";
    // $url6 = "https://api64.ipify.org";
    
    
    // $visitorbulklist = "visitorbulklist/" . date("Y-m-d");
    // file_put_contents($visitorbulklist, PHP_EOL . $ip2, FILE_APPEND);
    // $visitorbulklist = "visitorbulklist/" . date("Y-m-d") . "-t";
    // file_put_contents($visitorbulklist, PHP_EOL . $ip2 . " - " . date(DATE_RFC822) . " [" . $t . "]", FILE_APPEND);
    
    // // Load file into Array
    // $v = file("visitorbulklist/" . date("Y-m-d"));
    
    // // Remove duplicates
    // $uniques = array_unique($v);
    
    // // Write back to file
    // $visitorbulklist_u = "visitorbulklist/" . date("Y-m-d") . "-u";
    // file_put_contents($visitorbulklist_u, implode($uniques));
    
    // $visitor = @file_get_contents($visitorbulklist_u, FILE_IGNORE_NEW_LINES . FILE_SKIP_EMPTY_LINES);
    // $visitors = substr_count($visitor, "\n");
    
    // $mobile = @file_get_contents($url3);
    
    // $filetorbulkexitlist = "torbulkexitlist/" . date("Y-m");
    // $filetorbulkexitlistupdate = @file_get_contents($url);
    // file_put_contents($filetorbulkexitlist, $filetorbulkexitlistupdate);
    
    // $cek = json_decode(curl_get_contents($url4));
    // $cek2 = json_decode(curl_get_contents($url5));
?>
