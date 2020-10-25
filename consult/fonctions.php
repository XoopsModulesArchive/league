<?

function ENTETE2()
{
    include "../../../mainfile.php";
    ?>

    <?
}

function PiedDePage()
{
}

// nombres de ".$xoopsDB->prefix("journees")."  d un championnat
function nb_journees($id_champ)
{
    global $xoopsDB;
    $query       = "SELECT id FROM " . $xoopsDB->prefix("equipes") . " WHERE id_champ='$id_champ'";
    $result      = $GLOBALS['xoopsDB']->queryF($query);
    $nb_equipes  = $GLOBALS['xoopsDB']->getRowsNum($result);
    $nb_journees = ((($nb_equipes) * 2) - 2);
    return ("$nb_journees");
}

// Nombres d ".$xoopsDB->prefix("equipes")." dans un championnat
function nb_equipes($id_champ)
{
    global $xoopsDB;
    $query      = "SELECT id FROM " . $xoopsDB->prefix("equipes") . " WHERE id_champ='$id_champ'";
    $result     = $GLOBALS['xoopsDB']->queryF($query);
    $nb_equipes = $GLOBALS['xoopsDB']->getRowsNum($result);
    return ("$nb_equipes");
}

function aff_journee($champ, $numero, $legende, $proba, $fiches_clubs)
{
    global $xoopsDB;
    // SELECTION DES ".$xoopsDB->prefix("parametres")."
    $result = ($GLOBALS['xoopsDB']->queryF("select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champ' "));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }
    //@$GLOBALS['xoopsDB']->freeRecordSet($result);
    // NOM de EQUIPE FAVORITE a partir de son id
    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }
    //@$GLOBALS['xoopsDB']->freeRecordSet($result);
    // cellule d'affichage des derniers résultats
    $color  = 0;
    $query1 = "SELECT cldom.nom as cldom, clext.nom as clext, buts_dom,buts_ext , " . $xoopsDB->prefix("journees") . " .date_prevue, cldom.id as cliddom, clext.id as clidext
                FROM " . $xoopsDB->prefix("equipes") . " as dom, " . $xoopsDB->prefix("equipes") . " as ext, " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix("clubs") . "  as cldom, " . $xoopsDB->prefix("clubs") . "  as clext
                WHERE " . $xoopsDB->prefix("matchs") . " .id_equipe_dom=dom.id
                        AND " . $xoopsDB->prefix("matchs") . " .id_equipe_ext=ext.id
                        AND " . $xoopsDB->prefix("journees") . " .id_champ='$champ'
                        AND " . $xoopsDB->prefix("journees") . " .numero='$numero'
                        AND dom.id_club=cldom.id
                        AND ext.id_club=clext.id
                        AND " . $xoopsDB->prefix("matchs") . " .id_journee=" . $xoopsDB->prefix("journees") . " .id ";
    $result = $GLOBALS['xoopsDB']->queryF($query1);
    echo "<TABLE class='itemHead'cellspacing=\"0\" align=\"center\" >";
    $x = 1;
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $domproba = $row[2];
        $extproba = $row[3];
        if ($row[buts_dom] == '' and $row[buts_ext] == '' and $proba == 1 and $numero >= 4) {
            $query2  = "SELECT * from " . $xoopsDB->prefix("clmnt") . " WHERE NOM='$row[cldom]'";
            $result2 = $GLOBALS['xoopsDB']->queryF($query2);
            while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                $dom_buts  = ($row2[DOMBUTSPOUR]);
                $dom_joues = ($row2[DOMG] + $row2[DOMN] + $row2[DOMP]);
                $ext_buts  = ($row2[DOMBUTSCONTRE]);
                $ext_joues = ($row2[DOMG] + $row2[DOMN] + $row2[DOMP]);
            }

            $query2  = "SELECT * from " . $xoopsDB->prefix("clmnt") . " WHERE NOM='$row[clext]'";
            $result2 = $GLOBALS['xoopsDB']->queryF($query2);
            while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                $dom_joues += ($row2[EXTG] + $row2[EXTN] + $row2[EXTP]);
                $ext_joues += $row2[EXTG] + $row2[EXTN] + $row2[EXTP];
                $dom_buts  += ($row2[EXTBUTSCONTRE]);
                $ext_buts  += ($row2[EXTBUTSPOUR]);
                $dom_buts  = intval((($dom_buts) / $dom_joues));
                $ext_buts  = intval((($ext_buts) / $ext_joues));
            }

            $domproba = "<i><font size=1>" . $dom_buts . "</i>";
            $extproba = "<i><font size=1>" . $ext_buts . "</i>";
        }

        if ($x == 1) {
            $date = ereg_replace('^([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})$', '\\3/\\2/\\1', $row[4]);
            echo "<TR  ><TH colspan=5 text-align='center'><b><font size='2'>" . $legende . " " . $numero . "<br>" . CONSULT_MATCHS_MSG2 . "" . $date . "</font></b></th></tr>";
        }

        if ($row[0] == $equipe_fetiche) {
            $DebMarqueur1 = "<b>";
            $FinMarqueur1 = "</b>";
        } else {
            $DebMarqueur1 = "";
            $FinMarqueur1 = "";
        }

        if ($row[1] == $equipe_fetiche) {
            $DebMarqueur2 = "<b>";
            $FinMarqueur2 = "</b>";
        } else {
            $DebMarqueur2 = "";
            $FinMarqueur2 = "";
        }

        $bgcolor = "#FFFFFF";

        if (($color % 2) == 0) {
            $bgcolor = "#E5E5E5";
        }

        if ($fiches_clubs == "1") {
            echo "<TR bgcolor=$bgcolor><TD align=\"right\"><a href=\"club.php?id_clubs=$row[5]&champ=$champ\">"
                 . $DebMarqueur1
                 . $row[0]
                 . $FinMarqueur1
                 . "</a><TD   align=\"center\">"
                 . $domproba
                 . "<TD  >-<TD  >"
                 . $extproba
                 . "<TD   align=\"left\"><a href=\"club.php?id_clubs=$row[6]&champ=$champ\">"
                 . $DebMarqueur2
                 . $row[1]
                 . $FinMarqueur2
                 . "</a>";
        } elseif (!$fiches_clubs == "1") {
            echo "<TR bgcolor=$bgcolor><TD   align=\"right\">" . $DebMarqueur1 . $row[0] . $FinMarqueur1 . "<TD   align=\"center\">" . $domproba . "<TD  >-<TD  >" . $extproba . "<TD   align=\"left\">" . $DebMarqueur2 . $row[1] . $FinMarqueur2 . "";
        }

        $x++;
        $color += 1;
    }
    //@$GLOBALS['xoopsDB']->freeRecordSet($result);
    echo "</table>";
}

// *** REMPLI LA TABLE xoops_clmnt
function db_xoops_clmnt($legende, $type, $accession, $barrage, $relegation, $champ, $debut, $fin)
{
    global $xoopsDB;
    @$GLOBALS['xoopsDB']->queryF("DELETE FROM " . $xoopsDB->prefix("clmnt") . "");

    if (!$fin) {
        $fin = (nb_equipes($champ) * 2) - 2;
    }
    if (!$debut) {
        $debut = 1;
    }

    // SELECTION DES ".$xoopsDB->prefix("parametres")."
    $query  = "select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champ'";
    $result = ($GLOBALS['xoopsDB']->queryF($query));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $pts_victoire      = $row[pts_victoire];
        $pts_nul           = $row[pts_nul];
        $pts_defaite       = $row[pts_defaite];
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }
    // NOM de EQUIPE FAVORITE a partir de son id
    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($result);
    // victoires domicile
    $query = "SELECT dom.id, count(dom.id), " . $xoopsDB->prefix("clubs") . " .nom, sum(buts_dom), sum(buts_ext) FROM " . $xoopsDB->prefix("equipes") . " as dom, " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix(
            "championnats"
        ) . " 
WHERE dom.id_champ='$champ'
      AND dom.id_club=" . $xoopsDB->prefix("clubs") . " .id
      AND dom.id=" . $xoopsDB->prefix("matchs") . " .id_equipe_dom
      AND buts_dom > buts_ext
      AND " . $xoopsDB->prefix("championnats") . " .id=" . $xoopsDB->prefix("journees") . " .id_champ
      AND " . $xoopsDB->prefix("journees") . " .id=" . $xoopsDB->prefix("matchs") . " .id_journee
      AND " . $xoopsDB->prefix("journees") . " .numero>='$debut'
      AND " . $xoopsDB->prefix("journees") . " .numero<='$fin'
      GROUP by " . $xoopsDB->prefix("clubs") . " .nom ";
    $dom   = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $xoops_clmnt[$row[2]][GDOM]          = $row[1];
        $xoops_clmnt[$row[2]][BUTSDOMPOUR]   = $row[3];
        $xoops_clmnt[$row[2]][BUTSDOMCONTRE] = $row[4];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($dom);
    // Defaites domicile
    $query = "SELECT dom.id, count(dom.id), " . $xoopsDB->prefix("clubs") . " .nom, sum(buts_dom), sum(buts_ext) FROM " . $xoopsDB->prefix("equipes") . " as dom, " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix(
            "championnats"
        ) . " 
WHERE dom.id_champ='$champ'
      AND dom.id_club=" . $xoopsDB->prefix("clubs") . " .id
      AND dom.id=" . $xoopsDB->prefix("matchs") . " .id_equipe_dom
      AND buts_dom < buts_ext
      AND " . $xoopsDB->prefix("championnats") . " .id=" . $xoopsDB->prefix("journees") . " .id_champ
      AND " . $xoopsDB->prefix("journees") . " .id=" . $xoopsDB->prefix("matchs") . " .id_journee
      AND " . $xoopsDB->prefix("journees") . " .numero>='$debut'
      AND " . $xoopsDB->prefix("journees") . " .numero<='$fin'
      GROUP by " . $xoopsDB->prefix("clubs") . " .nom ";
    $dom   = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $xoops_clmnt[$row[2]][PDOM]          = $row[1];
        $xoops_clmnt[$row[2]][BUTSDOMPOUR]   += $row[3];
        $xoops_clmnt[$row[2]][BUTSDOMCONTRE] += $row[4];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($dom);
    // Nuls domicile
    $query = "SELECT dom.id, count(dom.id), " . $xoopsDB->prefix("clubs") . " .nom, sum(buts_dom), sum(buts_ext) FROM " . $xoopsDB->prefix("equipes") . " as dom, " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix(
            "championnats"
        ) . " 
WHERE dom.id_champ='$champ'
      AND dom.id_club=" . $xoopsDB->prefix("clubs") . " .id
      AND dom.id=" . $xoopsDB->prefix("matchs") . " .id_equipe_dom
      AND buts_dom = buts_ext
      AND buts_dom is not null
      AND buts_ext is not null
      AND " . $xoopsDB->prefix("championnats") . " .id=" . $xoopsDB->prefix("journees") . " .id_champ
      AND " . $xoopsDB->prefix("journees") . " .id=" . $xoopsDB->prefix("matchs") . " .id_journee
      AND " . $xoopsDB->prefix("journees") . " .numero>='$debut'
      AND " . $xoopsDB->prefix("journees") . " .numero<='$fin'
      GROUP by " . $xoopsDB->prefix("clubs") . " .nom ";
    $dom   = $GLOBALS['xoopsDB']->queryF($query);
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $xoops_clmnt[$row[2]][NDOM]          = $row[1];
        $xoops_clmnt[$row[2]][BUTSDOMPOUR]   += $row[3];
        $xoops_clmnt[$row[2]][BUTSDOMCONTRE] += $row[4];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($dom);
    // Resultats à domicile
    $query  = "SELECT " . $xoopsDB->prefix("clubs") . " .nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("championnats") . " 
WHERE " . $xoopsDB->prefix("equipes") . ".id_champ=" . $xoopsDB->prefix("championnats") . " .id
      AND " . $xoopsDB->prefix("championnats") . " .id='$champ'
      AND " . $xoopsDB->prefix("equipes") . ".id_club=" . $xoopsDB->prefix("clubs") . " .id";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    // RESULTATS EXTERIEURS :
    // victoires exterieur
    $query = "SELECT ext.id, count(ext.id), " . $xoopsDB->prefix("clubs") . " .nom, sum(buts_ext), sum(buts_dom) FROM " . $xoopsDB->prefix("equipes") . " as ext, " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix(
            "championnats"
        ) . " 
WHERE ext.id_champ='$champ'
      AND ext.id_club=" . $xoopsDB->prefix("clubs") . " .id
      AND ext.id=" . $xoopsDB->prefix("matchs") . " .id_equipe_ext
      AND buts_ext > buts_dom
      AND " . $xoopsDB->prefix("championnats") . " .id=" . $xoopsDB->prefix("journees") . " .id_champ
      AND " . $xoopsDB->prefix("journees") . " .id=" . $xoopsDB->prefix("matchs") . " .id_journee
      AND " . $xoopsDB->prefix("journees") . " .numero>='$debut'
      AND " . $xoopsDB->prefix("journees") . " .numero<='$fin'
      GROUP by " . $xoopsDB->prefix("clubs") . " .nom ";
    $dom   = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $xoops_clmnt[$row[2]][GEXT]          = $row[1];
        $xoops_clmnt[$row[2]][BUTSEXTPOUR]   = $row[3];
        $xoops_clmnt[$row[2]][BUTSEXTCONTRE] = $row[4];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($dom);
    // Defaites exterieur
    $query = "SELECT ext.id, count(ext.id), " . $xoopsDB->prefix("clubs") . " .nom, sum(buts_ext), sum(buts_dom) FROM " . $xoopsDB->prefix("equipes") . " as ext, " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix(
            "championnats"
        ) . " 
WHERE ext.id_champ='$champ'
      AND ext.id_club=" . $xoopsDB->prefix("clubs") . " .id
      AND ext.id=" . $xoopsDB->prefix("matchs") . " .id_equipe_ext
      AND buts_ext < buts_dom
      AND " . $xoopsDB->prefix("championnats") . " .id=" . $xoopsDB->prefix("journees") . " .id_champ
      AND " . $xoopsDB->prefix("journees") . " .id=" . $xoopsDB->prefix("matchs") . " .id_journee
      AND " . $xoopsDB->prefix("journees") . " .numero>='$debut'
      AND " . $xoopsDB->prefix("journees") . " .numero<='$fin'
      GROUP by " . $xoopsDB->prefix("clubs") . " .nom ";
    $dom   = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $xoops_clmnt[$row[2]][PEXT]          = $row[1];
        $xoops_clmnt[$row[2]][BUTSEXTPOUR]   += $row[3];
        $xoops_clmnt[$row[2]][BUTSEXTCONTRE] += $row[4];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($dom);
    // Nuls exterieur
    $query = "SELECT ext.id, count(ext.id), " . $xoopsDB->prefix("clubs") . " .nom, sum(buts_ext), sum(buts_dom) FROM " . $xoopsDB->prefix("equipes") . " as ext, " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("matchs") . " , " . $xoopsDB->prefix("journees") . " , " . $xoopsDB->prefix(
            "championnats"
        ) . " 
WHERE ext.id_champ='$champ'
      AND ext.id_club=" . $xoopsDB->prefix("clubs") . " .id
      AND ext.id=" . $xoopsDB->prefix("matchs") . " .id_equipe_ext
      AND buts_ext = buts_dom
      AND buts_dom is not null
      AND buts_ext is not null
      AND " . $xoopsDB->prefix("championnats") . " .id=" . $xoopsDB->prefix("journees") . " .id_champ
      AND " . $xoopsDB->prefix("journees") . " .id=" . $xoopsDB->prefix("matchs") . " .id_journee
      AND " . $xoopsDB->prefix("journees") . " .numero>='$debut'
      AND " . $xoopsDB->prefix("journees") . " .numero<='$fin'
      GROUP by " . $xoopsDB->prefix("clubs") . " .nom ";

    $dom = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($dom))) {
        $xoops_clmnt[$row[2]][NEXT]          = $row[1];
        $xoops_clmnt[$row[2]][BUTSEXTPOUR]   += $row[3];
        $xoops_clmnt[$row[2]][BUTSEXTCONTRE] += $row[4];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($dom);
    // TABLEAU DE xoops_classeMENT
    $query  = "SELECT " . $xoopsDB->prefix("clubs") . " .nom, " . $xoopsDB->prefix("tapis_vert") . " .pts from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("championnats") . " , " . $xoopsDB->prefix("tapis_vert") . " 
WHERE " . $xoopsDB->prefix("equipes") . ".id_champ=" . $xoopsDB->prefix("championnats") . " .id
      AND " . $xoopsDB->prefix("championnats") . " .id='$champ'
      AND " . $xoopsDB->prefix("equipes") . ".id_club=" . $xoopsDB->prefix("clubs") . " .id
      AND " . $xoopsDB->prefix("equipes") . ".id=" . $xoopsDB->prefix("tapis_vert") . " .id_equipe";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    if ($GLOBALS['xoopsDB']->getRowsNum($result) == 0) {
        @$GLOBALS['xoopsDB']->freeRecordSet($result);
        $query  = "SELECT " . $xoopsDB->prefix("clubs") . " .nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("championnats") . " 
    WHERE " . $xoopsDB->prefix("equipes") . ".id_champ=" . $xoopsDB->prefix("championnats") . " .id
          AND " . $xoopsDB->prefix("championnats") . " .id='$champ'
          AND " . $xoopsDB->prefix("equipes") . ".id_club=" . $xoopsDB->prefix("clubs") . " .id";
        $result = $GLOBALS['xoopsDB']->queryF($query);
    }

    $GLOBALS['xoopsDB']->queryF("LOCK TABLE " . $xoopsDB->prefix("clmnt") . "");

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $x             = $row[0];
        $NOM           = $row[0];
        $DOMJOUES      = $xoops_clmnt[$x][GDOM] + $xoops_clmnt[$x][NDOM] + $xoops_clmnt[$x][PDOM];
        $EXTJOUES      = $xoops_clmnt[$x][GEXT] + $xoops_clmnt[$x][NEXT] + $xoops_clmnt[$x][PEXT];
        $JOUES         = $EXTJOUES + $DOMJOUES;
        $DOMPOINTS     = (($xoops_clmnt[$x][GDOM]) * $pts_victoire) + (($xoops_clmnt[$x][NDOM]) * $pts_nul) + (($xoops_clmnt[$x][PDOM]) * $pts_defaite);
        $EXTPOINTS     = (($xoops_clmnt[$x][GEXT]) * $pts_victoire) + (($xoops_clmnt[$x][NEXT]) * $pts_nul) + (($xoops_clmnt[$x][PEXT]) * $pts_defaite);
        $POINTS        = $DOMPOINTS + $EXTPOINTS + $row[1];
        $G             = ($xoops_clmnt[$x][GEXT]) + ($xoops_clmnt[$x][GDOM]);
        $N             = ($xoops_clmnt[$x][NEXT]) + ($xoops_clmnt[$x][NDOM]);
        $P             = $xoops_clmnt[$x][PEXT] + $xoops_clmnt[$x][PDOM];
        $DOMG          = ($xoops_clmnt[$x][GDOM]);
        $DOMN          = ($xoops_clmnt[$x][NDOM]);
        $DOMP          = $xoops_clmnt[$x][PDOM];
        $EXTG          = ($xoops_clmnt[$x][GEXT]);
        $EXTN          = ($xoops_clmnt[$x][NEXT]);
        $EXTP          = $xoops_clmnt[$x][PEXT];
        $BUTSPOUR      = $xoops_clmnt[$x][BUTSEXTPOUR] + $xoops_clmnt[$x][BUTSDOMPOUR];
        $DOMBUTSPOUR   = $xoops_clmnt[$x][BUTSDOMPOUR];
        $EXTBUTSPOUR   = $xoops_clmnt[$x][BUTSEXTPOUR];
        $BUTSCONTRE    = $xoops_clmnt[$x][BUTSEXTCONTRE] + $xoops_clmnt[$x][BUTSDOMCONTRE];
        $DOMBUTSCONTRE = $xoops_clmnt[$x][BUTSDOMCONTRE];
        $EXTBUTSCONTRE = $xoops_clmnt[$x][BUTSEXTCONTRE];
        $DIFF          = $BUTSPOUR - $BUTSCONTRE;
        $DOMDIFF       = $DOMBUTSPOUR - $DOMBUTSCONTRE;
        $EXTDIFF       = $EXTBUTSPOUR - $EXTBUTSCONTRE;
        $PEN           = $row[1];

        $query1 = "SELECT " . $xoopsDB->prefix("equipes") . ".id FROM " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("clubs") . "  WHERE " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club

                                                        and " . $xoopsDB->prefix("clubs") . " .nom='$NOM'
                                                        and " . $xoopsDB->prefix("equipes") . ".id_champ='$champ'";
        $result1 = $GLOBALS['xoopsDB']->queryF($query1) or die ($GLOBALS['xoopsDB']->error());
        while (false !== ($row1 = $GLOBALS['xoopsDB']->fetchBoth($result1))) {
            $id_equipe = $row1[0];
        }

        $question = "INSERT INTO " . $xoopsDB->prefix("clmnt") . "
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
        $result2 = $GLOBALS['xoopsDB']->queryF($question) || die($GLOBALS['xoopsDB']->error());
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($result);
}

function xoops_clmnt($legende, $type, $accession, $barrage, $relegation, $champ, $requete, $lien)
{
    global $xoopsDB;
    // NOM de EQUIPE FAVORITE a partir de son id
    $query  = "select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champ'";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($result);

    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($result);

    echo "<TABLE class='itemHead' align=\"center\" ><font size='2'> <tr  ><th colspan=11>" . $legende;
    echo "<TR>
<TH align=\"center\">" . CLMNT_POSITION . "
<TH>" . CLMNT_EQUIPE . "
<TH><center>" . CLMNT_POINTS . "";
    echo "<TH><center>" . CLMNT_JOUES . "
<TH><center>" . CLMNT_VICTOIRES . "
<TH><center>" . CLMNT_NULS . "
<TH><center>" . CLMNT_DEFAITES . "
<TH><center>" . CLMNT_BUTSPOUR . "
<TH><center>" . CLMNT_BUTSCONTRE . "
<TH><center>" . CLMNT_DIFF . "
<TH><center></font>";

    $result = $GLOBALS['xoopsDB']->queryF($requete) or die ($GLOBALS['xoopsDB']->error());
    $pl = 1;

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($row[NOM] == EXEMPT) {
            continue;
        }
        if ($pl <= $accession and $type == GENERAL) {
            echo "<TR   bgcolor=#99FFCC>";
        } elseif ($pl <= $barrage and $type == GENERAL) {
            echo "</tr><TR   bgcolor=#66CCFF>";
        } elseif ($pl > $relegation and $type == GENERAL) {
            echo "</tr><TR   bgcolor=#FF9966>";
        } elseif (($pl % 2) == 0) {
            echo "<TR   bgcolor=#E5E5E5>";
        } else {
            echo "<TR   bgcolor=#FFFFFF>";
        }

        echo "<TD  >";
        print $pl;
        $pl++;
        $x = 0;

        while ($x < 9) {
            echo "<TD  >";

            if ($x == 0) {
                echo "<p align=\"left\">";
            }
            if ($row[$x] == $equipe_fetiche) {
                echo "<b>";
            }
            if ($x == 0) {
                $query2  = "SELECT " . $xoopsDB->prefix("equipes") . ".id, " . $xoopsDB->prefix("clubs") . " .nom FROM " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("clubs") . " 
                    WHERE " . $xoopsDB->prefix("clubs") . " .nom='$row[0]'
                          AND " . $xoopsDB->prefix("equipes") . ".id_champ='$champ'
                          AND " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club";
                $result2 = $GLOBALS['xoopsDB']->queryF($query2);

                while (false !== ($id_equipe = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                    $id = $id_equipe[id];
                }
                @$GLOBALS['xoopsDB']->freeRecordSet($result2);
                if ($lien == 'non') {
                    echo "$row[$x]";
                } else {
                    echo "<a href=\"" . $chemin . "detaileq.php?champ=$champ&id_equipe=$id\">$row[$x]</a>";
                }
            } else {
                print $row[$x];
            }
            $x++;
            echo "</b>";
        }
        echo "<td>";
        if ($type == GENERAL) {
            echo "<a href=\"#\" onClick=\"window.open('graph.php?equipe=$id','Stats','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=560,height=320');\"><img src=\"graph.gif\" border=\"0\"></img></a> ";
        }
        echo "</td>";
    }
    @$GLOBALS['xoopsDB']->freeRecordSet($result);
    echo "</table>";
}

function Buteur($legende, $requete, $type, $EquipeFetiche)
{
    global $xoopsDB;
    echo "<TABLE class='itemHead' align=\"center\" cellspacing=\"0\" width=\"60%\"><tr  ><th   colspan=11>" . $legende . "<br>";
    echo "<TR  ><Th  >" . CLMNT_POSITION . "<Th  >" . JOUEUR . "<Th  >" . TEAM . "<Th  >" . ADMIN_JOUEURS_2;
    $query = $requete;
    $result = $GLOBALS['xoopsDB']->queryF($query) or die ($GLOBALS['xoopsDB']->error());
    $pl = 1;
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        echo "<TR  5 bgcolor=#FFFFFF>";
        echo "<TD align=right  >" . $pl;
        $pl++;
        $Test  = "NON";
        $array = explode(",", $EquipeFetiche);

        if (sizeof($array) == 1) {
            if ($row[idClub] == $array[0]) {
                $Test = "OUI";
            }
        } else {
            for ($i = "0"; $i < sizeof($array); $i++) {
                if ("'$row[idClub]'" == $array[$i]) {
                    $Test = "OUI";
                }
            }
        }

        if ($Test == "OUI") {
            echo "<TD  ><b>" . $row[3] . " " . $row[2] . "</b>";
            echo "<TD  ><b>" . $row[7] . "</b>";
            echo "<TD align=center  ><b>" . $row[1] . "</b>";
        } else {
            echo "<TD  >" . $row[3] . " " . $row[2];
            echo "<TD  >" . $row[7];
            echo "<TD align=center  >" . $row[1];
        }
    }
    echo "</table>";
}

/////////////////////////////////////////////////////////////////////////////////////////////////
// Titre       : Add-on Gestion des ".$xoopsDB->prefix("clubs")."  (Fiches clubs), mini-xoops_classement,                     //
//               statistiques, amélioration de la gestion des xoops_buteurs pour PhpLeague.          //
// Auteur      : Alexis MANGIN                                                                 //
// Email       : Alexis@univert.org                                                            //
// Url         : http://www.univert.org                                                        //
// Démo        : http://univert42.free.fr/adversaire/xoops_classement/consult/classement.php?champ=2 //
// Description : Edition, gestion, Fiches clubs, statistiques, mini-xoops_classement...              //
// Version     : 0.71 (29/03/2004)                                                             //
//                                                                                             //
//                                                                                             //
// L'Univert   : Retrouvez quotidiennement l'actualité des Verts ainsi que de                  //
//               nombreuses autres rubriques consacrées à l'AS Saint-Etienne. Mais             //
//               L'Univert c'est avant tout la présentation d'un club devenu légende.          //
//                                                                                             //
/////////////////////////////////////////////////////////////////////////////////////////////////

// Affichage ".$xoopsDB->prefix("rens")." eignements utilisée dans consult/club.php
function aff_xoops_rens($id_classe, $id_clubs)
{
    global $xoopsDB;
    $query         = "select "
                     . $xoopsDB->prefix("donnee")
                     . " .id, "
                     . $xoopsDB->prefix("donnee")
                     . " .nom, id_rens, id_clubs, "
                     . $xoopsDB->prefix("rens")
                     . " .id, "
                     . $xoopsDB->prefix("rens")
                     . " .nom, "
                     . $xoopsDB->prefix("rens")
                     . " .id_classe, "
                     . $xoopsDB->prefix("clubs")
                     . " .id, etat, "
                     . $xoopsDB->prefix("donnee")
                     . " .url, "
                     . $xoopsDB->prefix("rens")
                     . " .url
FROM "
                     . $xoopsDB->prefix("donnee")
                     . " , "
                     . $xoopsDB->prefix("rens")
                     . " , "
                     . $xoopsDB->prefix("clubs")
                     . " 
WHERE id_clubs='$id_clubs' 
      AND id_clubs="
                     . $xoopsDB->prefix("clubs")
                     . " .id
      AND id_rens="
                     . $xoopsDB->prefix("rens")
                     . " .id 
      AND id_classe='$id_classe' 
      AND etat='1' order by rang";
    $result        = $xoopsDB->queryF($query);
    $nb_xoops_rens = $GLOBALS['xoopsDB']->getRowsNum($result);

    if ($nb_xoops_rens == "0") {
        echo "<center>" . ADMIN_EQUIPE_8 . "</center>";
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

function xoops_clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini)
{
    global $xoopsDB;

    // NOM de EQUIPE FAVORITE a partir de son id
    $query  = "select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champmini'";
    $result = ($GLOBALS['xoopsDB']->queryF($query));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }

    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }

    echo "<TABLE class='itemHead'  align=\"center\"   cellspacing=\"0\"><tr  ><th   colspan=10>" . $legendemini;
    echo "<TR  ><TH  >" . CLMNT_POSITION . "";
    echo "<TH  >" . CLMNT_EQUIPE . "";
    echo "<TH  >" . CLMNT_POINTS . "";
    //echo "<TH  >".CLMNT_JOUES."";
    //echo "<TH  >".CLMNT_VICTOIRES."";
    //echo "<TH  >".CLMNT_NULS."";
    //echo "<TH  >".CLMNT_DEFAITES."";
    //echo "<TH  >".CLMNT_BUTSPOUR."";
    //echo "<TH  >".CLMNT_BUTSCONTRE."";
    //echo "<TH  >".CLMNT_DIFF;
    $result = $GLOBALS['xoopsDB']->queryF($requetemini) or die ($GLOBALS['xoopsDB']->error());
    $pl  = 0;
    $pl2 = 1;

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($row[NOM] == $equipe_fetiche) {
            $av = $pl2 - $nb_dessusmini;
            $ap = $pl2 + $nb_dessousmini;
        }
        $pl2++;
    }

    $result = $GLOBALS['xoopsDB']->queryF($requetemini) or die ($GLOBALS['xoopsDB']->error());
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($pl > $ap) {
            $pl++;
        }
        if ($pl < $av) {
            $pl++;
        }
        if ($pl <= $ap and $pl >= $av) {
            if ($row[NOM] == EXEMPT) {
                continue;
            } elseif ($pl <= $accessionmini and $typemini == GENERAL) {
                echo "<TR   bgcolor=#99FFCC>";
            }  //accession
            elseif ($pl <= $barragemini and $typemini == GENERAL) {
                echo "</tr><TR   bgcolor=#66CCFF>";
            }  //barrage
            elseif ($pl > $relegationmini and $typemini == GENERAL) {
                echo "</tr><TR   bgcolor=#FF9966>";
            } //relegation
            elseif (($pl % 2) == 0) {
                echo "<TR   bgcolor=#E5E5E5>";
            } else {
                echo "<TR   bgcolor=#FFFFFF>";
            }

            echo "<TD  >";
            print $pl;
            $pl++;
            $x = 0;

            while ($x < 2)   // nb de colones
            {
                echo "<TD   align =\"left\">";

                if ($x == 0) {
                    echo "<p align=\"left\">";
                }
                if ($row[$x] == $equipe_fetiche) {
                    echo "<b>";
                }
                if ($x == 0) {
                    $query2  = "SELECT " . $xoopsDB->prefix("equipes") . ".id, " . $xoopsDB->prefix("clubs") . " .nom FROM " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("clubs") . " 
                    WHERE " . $xoopsDB->prefix("clubs") . " .nom='$row[0]'
                          AND " . $xoopsDB->prefix("equipes") . ".id_champ='$champ'
                          AND " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club";
                    $result2 = $GLOBALS['xoopsDB']->queryF($query2);

                    while (false !== ($id_equipe = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                        $id = $id_equipe[id];
                    }
                    if ($lien == 'non') {
                        echo "$row[$x]";
                    } else {
                        echo "<a href=\"" . $cheminmini . "detaileq.php?champ=$champ&id_equipe=$id\">$row[$x]</a>";
                    }
                } else {
                    print $row[$x];
                }
                $x++;
                echo "</b>";
            }
        }
    }
    echo "</table>";
}

function xoops_clmnt_barre($legende, $type, $accession, $barrage, $relegation, $champ, $requete, $lien)
{
    global $xoopsDB;
    // NOM de EQUIPE FAVORITE a partir de son id
    $query  = "select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champ'";
    $result = ($GLOBALS['xoopsDB']->queryF($query));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }

    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }
    echo "<TABLE class='itemHead' align=\"center\" cellspacing=\"0\" width=\"60%\"><tr  ><th   colspan=11>" . $legende;
    echo "<TR>
<TH align=\"center\">" . CLMNT_POSITION . "
<TH>" . CLMNT_EQUIPE . "
<TH><center>" . CLMNT_POINTS . "";

    echo "<TH><center>" . CLMNT_JOUES . "
<TH><center>" . CLMNT_VICTOIRES . "
<TH><center>" . CLMNT_NULS . "
<TH><center>" . CLMNT_DEFAITES . "
<TH><center>" . CLMNT_BUTSPOUR . "
<TH><center>" . CLMNT_BUTSCONTRE . "
<TH><center>" . CLMNT_DIFF . "
<TH><center>";
    $result = $GLOBALS['xoopsDB']->queryF($requete) or die ($GLOBALS['xoopsDB']->error());
    $pl     = 1;
    $action = 0;
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($row[NOM] == EXEMPT) {
            continue;
        }
        if ($pl == $accession and $type == GENERAL) {
            $action = 1;
        }
        if (($pl % 2) == 0) {
            echo "<TR   bgcolor=#E5E5E5>";
        } else {
            echo "<TR   bgcolor=#FFFFFF>";
        }
        //if ($pl==($accession+1) and $type==GENERAL){$action=1;} // Si vous souhaitez encadrer le premier non promu
        if ($pl == $relegation and $type == GENERAL) {
            $action = 1;
        }

        echo "<TD  >";
        print $pl;
        $pl++;
        $x = 0;

        while ($x < 9) {
            echo "<TD  >";

            if ($x == 0) {
                echo "<p align=\"left\">";
            }
            if ($row[$x] == $equipe_fetiche) {
                echo "<b>";
            }
            if ($x == 0) {
                $query2  = "SELECT " . $xoopsDB->prefix("equipes") . ".id, " . $xoopsDB->prefix("clubs") . " .nom FROM " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("clubs") . " 
                    WHERE " . $xoopsDB->prefix("clubs") . " .nom='$row[0]'
                          AND " . $xoopsDB->prefix("equipes") . ".id_champ='$champ'
                          AND " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club";
                $result2 = $GLOBALS['xoopsDB']->queryF($query2);

                while (false !== ($id_equipe = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                    $id = $id_equipe[id];
                }
                if ($lien == 'non') {
                    echo "$row[$x]";
                } else {
                    echo "<a href=\"" . $chemin . "detaileq.php?champ=$champ&id_equipe=$id\">$row[$x]</a>";
                }
            } else {
                print $row[$x];
            }
            $x++;
            echo "</b>";
        }
        echo "<td>";
        if ($type == GENERAL) {
            echo "<a href=\"#\" onClick=\"window.open('graph.php?equipe=$id','Stats','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=560,height=320');\"><img src=\"graph.gif\" border=\"0\"></img></a> ";
        }
        echo "</td>";

        if ($action == 0) {
            echo "<tr><td bgcolor=\"#000000\" colspan=\"11\"></td></tr>";
            $action = 0;
        }
        if ($action == 1) {
            echo "<tr><td bgcolor=\"#000000\" colspan=\"11\"><IMG height=\"1\" src=\"pix.gif\" width=\"1\" border=\"0\"></td></tr>";
            $action = 0;
        }
    }
    echo "</table>";
}

function xoops_clmntmini_barre($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini)
{
    global $xoopsDB;

    // NOM de EQUIPE FAVORITE a partir de son id
    $query  = "select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champmini'";
    $result = ($GLOBALS['xoopsDB']->queryF($query));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }

    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }

    echo "<TABLE class='itemHead'  align=\"center\"   cellspacing=\"0\"><tr  ><th   colspan=10>" . $legendemini;
    echo "<TR  ><TH  >" . CLMNT_POSITION . "";
    echo "<TH  >" . CLMNT_EQUIPE . "";
    echo "<TH  >" . CLMNT_POINTS . "";
    //echo "<TH  >".CLMNT_JOUES."";
    //echo "<TH  >".CLMNT_VICTOIRES."";
    //echo "<TH  >".CLMNT_NULS."";
    //echo "<TH  >".CLMNT_DEFAITES."";
    //echo "<TH  >".CLMNT_BUTSPOUR."";
    //echo "<TH  >".CLMNT_BUTSCONTRE."";
    //echo "<TH  >".CLMNT_DIFF;
    $result = $GLOBALS['xoopsDB']->queryF($requetemini) or die ($GLOBALS['xoopsDB']->error());
    $pl = 0;

    $pl2 = 1;

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($row[NOM] == $equipe_fetiche) {
            $av = $pl2 - $nb_dessusmini;
            $ap = $pl2 + $nb_dessousmini;
        }
        $pl2++;
    }

    $result = $GLOBALS['xoopsDB']->queryF($requetemini) or die ($GLOBALS['xoopsDB']->error());
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($pl > $ap) {
            $pl++;
        }
        if ($pl < $av) {
            $pl++;
        }
        if ($pl <= $ap and $pl >= $av) {
            if ($row[NOM] == EXEMPT) {
                continue;
            }
            if ($pl == $accessionmini) {
                $action = 1;
            }
            if (($pl % 2) == 0) {
                echo "<TR   bgcolor=#E5E5E5>";
            } else {
                echo "<TR   bgcolor=#FFFFFF>";
            }
            //if ($pl==($accession+1)){$action=1;}  // Si vous souhaitez encadrer le premier non promu
            if ($pl == $relegationmini) {
                $action = 1;
            }

            echo "<TD  >";
            print $pl;
            $pl++;
            $x = 0;

            while ($x < 2) // nb de colone
            {
                echo "<TD  >";

                if ($x == 0) {
                    echo "<p align=\"left\">";
                }

                if ($row[$x] == $equipe_fetiche) {
                    echo "<b>";
                }

                if ($x == 0) {
                    $query2  = "SELECT " . $xoopsDB->prefix("equipes") . ".id, " . $xoopsDB->prefix("clubs") . " .nom FROM " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("clubs") . " 
                    WHERE " . $xoopsDB->prefix("clubs") . " .nom='$row[0]'
                          AND " . $xoopsDB->prefix("equipes") . ".id_champ='$champ'
                          AND " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club";
                    $result2 = $GLOBALS['xoopsDB']->queryF($query2);

                    while (false !== ($id_equipe = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                        $id = $id_equipe[id];
                    }

                    if ($lienmini == 'non') {
                        echo "$row[$x]";
                    } else {
                        echo "<a href=\"" . $cheminmini . "detaileq.php?champ=$champmini&id_equipe=$id\">$row[$x]</a>";
                    }
                } else {
                    print $row[$x];
                }
                $x++;
                echo "</b>";
            }
            if ($action == 0 and $typemini == GENERAL) {
                echo "<tr><td bgcolor=\"#000000\" colspan=\"10\"></td></tr>";
                $action = 0;
            }
            if ($action == 1 and $typemini == GENERAL) {
                echo "<tr><td bgcolor=\"#000000\" colspan=\"10\"><IMG height=\"1\" src=\"pix.gif\" width=\"1\" border=\"0\"></td></tr>";
                $action = 0;
            }
        }
    }
    echo "</table>";
}

function xoops_clmntred($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $cheminmini)
{
    global $xoopsDB;
    // NOM de EQUIPE FAVORITE a partir de son id
    $query  = "select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champmini'";
    $result = ($GLOBALS['xoopsDB']->queryF($query));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }

    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }

    echo "<TABLE class='itemHead' align=\"center\" cellspacing=\"0\" ><tr  ><th   colspan=10>" . $legendemini;
    echo "<TR  >
<TH   align=\"center\">" . CLMNT_POSITION . "
<TH  >" . CLMNT_EQUIPE . "
<TH  ><center>" . CLMNT_POINTS . "";

    $result = $GLOBALS['xoopsDB']->queryF($requetemini) or die ($GLOBALS['xoopsDB']->error());
    $pl = 1;

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($row[NOM] == EXEMPT) {
            continue;
        }
        if ($pl <= $accessionmini and $typemini == GENERAL) {
            echo "<TR   bgcolor=#99FFCC>";
        } elseif ($pl <= $barragminie and $typemini == GENERAL) {
            echo "</tr><TR   bgcolor=#66CCFF>";
        } elseif ($pl > $relegationmini and $typemini == GENERAL) {
            echo "</tr><TR   bgcolor=#FF9966>";
        } elseif (($pl % 2) == 0) {
            echo "<TR   bgcolor=#E5E5E5>";
        } else {
            echo "<TR   bgcolor=#FFFFFF>";
        }

        echo "<TD  >";
        print $pl;
        $pl++;
        $x = 0;

        while ($x < 2) {
            echo "<TD  >";

            if ($x == 0) {
                echo "<p align=\"left\">";
            }
            if ($row[$x] == $equipe_fetiche) {
                echo "<b>";
            }
            if ($x == 0) {
                $query2  = "SELECT " . $xoopsDB->prefix("equipes") . ".id, " . $xoopsDB->prefix("clubs") . " .nom FROM " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("clubs") . " 
                    WHERE " . $xoopsDB->prefix("clubs") . " .nom='$row[0]'
                          AND " . $xoopsDB->prefix("equipes") . ".id_champ='$champ'
                          AND " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club";
                $result2 = $GLOBALS['xoopsDB']->queryF($query2);

                while (false !== ($id_equipe = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                    $id = $id_equipe[id];
                }
                if ($lienmini == 'non') {
                    echo "$row[$x]";
                } else {
                    echo "<a href=\"" . $cheminmini . "detaileq.php?champ=$champ&id_equipe=$id\">$row[$x]</a>";
                }
            } else {
                print $row[$x];
            }
            $x++;
            echo "</b>";
        }
    }

    echo "</table>";
}

function xoops_clmnt_barrered($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $cheminmini)
{
    global $xoopsDB;
    // NOM de EQUIPE FAVORITE a partir de son id
    $query  = "select * from " . $xoopsDB->prefix("parametres") . "  where id_champ='$champmini'";
    $result = ($GLOBALS['xoopsDB']->queryF($query));

    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $id_equipe_fetiche = $row[id_equipe_fetiche];
    }

    $result = ($GLOBALS['xoopsDB']->queryF("select nom from " . $xoopsDB->prefix("clubs") . " , " . $xoopsDB->prefix("equipes") . " where " . $xoopsDB->prefix("equipes") . ".id='$id_equipe_fetiche' and " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club"));
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $equipe_fetiche = $row[0];
    }
    echo "<TABLE class='itemHead' align=\"center\" cellspacing=\"0\"><tr><th colspan=10>" . $legendemini;
    echo "<TR  >
<TH   align=\"center\">" . CLMNT_POSITION . "
<TH  >" . CLMNT_EQUIPE . "
<TH  ><center>" . CLMNT_POINTS . "";

    $result = $GLOBALS['xoopsDB']->queryF($requetemini) or die ($GLOBALS['xoopsDB']->error());
    $pl     = 1;
    $action = 0;
    while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        if ($row[NOM] == EXEMPT) {
            continue;
        }
        if ($pl == $accessionmini and $typemini == GENERAL) {
            $action = 1;
        }
        if (($pl % 2) == 0) {
            echo "<TR   bgcolor=#E5E5E5>";
        } else {
            echo "<TR   bgcolor=#FFFFFF>";
        }
        //if ($pl==($accession+1) and $type==GENERAL){$action=1;} // Si vous souhaitez encadrer le premier non promu
        if ($pl == $relegationmini and $typemini == GENERAL) {
            $action = 1;
        }

        echo "<TD  >";
        print $pl;
        $pl++;
        $x = 0;

        while ($x < 2) {
            echo "<TD  >";

            if ($x == 0) {
                echo "<p align=\"left\">";
            }
            if ($row[$x] == $equipe_fetiche) {
                echo "<b>";
            }
            if ($x == 0) {
                $query2  = "SELECT " . $xoopsDB->prefix("equipes") . ".id, " . $xoopsDB->prefix("clubs") . " .nom FROM " . $xoopsDB->prefix("equipes") . ", " . $xoopsDB->prefix("clubs") . " 
                    WHERE " . $xoopsDB->prefix("clubs") . " .nom='$row[0]'
                          AND " . $xoopsDB->prefix("equipes") . ".id_champ='$champ'
                          AND " . $xoopsDB->prefix("clubs") . " .id=" . $xoopsDB->prefix("equipes") . ".id_club";
                $result2 = $GLOBALS['xoopsDB']->queryF($query2);

                while (false !== ($id_equipe = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
                    $id = $id_equipe[id];
                }
                if ($lienmini == 'non') {
                    echo "$row[$x]";
                } else {
                    echo "<a href=\"" . $cheminmini . "detaileq.php?champ=$champ&id_equipe=$id\">$row[$x]</a>";
                }
            } else {
                print $row[$x];
            }
            $x++;
            echo "</b>";
        }
        if ($action == 0) {
            echo "<tr><td bgcolor=\"#000000\" colspan=\"10\"></td></tr>";
            $action = 0;
        }
        if ($action == 1) {
            echo "<tr><td bgcolor=\"#000000\" colspan=\"10\"><IMG height=\"1\" src=\"pix.gif\" width=\"1\" border=\"0\"></td></tr>";
            $action = 0;
        }
    }
    echo "</table>";
}

function time1()
{ //calcul du temps de debut de recherche
    global $xoopsDB;
    $time_deb = microtime();
    $time_deb = explode(" ", $time_deb);
    $time_deb = $time_deb[0] + $time_deb[1];
}

function time2($page, $nom)
{
    global $xoopsDB;
    $time_fin    = microtime();
    $time_fin    = explode(" ", $time_fin);
    $time_fin    = $time_fin[0] + $time_fin[1];
    $time_search = $time_fin - $time_deb;
    print $time_search;
    $query = "INSERT into chargement (id_page, temps) VALUES ($page, $time_search) ";
    $GLOBALS['xoopsDB']->queryF($query) || die($GLOBALS['xoopsDB']->error());
}

?>
