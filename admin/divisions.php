<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] = 1;

if (!$xoopsUser) {
    redirect_header('index.php', 3, _US_NOEDITRIGHT);

    exit();
}

require_once '../config.php';
require_once 'fonctions.php';

if (!isset($division)) {
    echo '<h1><div align= "center">';

    echo ADMIN_DIVISION_TITRE;

    echo " </div></h1>
     <form action=\"$PHP_SELF\" method=get target=\"_self\">
     <input type=\"text\" name=\"division\" size=40 maxlength=40>";

    $button = ADMIN_DIVISION_BUTTON_CREA;

    echo "<input type=\"submit\" value=$button></form>
     <br><h3>";

    echo ADMIN_DIVISION_MSG1;

    echo '</h3>';

    echo '<table>';

    $result = $xoopsDB->queryF('SELECT * FROM ' . $xoopsDB->prefix('divisions') . ' order by nom');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "- $row[1]<br>";
    }

    echo '</table>';
} else {
    $xoopsDB->queryF('INSERT INTO ' . $xoopsDB->prefix('divisions') . " (nom) VALUES ('$division')") or die ('probleme ' . $GLOBALS['xoopsDB']->error());

    echo '<h1><div align= "center">';

    echo ADMIN_DIVISION_TITRE;

    echo " </div></h1>
     <form action=\"$PHP_SELF\" method=get target=\"_self\">
     <input type=\"text\" name=\"division\" size=40 maxlength=40>";

    $button = ADMIN_DIVISION_BUTTON_CREA;

    echo "<input type=\"submit\" value=$button></form>
     <br><h3>";

    echo ADMIN_DIVISION_MSG1;

    echo '</h3>';

    echo '<table>';

    $result = $xoopsDB->queryF('SELECT * FROM ' . $xoopsDB->prefix('divisions') . ' order by nom');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "- $row[1]<br>";
    }

    echo '</table>';
}
function division()
{
    echo '<h1><div align= "center">';

    echo ADMIN_DIVISION_TITRE;

    echo " </div></h1>
     <form action=\"$PHP_SELF\" method=get target=\"_self\">
     <input type=\"text\" name=\"division\" size=40 maxlength=40>";

    $button = ADMIN_DIVISION_BUTTON_CREA;

    echo "<input type=\"submit\" value=$button></form>
     <br><h3>";

    echo ADMIN_DIVISION_MSG1;

    echo '</h3>';

    echo '<table>';

    $result = $xoopsDB->queryF('SELECT * FROM ' . $xoopsDB->prefix('divisions') . ' order by nom');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo "- $row[1]<br>";
    }

    echo '</table>';
}

$xoopsDB->prefix('classe') . saisons . annee;
xoops_cp_footer();
?>

