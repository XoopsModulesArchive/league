<?
include ("avant.php");
if (!$marqueur=='1')
{require ("../config.php") ;
require ("../consult/fonctions.php");
 }
ENTETE2 ();
$marqueur="1";
if (!isset($debut))
   {
       $debut=1;
       $fin=(nb_equipes($champ)*2)-2 ;
   }
if (!$champ)
   {
       // pour quel championnat ?
        require_once XOOPS_ROOT_PATH.'/header.php';
	   echo "<form action=\"$PHP_SELF\" method=\"GET\">";
       echo "<h4 align=\"center\">";
       echo ADMIN_TAPVERT_MSG2;
       echo "</h4>";
       echo "<select name=\"champ\" align=\"center\">";
       echo "<option value=\"0\" align=\"center\"> </option>";
       $query = "SELECT DISTINCT xoops_divisions.nom, xoops_saisons.annee, xoops_championnats.id
FROM xoops_championnats, xoops_divisions, xoops_saisons, xoops_journees
WHERE xoops_journees.id_champ=xoops_championnats.id AND xoops_championnats.id_division=xoops_divisions.id AND xoops_championnats.id_saison=xoops_saisons.id ORDER BY xoops_saisons.annee DESC, xoops_championnats.id";
       $result=$GLOBALS['xoopsDB']->queryF($query);

           while($row = $xoopsDB->fetchRow($result))
           {
               echo ("<option value=\"$row[2]\">$row[0]\n $row[1]/". ($row[1]+1)."\n");
               echo ("</option>\n>");
           }

        echo "</select>";
		$value=GENERAL;
        echo "<input type=\"hidden\" name=\"type\" value=$value>";
		$button=ENVOI;
        echo "<input type=\"submit\" value=$button align=\"center\"> </form>";
   }
    require_once XOOPS_ROOT_PATH.'/footer.php';
else
{

// MENU TYPES DE xoops_classeMENT
 require_once XOOPS_ROOT_PATH.'/header.php';
echo "<form action=\"$PHP_SELF\" method=\"GET\" target=\"_self\">";
echo "<p align=\"center\">";
echo CONSULT_CLMNT_MSG1;
echo " </b><select name=\"type\">";
if (!(isset($type))) {$type=GENERAL;}
echo "<option value=\"$type\" selected>$type</option>";
if ($type<>GENERAL)
{$value=GENERAL;
echo "<option value=$value> $value</option>";}
if ($type<>DOMICILE)
{$value=DOMICILE;
echo "<option value=$value> $value</option>";}
if ($type<>EXTERIEUR)
{$value=EXTERIEUR;
echo "<option value=$value> $value</option>";}
if ($type<>ATTAQUE)
{$value=ATTAQUE;
echo "<option value=$value> $value</option>";}
if ($type<>DEFENSE)
{$value=DEFENSE;
echo "<option value=$value> $value</option>";}
if ($type<>GOALDIFF)
{$value=GOALDIFF;
echo "<option value=$value> Goal average</option>";}
echo "</select>";
echo CONSULT_CLMNT_MSG2;
echo " <select name=\"debut\">";
        $f=1;
    while ($f<=(nb_equipes($champ)*2)-2)
        {
        if ($f==$debut)
                {echo "<option value=\"$debut\" selected> $debut</option>  ";}
                else
        {echo "<option value=\"$f\"> $f</option>";}
        $f++;
        }
    echo "</select>";
    // journée de fin
    echo CONSULT_CLMNT_MSG3;
    echo " <select name=\"fin\">";
    $x=(nb_equipes($champ)*2)-2 ;
        $f=1;
    while ($f<=$x)
        {
        if ($f==$fin)
                {echo "<option value=\"$fin\" selected> $fin</option>  ";}
                else
        {echo "<option value=\"$f\"> $f</option>";}
        $f++;
        }
    echo "  ";
    echo "</select><input type=\"hidden\" name=\"champ\" value=\"$champ\">";
	$button=ENVOI;
    echo "<input type=\"submit\" value=$button>  </form>";
    echo "</b>";
    echo "</p>";


$query="SELECT xoops_divisions.nom, xoops_saisons.annee, (xoops_saisons.annee)+1 FROM xoops_championnats, xoops_divisions, xoops_saisons WHERE xoops_championnats.id='$champ' AND xoops_divisions.id=xoops_championnats.id_division AND xoops_saisons.id=xoops_championnats.id_saison";
$result=$xoopsDB->queryF($query); 

        while (false !== ($row=$GLOBALS['xoopsDB']->fetchBoth($result)))
        {
            echo "<align=\"center\">".$row[0]."  ".$row[1]."/".$row[2]."";
        }


//SELECTION DES xoops_equipes
$query="SELECT xoops_clubs.nom from xoops_clubs, xoops_equipes, xoops_championnats
WHERE xoops_equipes.id_champ=xoops_championnats.id
AND xoops_championnats.id='$champ'
AND xoops_equipes.id_club=xoops_clubs.id";
$result=$GLOBALS['xoopsDB']->queryF($query);
while($row=$GLOBALS['xoopsDB']->fetchBoth($result))
     {
     $equipe[]=$row[0];
     }          
     }


$class=0;
$lien="oui";
switch($type)
{
case GENERAL;    // xoops_classeMENT GENERAL
        {
 // RAPPEL DES xoops_parametres du CHAMPIONNAT
$result=$GLOBALS['xoopsDB']->queryF("select * from xoops_parametres where id_champ='$champ'");
while (false !== ($row=$GLOBALS['xoopsDB']->fetchBoth($result)))
  {
    $accession = $row[accession];
    $barrage = $row[barrage] + $accession;
    $relegation = nb_equipes($champ)- $row[relegation];
  }
$legende=CONSULT_CLMNT_MSG4.$debut.CONSULT_CLMNT_MSG5.$fin;
$requete="SELECT * FROM xoops_clmnt ORDER BY POINTS DESC, DIFF DESC, BUTSPOUR DESC , BUTSCONTRE ASC, NOM";


//db_xoops_clmnt($legende, GENERAL, $accession, $barrage, $relegation, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite);
db_xoops_clmnt($legende, GENERAL, $accession, $barrage, $relegation, $champ, $debut, $fin);
//xoops_clmnt($legende, $type, $accession, $barrage, $relegation, $equipe_fetiche, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite, $requete);
xoops_clmnt_barre($legende, $type, $accession, $barrage, $relegation,  $champ, $requete, $lien);


$query="SELECT max(xoops_journees.numero) from xoops_journees, xoops_matchs where xoops_journees.id=xoops_matchs.id_journee and buts_dom is not NULL and xoops_journees.id_champ='$champ'";
$result=$GLOBALS['xoopsDB']->queryF($query);
while (false !== ($row=$GLOBALS['xoopsDB']->fetchRow($result)))
        {
        $numero=$row[0];
        }
?>
<p>&nbsp;<?

aff_journee($champ, $numero, CONSULT_CLMNT_MSG6, 0, $fiches_clubs);
$numero=$numero+1;
if ($numero<=nb_journees($champ))
{
if ($numero>=4) {echo "<br><h5 align=center ><font color=red>".CONSULT_CLMNT_MSG7."<font></h5>";
aff_journee($champ, $numero, "<i>".CONSULT_CLMNT_MSG8, 1, $fiches_clubs); }
else {
echo "<br>";
 aff_journee($champ, $numero, "<i>".CONSULT_CLMNT_MSG9, 0, $fiches_clubs);
}

 }
}

break;



case DOMICILE;
        {
                $legende=CONSULT_CLMNT_MSG10.$debut.CONSULT_CLMNT_MSG5.$fin;
                $requete="SELECT NOM, DOMPOINTS, DOMJOUES, DOMG,  DOMN, DOMP, DOMBUTSPOUR, DOMBUTSCONTRE, DOMDIFF  from xoops_clmnt ORDER BY DOMPOINTS DESC, DOMDIFF DESC";
         db_xoops_clmnt($legende, DOMICILE, $accession, $barrage, $relegation, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite);
                }
xoops_clmnt_barre($legende, $type, $accession, $barrage, $relegation,  $champ, $requete, $lien, $class);
break;


case ATTAQUE;
        {
                $legende=CONSULT_CLMNT_MSG11.$debut.CONSULT_CLMNT_MSG5.$fin;
                $requete="SELECT * from xoops_clmnt ORDER BY BUTSPOUR DESC, DIFF DESC";
         db_xoops_clmnt($legende, ATTAQUE, $accession, $barrage, $relegation, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite);
				xoops_clmnt_barre($legende, $type, $accession, $barrage, $relegation,  $champ, $requete, $lien, $class);
				       }
break;


case DEFENSE;
        {
                $legende=CONSULT_CLMNT_MSG12.$debut.CONSULT_CLMNT_MSG5.$fin;
                $requete="SELECT * FROM xoops_clmnt ORDER BY BUTSCONTRE ASC, DIFF DESC";
         db_xoops_clmnt($legende, DEFENSE, $accession, $barrage, $relegation, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite);
				xoops_clmnt_barre($legende, $type, $accession, $barrage, $relegation,  $champ, $requete,  $lien, $class);
        }
        
break;


case GOALDIFF;
        {
                $legende=CONSULT_CLMNT_MSG13.$debut.CONSULT_CLMNT_MSG5.$fin;
                $requete="SELECT * FROM xoops_clmnt ORDER BY DIFF DESC, BUTSPOUR DESC, BUTSCONTRE ASC ";
         db_xoops_clmnt($legende, GOALDIFF, $accession, $barrage, $relegation, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite);
				xoops_clmnt_barre($legende, $type, $accession, $barrage, $relegation,  $champ, $requete, $lien, $class );
        }
break;


case EXTERIEUR;
        {
                $legende=CONSULT_CLMNT_MSG14.$debut.CONSULT_CLMNT_MSG5.$fin;
                $requete="SELECT NOM, EXTPOINTS, EXTJOUES, EXTG,  EXTN, EXTP, EXTBUTSPOUR, EXTBUTSCONTRE, EXTDIFF  from xoops_clmnt ORDER BY EXTPOINTS DESC, EXTDIFF DESC ";
         db_xoops_clmnt($legende, EXTERIEUR, $accession, $barrage, $relegation, $champ, $debut, $fin, $pts_victoire, $pts_nul, $pts_defaite);
         xoops_clmnt_barre($legende, $type, $accession, $barrage, $relegation,  $champ, $requete, $lien, $class);
        }
break;
@$GLOBALS['xoopsDB']->queryF("UNLOCK TABLE xoops_clmnt");
}
 require_once XOOPS_ROOT_PATH.'/footer.php';
?>
