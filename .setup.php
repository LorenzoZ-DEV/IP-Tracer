<?php
class set {
  public $system;
  public $bin_path;
  public $share_path;
  public $use_sudo = false;

  public function __construct() {
    $this->detectSystem();
    $this->setPaths();
  }

  private function detectSystem() {
    $this->system = "linux";

    if (strpos(PHP_OS, "Linux") !== false && is_dir("/data/data/com.termux/files/usr")) {
      $this->system = "termux";
      $this->use_sudo = false;
      return;
    }

    if (file_exists("/etc/os-release")) {
      $os_release = file_get_contents("/etc/os-release");
      if (stripos($os_release, "ubuntu") !== false) {
        $this->system = "ubuntu";
        $this->use_sudo = true;
      } elseif (stripos($os_release, "arch") !== false) {
        $this->system = "arch";
        $this->use_sudo = true;
      } else {
        $this->system = "linux";
        $this->use_sudo = true;
      }
    }
  }

  private function setPaths() {
    if ($this->system === "termux") {
      $this->bin_path = "/data/data/com.termux/files/usr/bin";
      $this->share_path = "/data/data/com.termux/files/usr/share/IP-Tracer";
    } else {
      $this->bin_path = "/usr/bin";
      $this->share_path = "/usr/share/IP-Tracer";
    }
  }

  private function run($command) {
    if ($this->use_sudo && !str_starts_with(trim($command), "sudo")) {
      $command = "sudo " . $command;
    }
    system($command);
  }

  public function Setup() {
    echo "Checking for old installation...\n";
    if (
      file_exists($this->bin_path . "/ip-tracer") ||
      file_exists($this->bin_path . "/trace") ||
      is_dir($this->share_path)
    ) {
      echo "Removing old installation...\n";
      $this->run("rm -f {$this->bin_path}/ip-tracer {$this->bin_path}/trace");
      $this->run("rm -rf {$this->share_path}");
      echo "Old files removed.\n";
    } else {
      echo "No previous installation found.\n";
    }

    echo "Installing binaries...\n";
    $this->run("mv -v modules/ip-tracer {$this->bin_path}/");
    $this->run("mv -v modules/trace {$this->bin_path}/");
    $this->run("chmod +x {$this->bin_path}/ip-tracer {$this->bin_path}/trace");
    echo "Binaries installed.\n";

    if (!is_dir($this->share_path)) {
      echo "Creating directory {$this->share_path}...\n";
      $this->run("mkdir -p {$this->share_path}");
      echo "Directory created.\n";
    }

    echo "Copying support files...\n";
    $this->run("mv -v modules/* {$this->share_path}/");
    $this->run("chmod -R +x {$this->share_path}");
    echo "Support files copied.\n";

    if (is_dir("../IP-Tracer")) {
      echo "Cleaning up installation directory...\n";
      $this->run("rm -rf ../IP-Tracer");
      echo "Installation directory cleaned.\n";
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

    if (
      file_exists("{$this->bin_path}/ip-tracer") ||
      file_exists("/data/data/com.termux/files/usr/bin/ip-tracer")
    ) {
      echo "\033[01;32m      IP-Tracer installed Successfully !!!\033[00m\n";
      echo <<<EOL

\033[01;37m ----------------------------------------------
|         \033[01;36mcommand\033[01;37m       |        \033[01;36mUse\033[01;37m           |
 ----------------------------------------------
| \033[01;32mtrace -m\033[01;37m              | \033[01;33mTrack your IP\033[01;37m        |
| \033[01;32mtrace -t <target-ip>\033[01;37m  | \033[01;33mTrack IP\033[01;37m             |
| \033[01;32mtrace --help\033[01;37m         | \033[01;33mFor more information\033[01;37m |
 ----------------------------------------------

\033[01;31mNote :- ip-api will automatically ban any IP addresses doing over 150 requests per minute.\033[00m


EOL;
    } else {
      echo "\n\n\033[01;31m  Sorry IP-Tracer is not installed !!!\033[00m";
    }
  }
}

$a = new set();
$a->Setup();
$a->logo();
?>
