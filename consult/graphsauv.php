<?php

require "../config.php";
require "../consult/fonctions.php";

// On détermine le nom de l'équipe à partir de son id et le championnat
$query  = "select "
          . $xoopsDB->prefix("clubs")
          . ".nom, "
          . $xoopsDB->prefix("equipes")
          . ".id_club, "
          . $xoopsDB->prefix("equipes")
          . ".id_champ from "
          . $xoopsDB->prefix("equipes")
          . ", "
          . $xoopsDB->prefix("clubs")
          . " where "
          . $xoopsDB->prefix("clubs")
          . ".id="
          . $xoopsDB->prefix("equipes")
          . ".id_club and "
          . $xoopsDB->prefix("equipes")
          . ".id='$equipe'";
$result = $xoopsDB->queryF($query);
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    $nom_equipe = $row[0];
    $champ      = $row[2];
}

//on détermine le nombre d'équipes
$query      = "select * from " . $xoopsDB->prefix("equipes") . " where id_champ='$champ'";
$result     = $xoopsDB->queryF($query);
$nb_equipes = $GLOBALS['xoopsDB']->getRowsNum($result) + 1;

// on détermine la dernière journee jouée
$query  = "SELECT max("
          . $xoopsDB->prefix("journees")
          . ".numero) from "
          . $xoopsDB->prefix("journees")
          . ", "
          . $xoopsDB->prefix("matchs")
          . " where "
          . $xoopsDB->prefix("journees")
          . ".id="
          . $xoopsDB->prefix("matchs")
          . ".id_journee and buts_dom is not NULL and "
          . $xoopsDB->prefix("journees")
          . ".id_champ='$champ'";
$result = $xoopsDB->queryF($query);
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    $fin = $row[0];
}

// On détermine le nombre de journée total
$query       = "select id from " . $xoopsDB->prefix("journees") . " where id_champ=$champ";
$result      = $xoopsDB->queryF($query);
$nb_journees = $GLOBALS['xoopsDB']->getRowsNum($result);

// On déterrmine l'année et le nom de la division
$query  = "SELECT "
          . $xoopsDB->prefix("saisons")
          . ".annee, "
          . $xoopsDB->prefix("divisions")
          . ".nom from "
          . $xoopsDB->prefix("saisons")
          . ", "
          . $xoopsDB->prefix("divisions")
          . ", "
          . $xoopsDB->prefix("championnats")
          . " where "
          . $xoopsDB->prefix("championnats")
          . ".id=$champ and "
          . $xoopsDB->prefix("divisions")
          . ".id="
          . $xoopsDB->prefix("championnats")
          . ".id_division and "
          . $xoopsDB->prefix("championnats")
          . ".id_saison="
          . $xoopsDB->prefix("saisons")
          . ".id";
$result = $xoopsDB->queryF($query);
while (false !== ($row = $xoopsDB->fetchRow($result))) {
    $annee     = ($row[0] + 1);
    $nom_champ = "$row[1] $row[0]/$annee";
}

$largeur      = 500;
$hauteur      = 250;
$marge_gauche = 10;
$marge_haut   = 10;

eader("Content-type: image/png");

$image = ImageCreate($largeur + 40, $hauteur + 40 + $marge_haut);
$rouge = ImageColorAllocate($image, 255, 0, 0);
$vert  = ImageColorAllocate($image, 0, 106, 54);
$bleu  = ImageColorAllocate($image, 0, 0, 255);
$blanc = ImageColorAllocate($image, 255, 255, 255);
$noir  = ImageColorAllocate($image, 0, 0, 0);
$gris  = ImageColorAllocate($image, 150, 150, 150);

ImageFilledRectangle($image, 0, 0, $largeur + 40, $hauteur + 40 + $marge_haut, $blanc);
ImageFilledRectangle($image, 20 + $marge_gauche, 10 + $marge_haut, 20 + $marge_gauche, $hauteur + 5 + $marge_haut, $noir); // trait vertical à gauche
$titre       = "Evolution du classement de $nom_equipe ($nom_champ)";
$titrePolice = 4;
imageString($image, $titrePolice, ($largeur + 40 + $marge_gauche - ImageFontWidth($titrePolice) * strlen($titre)) / 2, 0, $titre, $vert); // titre

$y = 1;

while ($y <= $nb_journees) {
    if (!($y % 2) == 0) {
        $titre       = $y;
        $titrePolice = 2;
        imageString($image, $titrePolice, ($y - 1) * ($largeur) / $nb_journees + $marge_gauche + 20, $hauteur + $marge_haut, $titre, $noir); // numérotation journées
        $y++;
    } else {
        $y++;
    }
}

$x = $hauteur / $nb_equipes;
$y = 1;
while ($x <= $hauteur) {
    ImageFilledRectangle($image, $marge_gauche + 15, $x + $marge_haut, $largeur + 15, $x + $marge_haut, $noir); // traits par place

    $titre       = $y;
    $titrePolice = 2;
    if ($y < $nb_equipes) {
        imageString($image, $titrePolice, $marge_gauche + 1, $x - 8 + $marge_haut, $titre, $noir);
    } // numérotation place
    $x = $x + ($hauteur / $nb_equipes);
    $y++;
}

$requete_sql      = "SELECT " . $xoopsDB->prefix("classement") . " FROM " . $xoopsDB->prefix("clmnt_graph") . " WHERE id_equipe='$equipe' ORDER BY fin";
$resultat_requete = $xoopsDB->queryF($requete_sql);

$x = $marge_gauche + 20; //pas nb ".$xoopsDB->prefix("equipes")." !
$i = 0;
while (false !== ($colonne = $GLOBALS['xoopsDB']->fetchBoth($resultat_requete))) {
    $place[$i]     = $colonne[classement];
    $points[$i][0] = $x;
    $points[$i][1] = $hauteur + $marge_haut - ($nb_equipes - $colonne[classement]) * $hauteur / $nb_equipes;
    $x             += ($largeur - $marge_gauche + 11) / $nb_journees;
    $titrePolice   = 2;

    //if ($prec<$colonne[".$xoopsDB->prefix("classement")."]){imageString($image, $titrePolice, $points[$i][0],($points[$i][1])-15 , $titre, $rouge);}
    //else {imageString($image, $titrePolice, $points[$i][0],$points[$i][1] , $titre, $rouge);}
    $i++;
}

for ($i = 0; $i < $fin - 1; $i++) {
    ImageLine($image, $points[$i][0], $points[$i][1], $points[$i + 1][0], $points[$i + 1][1], $rouge);
}
for ($i = 0; $i < $fin; $i++) {
    if ($place[$i + 1] < $place[$i]) {
        imageString($image, $titrePolice, $points[$i][0], $points[$i][1], $place[$i], $rouge);
    }
    if ($place[$i + 1] > $place[$i]) {
        imageString($image, $titrePolice, $points[$i][0], $points[$i][1] - 11, $place[$i], $rouge);
    } else {
        imageString($image, $titrePolice, $points[$i][0], $points[$i][1], $place[$i], $rouge);
    }
}

$code = "";

$titre       = "$code http://www.univert.org";
$titrePolice = 4;
imageString($image, $titrePolice, ($largeur + $marge_gauche - ImageFontWidth($titrePolice) * strlen($titre)) / 2, $hauteur + 30, $titre, $vert);

ImagePNG($image);
ImageDestroy($image);

?>

