<?php
function trac($ip) {
    if (empty($ip)) {
        echo "\033[01;31mError: No IP address provided.\033[00m\n";
        exit(1);
    }

    $url = "http://ip-api.com/php/" . urlencode($ip);
    $data = @unserialize(file_get_contents($url));

    $FCL = "\033[01;33m";
    $MCL = "\033[01;37m>\033[01;32m";
    $NCL = "\033[00m";

    if (!$data || !is_array($data)) {
        echo "\033[01;31m[!] Failed to fetch IP data. Check your internet connection or IP validity.\033[00m\n";
        exit(1);
    }

    if (!empty($data['timezone'])) {
        @date_default_timezone_set($data['timezone']);
    }

    system("clear");

    echo <<<EOL
\033[01;33m


\033[01;31m      _\033[01;33m ____    _
     \033[01;31m(_)\033[01;33m  _ \  | |_ _ __ __ _  ___ ___ _ __
     | | |_) | | __| '__/ _` |/ __/ _ \ '__|
     | |  __/  | |_| | | (_| | (_|  __/ |
     |_|_|      \__|_|  \__,_|\___\___|_|

   \033[01;37m}\033[01;31m----------------------------------------\033[01;37m{
}\033[01;31m--------------- \033[01;32mIP Information\033[01;31m ---------------\033[01;37m{
   }\033[01;31m----------------------------------------\033[01;37m{

\033[00m
EOL;

    if ($data['status'] === 'success') {
        echo "\n {$FCL}IP Address    {$MCL}   {$data['query']}";
        echo "\n {$FCL}Country code  {$MCL}   {$data['countryCode']}";
        echo "\n {$FCL}Country       {$MCL}   {$data['country']}";
        echo "\n {$FCL}Date & Time   {$MCL}   " . date("F j, Y, g:i a");
        echo "\n {$FCL}Region code   {$MCL}   {$data['region']}";
        echo "\n {$FCL}Region        {$MCL}   {$data['regionName']}";
        echo "\n {$FCL}City          {$MCL}   {$data['city']}";
        echo "\n {$FCL}Zip code      {$MCL}   {$data['zip']}";
        echo "\n {$FCL}Time zone     {$MCL}   {$data['timezone']}";
        echo "\n {$FCL}ISP           {$MCL}   {$data['isp']}";
        echo "\n {$FCL}Organization  {$MCL}   {$data['org']}";
        echo "\n {$FCL}ASN           {$MCL}   {$data['as']}";
        echo "\n {$FCL}Latitude      {$MCL}   {$data['lat']}";
        echo "\n {$FCL}Longitude     {$MCL}   {$data['lon']}";
        echo "\n {$FCL}Location      {$MCL}   {$data['lat']},{$data['lon']}\n\n{$NCL}";
    } else {
        echo "\n\033[01;31m Sorry unable to track the IP Address: {$ip} !!!\033[00m\n";
        echo "\033[01;31m Check your \033[01;33mNetwork connection\033[01;31m or IP validity !!\033[00m\n\n";
    }
}

// Check if IP argument is passed
if (isset($argv[1])) {
    trac($argv[1]);
} else {
    echo "\033[01;31mUsage: php .traceip.php <target_ip>\033[00m\n";
    exit(1);
}
?>
