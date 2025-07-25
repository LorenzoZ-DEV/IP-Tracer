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

function About() {
  logo();
  echo <<<EOL

         \033[01;33mTool Name  \033[01;37m:- \033[01;36mIP-Tracer
         \033[01;33mAuthor     \033[01;37m:- \033[01;36mRajkumar Dusad
         \033[01;33mPowered By \033[01;37m:- \033[01;36mAex Software's
         \033[01:33mFOrked by \033[01;37m]:- \033[01;36m Lorenzz

 \033[01;33mIP-Tracer\033[01;32m uses \033[01;36mip-api \033[01;32mto retrieve any IP address information. Our system will automatically ban any IP addresses doing over 150 requests per minute.\033[00m


EOL;
  $getact = readline('  IP-Tracer >> ');
  menu();
}

function upd() {
  logo();
  echo "\n\033[01;32mUpdating IP-Tracer.........\033[01;37m\n\n";
  sleep(1);
  if (!is_dir(getenv("HOME") . "/IP-Tracer")) {
    system("git clone https://github.com/LorenzoZ-DEV/IP-Tracer.git ~/IP-Tracer");
  } else {
    system("cd ~/IP-Tracer && git pull");
  }
  system("cd ~/IP-Tracer && sh install");
  logo();
  echo "\n\033[01;32m              IP-Tracer updated !!!\033[01;37m\n";
  sleep(1);
  menu();
}

function menu() {
  logo();
  echo "   \033[01;32m[ \033[01;37m1 \033[01;32m] \033[01;33mTrack IP Address.\n";
  echo "   \033[01;32m[ \033[01;37m2 \033[01;32m] \033[01;33mTrack Your IP Address.\n";
  echo "   \033[01;32m[ \033[01;37m3 \033[01;32m] \033[01;33mAbout us.\n";
  echo "   \033[01;32m[ \033[01;37m4 \033[01;32m] \033[01;33mHelp.\n";
  echo "   \033[01;32m[ \033[01;37m5 \033[01;32m] \033[01;33mUpdate IP-Tracer.\n";
  echo "   \033[01;32m[ \033[01;37mx \033[01;32m] \033[01;33mExit \n\n\033[00m";
  $inp = strtolower(trim(readline('  IP-Tracer >> ')));

  switch ($inp) {
    case 'x':
    case 'exit':
      echo "\n\033[01;31m  Exiting .......\033[00m\n";
      sleep(1);
      echo "\033[01;32m  Bye ....... :)\n\n\033[00m";
      exit();
    case '1':
      trac();
      break;
    case '2':
      tracm();
      break;
    case '3':
      About();
      break;
    case '4':
      help();
      break;
    case '5':
      upd();
      break;
    default:
      echo "\n  \033[01;31mErr : Invalid Command \033[01;32m'$inp'\033[00m\n";
      sleep(1);
      menu();
  }
}

menu();
?>
