<?php

function help() {
    if (function_exists('logo')) {
        logo();
    }

    echo <<<EOL
\033[01;37m -----------------------------------------------
|         \033[01;36mCommand\033[01;37m        |         \033[01;36mUse\033[01;37m          |
 -----------------------------------------------
| \033[01;32mtrace -m\033[01;37m              | \033[01;33mTrack your IP\033[01;37m        |
| \033[01;32mtrace -t <target-ip>\033[01;37m | \033[01;33mTrack a specific IP\033[01;37m   |
| \033[01;32mtrace --help\033[01;37m         | \033[01;33mShow this help menu\033[01;37m   |
 -----------------------------------------------

\033[01;33m Note: \033[01;31mip-api will automatically ban any IP addresses doing over 150 requests per minute.\033[00m

EOL;

    echo "\033[00m";
    
    if (posix_isatty(STDIN)) {
        $getact = readline(" IP-Tracer >> ");
        menu(); 
    }
}
?>
