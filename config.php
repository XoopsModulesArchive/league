<?php

include 'header.php';

// parametre lang "fr" ou "en" ou autre....
// langage = "fr" or "en" or another lang_Extension.php
// Some langages available "fr" French, "en" English, "du" Dutch

/*	$lang="fr";
        $fiches_clubs=1; // Si vous voulez rendre consultable les Fiches clubs (=1) ou non (=0)
		

include "../lang/lang_".$lang.".php";*/

$fiches_clubs = 1;
if (file_exists('../language/' . $xoopsConfig['language'] . '/lang_fr.php')) {
    include '../language/' . $xoopsConfig['language'] . '/lang_fr.php';
} else {
    include '../language/english/admin.php';
}
?>
