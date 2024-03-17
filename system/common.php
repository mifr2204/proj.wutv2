<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

//starta phps sessionshantering
session_start();

//visa alla php fel och notiser
error_reporting(-1);
error_reporting(E_ALL);
ini_set("display_errors", 1);    


//läs in configurationsvariabler
include_once('config.php');



//mb_strimwidth fungerar inte med hosten så måste skriva en alternativ funktion för att lösa problemet
//källa för hjälp 2024-03-17 :: https://onezeronull.com/2018/03/13/replacement-for-mb_strimwidth-which-is-part-of-php-mbstring-package/
function custom_strimwidth($content, $offset, $character_count, $after) {
    return strlen($content) > $character_count ? substr($content, 0, $character_count).$after : $content;
}
