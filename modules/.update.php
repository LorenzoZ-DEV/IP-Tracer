<?php
include("modules/trm.php");
include("modules/help.php");
include("modules/trip.php");

function logo() {
    system("clear");
    echo <<<EOL
\033[01;33m


\033[01;31m      _\033[01;33m ____    _
     \033[01;31m(_)\033[01;33m  _ \  | |_ _ __ __ _  ___ ___ _ __
     | | |_) | | __| '__/ _` |/ __/ _ \ '__|
     | |  __/  | |_| | | (_| | (_|  __/ |
     |_|_|      \__|_|  \__,_|\___\___|_|


   \033[01;37m}\033[01;31m----------------------------------------\033[01;37m{
}\033[01;31m-------------- \033[01;32mTrack IPLocation\033[01;31m --------------\033[01;37m{
   }\033[01;31m----------------------------------------\033[01;37m{

\033[00m
EOL;
}

function upd() {
    logo();
    echo "\n\033[01;32mUpdating IP-Tracer...\033[01;37m\n\n";
    sleep(1);

    $home = getenv("HOME") ?: "/root";
    $iptracerDir = $home . "/IP-Tracer";

    if (is_dir($iptracerDir)) {
        echo "[*] Removing existing IP-Tracer directory...\n";
        system("rm -rf " . escapeshellarg($iptracerDir));
    }

    echo "[*] Cloning IP-Tracer repository...\n";
    system("git clone https://github.com/LorenzoZ-DEV/IP-Tracer.git " . escapeshellarg($iptracerDir));

    echo "[*] Running install script...\n";
    system("sh " . escapeshellarg($iptracerDir . "/install"));

    logo();
    echo "\n\033[01;32m              IP-Tracer updated successfully!!!\033[01;37m\n";
    sleep(1);
}

upd();
?>
