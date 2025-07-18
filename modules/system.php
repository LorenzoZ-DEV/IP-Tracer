<?php

function detectSystem(): string {
    if (file_exists("/data/data/com.termux/files/usr/bin/pkg")) {
        return "termux";
    }

    if (file_exists("/usr/bin/pacman")) {
        return "arch";
    }

    if (file_exists("/usr/bin/apt")) {
        if (
            file_exists("/usr/lib/sudo") ||
            file_exists("/usr/bin/sudo") ||
            file_exists("/usr/sbin/sudo")
        ) {
            return "ubuntu";
        } else {
            return "debian";
        }
    }

    return "unknown"; // fallback
}

// Esempio d'uso
$system = detectSystem();
