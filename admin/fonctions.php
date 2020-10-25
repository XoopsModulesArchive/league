<?php

// nom club à partir id equipe
function nom_club($id_equipe)
{
    global $xoopsDB;

    $query = ' SELECT nom FROM ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . ' WHERE ' . $xoopsDB->prefix('clubs') . '.id=id_club and ' . $xoopsDB->prefix('equipes') . ".id='$id_equipe'";

    $result = $xoopsDB->queryF($query);

    $row = $GLOBALS['xoopsDB']->fetchBoth($result);

    $nom_club = $row[0];

    return ("$nom_club");
}

// nombres de ".$xoopsDB->prefix("journees")." d un championnat
function nb_journees($id_champ)
{
    global $xoopsDB;

    $query = 'SELECT id FROM ' . $xoopsDB->prefix('equipes') . " WHERE id_champ='$id_champ'";

    $result = $xoopsDB->queryF($query);

    $nb_equipes = $GLOBALS['xoopsDB']->getRowsNum($result);

    //$xoopsDB->getRowsNum($result)

    $nb_journees = ((($nb_equipes) * 2) - 2);

    return ("$nb_journees");
}

// Nombres d ".$xoopsDB->prefix("equipes")." dans un championnat
function nb_equipes($id_champ)
{
    global $xoopsDB;

    $query = 'SELECT id FROM ' . $xoopsDB->prefix('equipes') . " WHERE id_champ='$id_champ'";

    $result = $xoopsDB->queryF($query);

    //if (!$result) die $GLOBALS['xoopsDB']->error();

    $nb_equipes = $GLOBALS['xoopsDB']->getRowsNum($result);

    return ("$nb_equipes");
}

//id_champ a partir de id_calendrier
function id_champ($id_champ)
{
    global $xoopsDB;

    $query = ' SELECT id_champ FROM ' . $xoopsDB->prefix('journees') . " WHERE id='$id_champ'";

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $id_champ = $row[0];
    }

    return $id_champ;
}

//liste des ".$xoopsDB->prefix("championnats")."
function listechamp()
{
    global $xoopsDB;

    echo '<TABLE><TR><TD colSpan=3>';

    echo '<b>Liste des championnats existants</b><br>(uniquement ceux qui contiennent des équipes)';

    $result = $xoopsDB->queryF(
        'select '
        . $xoopsDB->prefix('championnats')
        . '.id, '
        . $xoopsDB->prefix('divisions')
        . '.nom, '
        . $xoopsDB->prefix('saisons')
        . '.annee, COUNT('
        . $xoopsDB->prefix('equipes')
        . '.id) AS count FROM '
        . $xoopsDB->prefix('championnats')
        . ',  '
        . $xoopsDB->prefix('saisons')
        . ', '
        . $xoopsDB->prefix('divisions')
        . ', '
        . $xoopsDB->prefix('equipes')
        . ' WHERE '
        . $xoopsDB->prefix('divisions')
        . '.id='
        . $xoopsDB->prefix('championnats')
        . '.id_division AND '
        . $xoopsDB->prefix('saisons')
        . '.id='
        . $xoopsDB->prefix('championnats')
        . '.id_saison AND '
        . $xoopsDB->prefix('equipes')
        . '.id_champ='
        . $xoopsDB->prefix('championnats')
        . '.id GROUP BY '
        . $xoopsDB->prefix('championnats')
        . '.id'
    );

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $x = ($row[2] + 1);

        echo '<TR><TD><b>' . $row[0] . '</b><TD>' . $row[1] . '</b><TD>' . $row[2] . '/' . $x . ' - ' . $row[3];

        echo ADMIN_JOURNEES_MSG11;

        print '<br>';
    }

    echo '</table>';
}

function date_us_vers_fr($dateUS) // $dateUS=AAAA-MM-JJ
{
    global $xoopsDB;

    //$elementsdate=chunk_split($dateUS , 2 , "-");

    $elementsdate = explode('-', $dateUS);

    $jour = $elementsdate[2];

    $mois = $elementsdate[1];

    $annee = $elementsdate[0];

    return $dateFR = $jour . $mois . $annee;
}

function date_fr_vers_us($dateFR)
{
    global $xoopsDB;

    $elementsdate = chunk_split($dateFR, 2, '-');

    $elementsdate = explode('-', $elementsdate);

    $annee = $elementsdate[2] . $elementsdate[3];

    $mois = $elementsdate[1];

    $jour = $elementsdate[0];

    $dateUS = $annee . '-' . $mois . '-' . $jour;

    return $dateUS;
}

/////////////////////////////////////////////////////////////////////////////////////////////////
// Titre       : Add-on Gestion des ".$xoopsDB->prefix("clubs")." (Fiches clubs), mini- classement,                     //
//               statistiques, amélioration de la gestion des  buteurs pour PhpLeague.          //
// Auteur      : Alexis MANGIN                                                                 //
// Email       : Alexis@univert.org                                                            //
// Url         : http://www.univert.org                                                        //
// Démo        : http://univert42.free.fr/adversaire/ classement/consult/classement.php?champ=2 //
// Description : Edition, gestion, Fiches clubs, statistiques, mini- classement...              //
// Version     : 0.71 (29/03/2004)                                                             //
//                                                                                             //
//                                                                                             //
// L'Univert   : Retrouvez quotidiennement l'actualité des Verts ainsi que de                  //
//               nombreuses autres rubriques consacrées à l'AS Saint-Etienne. Mais             //
//               L'Univert c'est avant tout la présentation d'un club devenu légende.          //
//                                                                                             //
/////////////////////////////////////////////////////////////////////////////////////////////////

// Nombres de renseignements classés (utilisé dans admin/rens.php)
function nb_rens()
{
    global $xoopsDB;

    $query = 'SELECT * FROM ' . $xoopsDB->prefix('rens') . " where id_classe>'0'";

    $result = $xoopsDB->queryF($query);

    $nb_rens = $GLOBALS['xoopsDB']->getRowsNum($result);

    return ("$nb_rens");
}

// Nombres de renseignements enregistrés (utilisé dans rens.php)
function nb_rens2()
{
    global $xoopsDB;

    $query = 'SELECT * FROM ' . $xoopsDB->prefix('rens') . '';

    $result = $xoopsDB->queryF($query);

    $nb_rens2 = $GLOBALS['xoopsDB']->getRowsNum($result);

    return ("$nb_rens2");
}

// Nombres de renseignement dans cette classe à partir de l'id_classe  (utilisé dans classe.php)
function nb_classe($data)
{
    global $xoopsDB;

    $query = 'SELECT * FROM ' . $xoopsDB->prefix('rens') . " where id_classe='$data'";

    $result = $xoopsDB->queryF($query);

    //if (!$result) die $GLOBALS['xoopsDB']->error();

    $nb_classe = $GLOBALS['xoopsDB']->getRowsNum($result);

    return ("$nb_classe");
}

// Nombres de  classes enregistrées (ulilisé dans classe.php)
function nb_classe2()
{
    global $xoopsDB;

    $query = 'SELECT * FROM ' . $xoopsDB->prefix('donnee') . '';

    $result = $xoopsDB->queryF($query);

    //if (!$result) die $GLOBALS['xoopsDB']->error();

    $nb_classe2 = $GLOBALS['xoopsDB']->getRowsNum($result);

    return ("$nb_classe2");
}

// Nombres de fois ou ce renseignement est utilisé
//function nb_rens3($rens)
//{
//$query="SELECT * FROM  donnee where id_rens='$rens'";
//$result=$xoopsDB->queryF($query); ;
//if (!$result) die $GLOBALS['xoopsDB']->error();
//$nb_rens3=$GLOBALS['xoopsDB']->getRowsNum( $result );
//return("$nb_rens3");
//}

// id du club à partir de son nom (utilisé dans clubs.php)
function id($data)
{
    global $xoopsDB;

    $query = 'select id, nom from ' . $xoopsDB->prefix('clubs') . " where nom='$data'";

    $result = $xoopsDB->queryF($query);

    //if (!$result) die $GLOBALS['xoopsDB']->error();

    $row = $GLOBALS['xoopsDB']->fetchBoth($result);

    $id = $row[0];

    return ("$id");
}

// id du rens (ulilisé dans getequipes.php et rens.php)
function rens()
{
    global $xoopsDB;

    $query = 'select id from ' . $xoopsDB->prefix('rens') . '';

    $result = $xoopsDB->queryF($query);

    //if (!$result) die $GLOBALS['xoopsDB']->error();

    $row = $GLOBALS['xoopsDB']->fetchBoth($result);

    $rens = $row[0];

    return ("$rens");
}

// id du renseignement à partir du nom du rens (utilisé dans rens.php)
function rens2($rens)
{
    global $xoopsDB;

    $query = 'select id, nom from ' . $xoopsDB->prefix('rens') . " where nom='$rens'";

    $result = $xoopsDB->queryF($query);

    //if (!$result) die $GLOBALS['xoopsDB']->error();

    $row = $GLOBALS['xoopsDB']->fetchBoth($result);

    $rens2 = $row[0];

    return ("$rens2");
}

// Affichage des  renseignements (utilisé dans gestequipes.php
function aff_rens($id_classe, $id)
{
    global $xoopsDB;

    $query = 'select '
               . $xoopsDB->prefix('donnee')
               . '.id,  '
               . $xoopsDB->prefix('donnee')
               . '.nom, id_rens, id_clubs,  '
               . $xoopsDB->prefix('rens')
               . '.id, '
               . $xoopsDB->prefix('rens')
               . '.nom, '
               . $xoopsDB->prefix('rens')
               . '.id_classe, '
               . $xoopsDB->prefix('clubs')
               . '.id, etat, '
               . $xoopsDB->prefix('donnee')
               . '.url, '
               . $xoopsDB->prefix('rens')
               . '.url
FROM '
               . $xoopsDB->prefix('donnee')
               . ', '
               . $xoopsDB->prefix('rens')
               . ', '
               . $xoopsDB->prefix('clubs')
               . "
WHERE id_clubs='$id' and id_clubs="
               . $xoopsDB->prefix('clubs')
               . '.id and id_rens='
               . $xoopsDB->prefix('rens')
               . ".id and id_classe='$id_classe' AND etat='1' order by rang";

    $result = $xoopsDB->queryF($query);

    $nb_rens = $GLOBALS['xoopsDB']->getRowsNum($result);

    if ('0' == $nb_rens) {
        echo '<center>' . ADMIN_EQUIPE_8 . '</center>';
    }

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if (empty ($row[9]) and empty ($row[10])) {
            echo "<b>$row[5] :</b> $row[1] <br>";
        } elseif (empty ($row[9])) {
            echo "<b><a href=\"$row[10]\">$row[5]</a> :</b> $row[1]<br>";
        } elseif (empty ($row[10])) {
            echo "<b>$row[5] :</b> <a href=\"$row[9]\">$row[1]</a><br>";
        } else {
            echo "<b><a href=\"$row[10]\">$row[5]</a> :</b> <a href=\"$row[9]\">$row[1]</a><br>";
        }
    }
}

function nb_matchs($numero, $champ)
{
    global $xoopsDB;

    $query = 'select * from '
              . $xoopsDB->prefix('matchs')
              . ','
              . $xoopsDB->prefix('journees')
              . ' where '
              . $xoopsDB->prefix('matchs')
              . '.id_journee='
              . $xoopsDB->prefix('journees')
              . '.id and '
              . $xoopsDB->prefix('journees')
              . ".numero=$numero and "
              . $xoopsDB->prefix('journees')
              . ".id_champ=$champ";

    $result = $xoopsDB->queryF($query);

    $nb_matchs = $GLOBALS['xoopsDB']->getRowsNum($result);

    return ("$nb_matchs");
}

function db_clmnt($legende, $type, $accession, $barrage, $relegation, $champ, $debut, $fin)
{
    global $xoopsDB;

    @$GLOBALS['xoopsDB']->queryF('DELETE FROM' . $xoopsDB->prefix('clmnt') . '');

    if (!$fin) {
        $fin = (nb_equipes($champ) * 2) - 2;
    }

    if (!$debut) {
        $debut = 1;
    }

    // SELECTION DES  parametres

    $query = 'select * from ' . $xoopsDB->prefix('parametres') . " where id_champ='$champ'";

    $result = $xoopsDB->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $pts_victoire = $row[pts_victoire];

        $pts_nul = $row[pts_nul];

        $pts_defaite = $row[pts_defaite];

        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }

    // NOM de EQUIPE FAVORITE a partir de son id

    $result = ($xoopsDB->queryF('select nom from ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . ' where ' . $xoopsDB->prefix('equipes') . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix('clubs') . '.id=' . $xoopsDB->prefix('equipes') . '.id_club'));

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $equipe_fetiche = $row[0];
    }

    //@$GLOBALS['xoopsDB']->freeRecordSet($result);

    // victoires domicile

    $query = 'SELECT dom.id, count(dom.id), ' . $xoopsDB->prefix('clubs') . '.nom, sum(buts_dom), sum(buts_ext) FROM ' . $xoopsDB->prefix('equipes') . ' as dom, ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix(
            'championnats'
        ) . "
WHERE dom.id_champ='$champ'
      AND dom.id_club=" . $xoopsDB->prefix('clubs') . '.id
      AND dom.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_dom
      AND buts_dom > buts_ext
      AND ' . $xoopsDB->prefix('championnats') . '.id=' . $xoopsDB->prefix('journees') . '.id_champ
      AND ' . $xoopsDB->prefix('journees') . '.id=' . $xoopsDB->prefix('matchs') . '.id_journee
      AND ' . $xoopsDB->prefix('journees') . ".numero>='$debut'
      AND " . $xoopsDB->prefix('journees') . ".numero<='$fin'
      GROUP by " . $xoopsDB->prefix('clubs') . '.nom ';

    $dom = $xoopsDB->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $clmnt[$row[2]][GDOM] = $row[1];

        $clmnt[$row[2]][BUTSDOMPOUR] = $row[3];

        $clmnt[$row[2]][BUTSDOMCONTRE] = $row[4];
    }

    //@$GLOBALS['xoopsDB']->freeRecordSet($dom);

    // Defaites domicile

    $query = 'SELECT dom.id, count(dom.id), ' . $xoopsDB->prefix('clubs') . '.nom, sum(buts_dom), sum(buts_ext) FROM ' . $xoopsDB->prefix('equipes') . ' as dom,' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix(
            'journees'
        ) . "
WHERE dom.id_champ='$champ'
      AND dom.id_club=" . $xoopsDB->prefix('clubs') . '.id
      AND dom.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_dom
      AND buts_dom < buts_ext
      AND ' . $xoopsDB->prefix('championnats') . '.id=' . $xoopsDB->prefix('journees') . '.id_champ
      AND ' . $xoopsDB->prefix('journees') . '.id=' . $xoopsDB->prefix('matchs') . '.id_journee
      AND ' . $xoopsDB->prefix('journees') . ".numero>='$debut'
      AND " . $xoopsDB->prefix('journees') . ".numero<='$fin'
      GROUP by " . $xoopsDB->prefix('clubs') . '.nom ';

    $dom = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $clmnt[$row[2]][PDOM] = $row[1];

        $clmnt[$row[2]][BUTSDOMPOUR] += $row[3];

        $clmnt[$row[2]][BUTSDOMCONTRE] += $row[4];
    }

    @$GLOBALS['xoopsDB']->freeRecordSet($dom);

    // Nuls domicile

    $query = 'SELECT dom.id, count(dom.id),' . $xoopsDB->prefix('clubs') . '.nom, sum(buts_dom), sum(buts_ext) FROM ' . $xoopsDB->prefix('equipes') . ' as dom, ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix(
            'championnats'
        ) . "
WHERE dom.id_champ='$champ'
      AND dom.id_club=" . $xoopsDB->prefix('clubs') . '.id
      AND dom.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_dom
      AND buts_dom = buts_ext
      AND buts_dom is not null
      AND buts_ext is not null
      AND ' . $xoopsDB->prefix('championnats') . '.id=' . $xoopsDB->prefix('journees') . '.id_champ
      AND ' . $xoopsDB->prefix('journees') . '.id=' . $xoopsDB->prefix('matchs') . '.id_journee
      AND ' . $xoopsDB->prefix('journees') . ".numero>='$debut'
      AND " . $xoopsDB->prefix('journees') . ".numero<='$fin'
      GROUP by " . $xoopsDB->prefix('clubs') . '.nom ';

    $dom = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $clmnt[$row[2]][NDOM] = $row[1];

        $clmnt[$row[2]][BUTSDOMPOUR] += $row[3];

        $clmnt[$row[2]][BUTSDOMCONTRE] += $row[4];
    }

    //@$GLOBALS['xoopsDB']->freeRecordSet($dom);

    // Resultats à domicile

    $query = 'SELECT ' . $xoopsDB->prefix('clubs') . '.nom from ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('championnats') . '
WHERE ' . $xoopsDB->prefix('equipes') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id
      AND ' . $xoopsDB->prefix('championnats') . ".id='$champ'
      AND " . $xoopsDB->prefix('equipes') . '.id_club=' . $xoopsDB->prefix('clubs') . '.id';

    $result = $xoopsDB->queryF($query);

    // RESULTATS EXTERIEURS :

    // victoires exterieur

    $query = 'SELECT ext.id, count(ext.id), ' . $xoopsDB->prefix('clubs') . '.nom, sum(buts_ext), sum(buts_dom) FROM ' . $xoopsDB->prefix('equipes') . ' as ext, ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix(
            'championnats'
        ) . "
WHERE ext.id_champ='$champ'
      AND ext.id_club=" . $xoopsDB->prefix('clubs') . '.id
      AND ext.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_ext
      AND buts_ext > buts_dom
      AND ' . $xoopsDB->prefix('championnats') . '.id=' . $xoopsDB->prefix('journees') . '.id_champ
      AND ' . $xoopsDB->prefix('journees') . '.id=' . $xoopsDB->prefix('matchs') . '.id_journee
      AND ' . $xoopsDB->prefix('journees') . ".numero>='$debut'
      AND " . $xoopsDB->prefix('journees') . ".numero<='$fin'
      GROUP by " . $xoopsDB->prefix('clubs') . '.nom ';

    $dom = $xoopsDB->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $clmnt[$row[2]][GEXT] = $row[1];

        $clmnt[$row[2]][BUTSEXTPOUR] = $row[3];

        $clmnt[$row[2]][BUTSEXTCONTRE] = $row[4];
    }

    @$GLOBALS['xoopsDB']->freeRecordSet($dom);

    // Defaites exterieur

    $query = 'SELECT ext.id, count(ext.id), ' . $xoopsDB->prefix('clubs') . '.nom, sum(buts_ext), sum(buts_dom) FROM ' . $xoopsDB->prefix('equipes') . ' as ext, ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix(
            'championnats'
        ) . "
WHERE ext.id_champ='$champ'
      AND ext.id_club=" . $xoopsDB->prefix('clubs') . '.id
      AND ext.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_ext
      AND buts_ext < buts_dom
      AND ' . $xoopsDB->prefix('championnats') . '.id=' . $xoopsDB->prefix('journees') . '.id_champ
      AND ' . $xoopsDB->prefix('journees') . '.id=' . $xoopsDB->prefix('matchs') . '.id_journee
      AND ' . $xoopsDB->prefix('journees') . ".numero>='$debut'
      AND " . $xoopsDB->prefix('journees') . ".numero<='$fin'
      GROUP by " . $xoopsDB->prefix('clubs') . '.nom ';

    $dom = $xoopsDB->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $clmnt[$row[2]][PEXT] = $row[1];

        $clmnt[$row[2]][BUTSEXTPOUR] += $row[3];

        $clmnt[$row[2]][BUTSEXTCONTRE] += $row[4];
    }

    //@$GLOBALS['xoopsDB']->freeRecordSet($dom);

    // Nuls exterieur

    $query = 'SELECT ext.id, count(ext.id), ' . $xoopsDB->prefix('clubs') . '.nom, sum(buts_ext), sum(buts_dom) FROM ' . $xoopsDB->prefix('equipes') . ' as ext, ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix(
            'championnats'
        ) . "
WHERE ext.id_champ='$champ'
      AND ext.id_club=" . $xoopsDB->prefix('clubs') . '.id
      AND ext.id=' . $xoopsDB->prefix('matchs') . '.id_equipe_ext
      AND buts_ext = buts_dom
      AND buts_dom is not null
      AND buts_ext is not null
      AND ' . $xoopsDB->prefix('championnats') . '.id=' . $xoopsDB->prefix('journees') . '.id_champ
      AND ' . $xoopsDB->prefix('journees') . '.id=' . $xoopsDB->prefix('matchs') . '.id_journee
      AND ' . $xoopsDB->prefix('journees') . ".numero>='$debut'
      AND " . $xoopsDB->prefix('journees') . ".numero<='$fin'
      GROUP by " . $xoopsDB->prefix('clubs') . '.nom ';

    $dom = $xoopsDB->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $clmnt[$row[2]][NEXT] = $row[1];

        $clmnt[$row[2]][BUTSEXTPOUR] += $row[3];

        $clmnt[$row[2]][BUTSEXTCONTRE] += $row[4];
    }

    //@$GLOBALS['xoopsDB']->freeRecordSet($dom);

    // TABLEAU DE  classeMENT

    $query = 'SELECT ' . $xoopsDB->prefix('clubs') . '.nom, ' . $xoopsDB->prefix('tapis_vert') . '.pts from ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('championnats') . ', ' . $xoopsDB->prefix('tapis_vert') . '
WHERE ' . $xoopsDB->prefix('equipes') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id
      AND ' . $xoopsDB->prefix('championnats') . ".id='$champ'
      AND " . $xoopsDB->prefix('equipes') . '.id_club=' . $xoopsDB->prefix('clubs') . '.id
      AND ' . $xoopsDB->prefix('equipes') . '.id=' . $xoopsDB->prefix('tapis_vert') . '.id_equipe';

    $result = $xoopsDB->queryF($query);

    if (0 == $GLOBALS['xoopsDB']->getRowsNum($result)) {
        //@$GLOBALS['xoopsDB']->freeRecordSet($result);

        $query = 'SELECT ' . $xoopsDB->prefix('clubs') . '.nom from ' . $xoopsDB->prefix('clubs') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('championnats') . '
    WHERE ' . $xoopsDB->prefix('equipes') . '.id_champ=' . $xoopsDB->prefix('championnats') . '.id
          AND ' . $xoopsDB->prefix('championnats') . ".id='$champ'
          AND " . $xoopsDB->prefix('equipes') . '.id_club=' . $xoopsDB->prefix('clubs') . '.id';

        $result = $xoopsDB->queryF($query);
    }

    $xoopsDB->queryF('LOCK TABLE ' . $xoopsDB->prefix('clmnt') . '');

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        $x = $row[0];

        $NOM = $row[0];

        $DOMJOUES = $clmnt[$x][GDOM] + $clmnt[$x][NDOM] + $clmnt[$x][PDOM];

        $EXTJOUES = $clmnt[$x][GEXT] + $clmnt[$x][NEXT] + $clmnt[$x][PEXT];

        $JOUES = $EXTJOUES + $DOMJOUES;

        $DOMPOINTS = (($clmnt[$x][GDOM]) * $pts_victoire) + (($clmnt[$x][NDOM]) * $pts_nul) + (($clmnt[$x][PDOM]) * $pts_defaite);

        $EXTPOINTS = (($clmnt[$x][GEXT]) * $pts_victoire) + (($clmnt[$x][NEXT]) * $pts_nul) + (($clmnt[$x][PEXT]) * $pts_defaite);

        $POINTS = $DOMPOINTS + $EXTPOINTS + $row[1];

        $G = ($clmnt[$x][GEXT]) + ($clmnt[$x][GDOM]);

        $N = ($clmnt[$x][NEXT]) + ($clmnt[$x][NDOM]);

        $P = $clmnt[$x][PEXT] + $clmnt[$x][PDOM];

        $DOMG = ($clmnt[$x][GDOM]);

        $DOMN = ($clmnt[$x][NDOM]);

        $DOMP = $clmnt[$x][PDOM];

        $EXTG = ($clmnt[$x][GEXT]);

        $EXTN = ($clmnt[$x][NEXT]);

        $EXTP = $clmnt[$x][PEXT];

        $BUTSPOUR = $clmnt[$x][BUTSEXTPOUR] + $clmnt[$x][BUTSDOMPOUR];

        $DOMBUTSPOUR = $clmnt[$x][BUTSDOMPOUR];

        $EXTBUTSPOUR = $clmnt[$x][BUTSEXTPOUR];

        $BUTSCONTRE = $clmnt[$x][BUTSEXTCONTRE] + $clmnt[$x][BUTSDOMCONTRE];

        $DOMBUTSCONTRE = $clmnt[$x][BUTSDOMCONTRE];

        $EXTBUTSCONTRE = $clmnt[$x][BUTSEXTCONTRE];

        $DIFF = $BUTSPOUR - $BUTSCONTRE;

        $DOMDIFF = $DOMBUTSPOUR - $DOMBUTSCONTRE;

        $EXTDIFF = $EXTBUTSPOUR - $EXTBUTSCONTRE;

        $PEN = $row[1];

        $query1 = 'SELECT ' . $xoopsDB->prefix('equipes') . '.id FROM ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('clubs') . ' WHERE ' . $xoopsDB->prefix('clubs') . '.id=' . $xoopsDB->prefix('equipes') . '.id_club

                                                        and ' . $xoopsDB->prefix('clubs') . ".nom='$NOM'
                                                        and " . $xoopsDB->prefix('equipes') . ".id_champ='$champ'";

        $result1 = $xoopsDB->queryF($query1);

        while (false !== ($row1 = $GLOBALS['xoopsDB']->fetchBoth($result1))) {
            $id_equipe = $row1[0];
        }

        $question = 'INSERT INTO ' . $xoopsDB->prefix('clmnt') . "
          SET NOM='$NOM',
          ID_EQUIPE='$id_equipe',
          POINTS='$POINTS',
          DOMPOINTS='$DOMPOINTS',
          EXTPOINTS='$EXTPOINTS',
          JOUES= '$JOUES',
          DOMJOUES= '$DOMJOUES',
          EXTJOUES= '$EXTJOUES',
          G='$G',
          DOMG='$DOMG',
          EXTG='$EXTG',
          N='$N',
          DOMN='$DOMN',
          EXTN='$EXTN',
          P='$P',
          DOMP='$DOMP',
          EXTP='$EXTP',
          BUTSPOUR='$BUTSPOUR',
          DOMBUTSPOUR='$DOMBUTSPOUR',
          EXTBUTSPOUR='$EXTBUTSPOUR',
          BUTSCONTRE='$BUTSCONTRE',
          DOMBUTSCONTRE='$DOMBUTSCONTRE',
          EXTBUTSCONTRE='$EXTBUTSCONTRE',
          DIFF='$DIFF',
          DOMDIFF='$DOMDIFF',
          EXTDIFF='$EXTDIFF',
          PEN='$PEN'";

        $result2 = $xoopsDB->queryF($question);
    }

    //@$GLOBALS['xoopsDB']->freeRecordSet($result);
}

?>
