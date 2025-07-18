<?php
include("modules/system.php");

class Uninstaller {
    private $system;
    private $paths = [];

    public function __construct() {
        global $system;
        $this->system = $system;

        // Definizione percorsi in base al sistema
        if ($this->system === "termux") {
            $this->paths = [
                "/data/data/com.termux/files/usr/share/IP-Tracer",
                "/data/data/com.termux/files/usr/bin/ip-tracer",
                "/data/data/com.termux/files/usr/bin/trace",
            ];
        } else { // Ubuntu, Debian, Arch ecc.
            $this->paths = [
                "/usr/share/IP-Tracer",
                "/usr/bin/ip-tracer",
                "/usr/bin/trace",
            ];
        }
    }

    private function runCommand(string $cmd) {
        echo "[*] Running: $cmd\n";
        system($cmd);
    }

    public function uninstall() {
        foreach ($this->paths as $path) {
            if (file_exists($path) || is_link($path)) {
                if ($this->system === "ubuntu" || $this->system === "debian") {
                    $this->runCommand("sudo rm -rf " . escapeshellarg($path));
                } else {
                    $this->runCommand("rm -rf " . escapeshellarg($path));
                }
            } else {
                echo "[i] Not found: $path\n";
            }
        }
    }

    public function logo() {
        system("clear");
        echo <<<EOL
\033[01;33m

\033[01;31m      _\033[01;33m ____    _
     \033[01;31m(_)\033[01;33m  _ \  | |_ _ __ __ _  ___ ___ _ __
     | | |_) | | __| '__/ _` |/ __/ _ \ '__|
     | |  __/  | |_| | | (_| | (_|  __/ |
     |_|_|      \__|_|  \__,_|\___\___|_|

    \033[01;37m}\033[01;31m--------------------------------------\033[01;37m{
 }\033[01;31m------------- \033[01;32mTrack IPLocation\033[01;31m -------------\033[01;37m{
    }\033[01;31m--------------------------------------\033[01;37m{

\033[00m
EOL;

        $anyLeft = false;
        foreach ($this->paths as $path) {
            if (file_exists($path) || is_link($path)) {
                $anyLeft = true;
                break;
            }
        }

        if ($anyLeft) {
            echo "\n\033[01;31m        Sorry, IP-Tracer is NOT completely removed !!!\033[00m\n";
        } else {
            echo "\n\033[01;32m        IP-Tracer has been uninstalled successfully !!!\033[00m\n";
        }
    }
}

$uninstaller = new Uninstaller();
$uninstaller->uninstall();
$uninstaller->logo();
?>
