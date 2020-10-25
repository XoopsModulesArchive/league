<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] = 1;

require '../../../mainfile.php';

echo '<h1 align=center>';
echo ADMIN_GRAPH_TITRE;
echo '</h1>';
if (!isset($champ)) {
    // choix du champ couple championnat-saison

    // choix de la journée à saisir

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<br><h3>';

    echo ADMIN_RESULTATS_MSG1;

    echo '</h3>';

    echo '<select name="champ">';

    echo '<option value="0"> </option>';

    $query = 'SELECT DISTINCT ' . $xoopsDB->prefix('divisions') . '.nom, ' . $xoopsDB->prefix('saisons') . '.annee, ' . $xoopsDB->prefix('championnats') . '.id 
              FROM ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('divisions') . ', ' . $xoopsDB->prefix('saisons') . ', ' . $xoopsDB->prefix('journees') . ' 
              WHERE ' . $xoopsDB->prefix('journees') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id 
              AND ' . $xoopsDB->prefix('championnats') . '.id_division=' . $xoopsDB->prefix('divisions') . '.id 
              AND ' . $xoopsDB->prefix('championnats') . '.id_saison=' . $xoopsDB->prefix('saisons') . '.id 
              ORDER BY ' . $xoopsDB->prefix('saisons') . '.annee DESC, ' . $xoopsDB->prefix('championnats') . '.id';

    $data = ADMIN_JOURNEES_MSG3;

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $data $row[1]/" . ($row[1] + 1) . "\n");

        echo("</option>\n>");
    }

    echo '</select>';

    $button = ENVOI;

    echo "<input type=\"submit\" value=$button></form>";

    echo ADMIN_GRAPH_2;
} else {
    include '../consult/tps1.php3';

    $query1 = 'SELECT id from ' . $xoopsDB->prefix('equipes') . " where id_champ=$champ";

    $result1 = $GLOBALS['xoopsDB']->queryF($query1);

    while (false !== ($row1 = $GLOBALS['xoopsDB']->fetchBoth($result1))) {
        $query = 'delete from ' . $xoopsDB->prefix('clmnt_graph') . 'where ' . $xoopsDB->prefix('clmnt_graph') . ".id_equipe='$row1[0]'";

        $GLOBALS['xoopsDB']->queryF($query) or die ($GLOBALS['xoopsDB']->error());
    }

    $debut = 0;

    $fin = 1;

    $result = $GLOBALS['xoopsDB']->queryF('select * from ' . $xoopsDB->prefix('parametres') . " where id_champ='$champ'");

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $accession = $row[accession];

        $barrage = $row[barrage] + $accession;

        $relegation = nb_equipes($champ) - $row[relegation];
    }

    $legende = CONSULT_clmnt_MSG4 . $debut . CONSULT_clmnt_MSG5 . $fin;

    $requete = 'SELECT * from ' . $xoopsDB->prefix('clmnt') . ' ORDER BY POINTS DESC, DIFF DESC, BUTSPOUR DESC , BUTSCONTRE ASC, NOM';

    $query = 'SELECT max(' . $xoopsDB->prefix('journees') . '.numero) from ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix('matchs') . ' where ' . $xoopsDB->prefix('journees') . '.id=' . $xoopsDB->prefix('matchs') . '.id_journee and buts_dom is not NULL and ' . $xoopsDB->prefix(
            'journees'
        ) . ".id_champ='$champ'";

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $max = $row[0];
    }

    while ($fin <= $max) {
        db_clmnt($legende, GENERAL, $accession, $barrage, $relegation, $champ, $debut, $fin);

        $query = 'SELECT * from ' . $xoopsDB->prefix('clmnt') . ' ORDER BY POINTS DESC, DIFF DESC, BUTSPOUR DESC , BUTSCONTRE ASC, NOM';

        $result = $GLOBALS['xoopsDB']->queryF($query) or die ($GLOBALS['xoopsDB']->error());

        $pl = 1;

        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            $x = 0;

            $id_equipe = $row['ID_EQUIPE'];

            $query = 'INSERT INTO ' . $xoopsDB->prefix('clmnt_graph') . '(id_equipe, fin, ' . $xoopsDB->prefix('classe') . "ment) VALUES ('$id_equipe','$fin', $pl)";

            $GLOBALS['xoopsDB']->queryF($query);

            $pl++;
        }

        $fin++;
    }

    $query = 'SELECT ' . $xoopsDB->prefix('clmnt_graph') . '.id_equipe from ' . $xoopsDB->prefix('clmnt_graph') . ', ' . $xoopsDB->prefix('equipes') . ' where ' . $xoopsDB->prefix('equipes') . '.id=' . $xoopsDB->prefix('clmnt_graph') . '.id_equipe
                                                 and ' . $xoopsDB->prefix('equipes') . ".id_champ=$champ";

    $result = $xoopsDB->queryF($query);

    $nb_saving = $GLOBALS['xoopsDB']->getRowsNum($result);

    $query = 'select * from ' . $xoopsDB->prefix('equipes') . " where id_champ=$champ";

    $result = $xoopsDB->queryF($query);

    $nb_equipes = $GLOBALS['xoopsDB']->getRowsNum($result);

    if ($nb_saving = $max * $nb_equipes) {
        echo ADMIN_GRAPH;

        include '../consult/tps2.php';
    } else {
        echo ADMIN_GRAPH_4;
    }

    //@$GLOBALS['xoopsDB']->freeRecordSet($result);
}
$univert = ADMIN_CLASSE_UNIVERT;
echo "<p align=\"right\"><a href=$univert target=\"_blank\">" . ADMIN_CLASSE_UNIVERT . '</a></p>';
?>

