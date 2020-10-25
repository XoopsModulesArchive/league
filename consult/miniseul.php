<html>
<link rel="stylesheet" type="text/css" href="../league.css">
<?
if (!$marqueur == '1') {
    require "../config.php";
    require "../consult/fonctions.php";

    $marqueur = "1";
}
if (!$champmini) {
    // pour quel championnat ?
    echo "<form action=\"$PHP_SELF\" method=\"GET\">";
    echo "<h4 align=\"center\">";
    echo ADMIN_TAPVERT_MSG2;
    echo "</h4>";
    echo "<select name=\"champmini\" align=\"center\">";
    echo "<option value=\"0\" align=\"center\"> </option>";
    $query  = "SELECT DISTINCT xoops_divisions.nom, xoops_saisons.annee, xoops_championnats.id
FROM xoops_championnats, xoops_divisions, xoops_saisons, xoops_journees
WHERE xoops_journees.id_champ=xoops_championnats.id AND xoops_championnats.id_division=xoops_divisions.id AND xoops_championnats.id_saison=xoops_saisons.id ORDER BY xoops_saisons.annee DESC, xoops_championnats.id";
    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");
        echo("</option>\n>");
    }

    echo "</select>";
    $value = GENERAL;
    echo "<input type=\"hidden\" name=\"typemini\" value=$value>";
    $button = ENVOI;
    echo "<input type=\"submit\" value=$button align=\"center\"> </form>";
}

if (!isset($debutmini)) {
    $debutmini = 1;
    $finmini   = (nb_equipes($champmini) * 2) - 2;
}

//SELECTION DES xoops_equipes
$query  = "SELECT xoops_clubs.nom from xoops_clubs, xoops_equipes, xoops_championnats
WHERE xoops_equipes.id_champ=xoops_championnats.id
AND xoops_championnats.id='$champmini'
AND xoops_equipes.id_club=xoops_clubs.id";
$result = $GLOBALS['xoopsDB']->queryF($query);
while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
    $equipe[] = $row[0];
}

switch ($typemini) {
    case GENERAL;    // xoops_classeMENT GENERAL
        {
            // RAPPEL DES xoops_parametres du CHAMPIONNAT
            $result = $GLOBALS['xoopsDB']->queryF("select * from xoops_parametres where id_champ='$champmini'");
            while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
                $accessionmini  = $row[accession];
                $barragemini    = $row[barrage] + $accessionmini;
                $relegationmini = nb_equipes($champmini) - $row[relegation];
            }
            //$legende=CONSULT_CLMNT_MSG4.$debutmini.CONSULT_CLMNT_MSG5.$fin;

            $requetemini = "SELECT * FROM xoops_clmnt ORDER BY POINTS DESC, DIFF DESC, BUTSPOUR DESC , BUTSCONTRE ASC, NOM";

            db_xoops_clmnt($legendemini, GENERAL, $accessionmini, $barragemini, $relegationmini, $champmini, $debutmini, $finmini);
            if ($presentationmini == "1") {
                if ($classmini == '1') {
                    xoops_clmntred($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $classmini, $cheminmini);
                }
            }
            if ($presentationmini == "2") {
                if ($classmini == "1") {
                    xoops_clmnt_barrered($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini_barre($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $classmini, $cheminmini);
                }
            }
        }

        break;

    case DOMICILE;
        {
            $requetemini = "SELECT NOM, DOMPOINTS, DOMJOUES, DOMG,  DOMN, DOMP, DOMBUTSPOUR, DOMBUTSCONTRE, DOMDIFF  from xoops_clmnt ORDER BY DOMPOINTS DESC, DOMDIFF DESC";
            db_xoops_clmnt($legendemini, DOMICILE, $accessionmini, $barragemini, $relegationmini, $champmini, $debutmini, $finmini, $pts_victoiremini, $pts_nulmini, $pts_defaitemini);
            if ($presentationmini == "1") {
                if ($classmini == '1') {
                    xoops_clmntred($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $classmini, $cheminmini);
                }
            }
            if ($presentationmini == "2") {
                if ($classmini == '1') {
                    xoops_clmnt_barrered($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champminimini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini_barre($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini);
                }
            }
        }
        break;

    case ATTAQUE;
        {
            $requetemini = "SELECT * from xoops_clmnt ORDER BY BUTSPOUR DESC, DIFF DESC";
            db_xoops_clmnt($legendemini, ATTAQUE, $accessionmini, $barragemini, $relegationmini, $champmini, $debutmini, $finmini, $pts_victoiremini, $pts_nulmini, $pts_defaitemini, $cheminmini);
            if ($presentationmini == "1") {
                if ($classmini == '1') {
                    xoops_clmntred($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $classmini, $cheminmini);
                }
            }
            if ($presentationmini == "2") {
                if ($classmini == '1') {
                    xoops_clmnt_barrered($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champminimini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini_barre($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini);
                }
            }
        }

        break;

    case DEFENSE;
        {
            $requetemini = "SELECT * FROM xoops_clmnt ORDER BY BUTSCONTRE ASC, DIFF DESC";
            db_xoops_clmnt($legendemini, DEFENSE, $accessionmini, $barragemini, $relegationmini, $champmini, $debutmini, $finmini, $pts_victoiremini, $pts_nulmini, $pts_defaitemini, $cheminmini);
            if ($presentationmini == "1") {
                if ($classmini == '1') {
                    xoops_clmntred($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $classmini, $cheminmini);
                }
            }
            if ($presentationmini == "2") {
                if ($classmini == '1') {
                    xoops_clmnt_barrered($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champminimini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini_barre($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini);
                }
            }
        }
        break;

    case GOALDIFF;
        {
            $requetemini = "SELECT * FROM xoops_clmnt ORDER BY DIFF DESC, BUTSPOUR DESC, BUTSCONTRE ASC ";
            db_xoops_clmnt($legendemini, GOALDIFF, $accessionmini, $barragemini, $relegationmini, $champmini, $debutmini, $finmini, $pts_victoiremini, $pts_nulmini, $pts_defaitemini, $cheminmini);
            if ($presentationmini == "1") {
                if ($classmini == '1') {
                    xoops_clmntred($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $classmini, $cheminmini);
                }
            }
            if ($presentationmini == "2") {
                if ($classmini == '1') {
                    xoops_clmnt_barrered($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champminimini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini_barre($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini);
                }
            }
        }
        break;

    case EXTERIEUR;
        {
            $requetemini = "SELECT NOM, EXTPOINTS, EXTJOUES, EXTG,  EXTN, EXTP, EXTBUTSPOUR, EXTBUTSCONTRE, EXTDIFF  from xoops_clmnt ORDER BY EXTPOINTS DESC, EXTDIFF DESC ";
            db_xoops_clmnt($legendemini, EXTERIEUR, $accessionmini, $barragemini, $relegationmini, $champmini, $debutmini, $finmini, $pts_victoiremini, $pts_nulmini, $pts_defaitemini, $cheminmini);
            if ($presentationmini == "1") {
                if ($classmini == '1') {
                    xoops_clmntred($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $classmini, $cheminmini);
                }
            }
            if ($presentationmini == "2") {
                if ($classmini == '1') {
                    xoops_clmnt_barrered($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champminimini, $requetemini, $lienmini, $classmini, $cheminmini);
                } else {
                    xoops_clmntmini_barre($legendemini, $typemini, $accessionmini, $barragemini, $relegationmini, $champmini, $requetemini, $nb_dessusmini, $nb_dessousmini, $lienmini, $cheminmini);
                }
            }
        }
        break;
        @$GLOBALS['xoopsDB']->queryF("UNLOCK TABLE xoops_clmnt");
}

?>
