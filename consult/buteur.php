<?php

include 'avant.php';
if ('1' == !$marqueur) {
    require '../config.php';

    require '../consult/fonctions.php';
}

$marqueur = '1';

if ((!$gr_champ) and (!$champ)) {
    // pour quel championnat ?

    require_once XOOPS_ROOT_PATH . '/header.php';

    echo "<form action=\"$PHP_SELF\" method=\"GET\">";

    echo '<h3 align="center">' . ADMIN_TAPVERT_MSG2 . ' </h3>';

    echo '<select name="champ" align="center">';

    echo '<option value="" align="center"> </option>';

    $query = 'SELECT DISTINCT '
              . $xoopsDB->prefix('divisions')
              . '.nom, '
              . $xoopsDB->prefix('saisons')
              . '.annee, '
              . $xoopsDB->prefix('championnats')
              . '.id FROM '
              . $xoopsDB->prefix('championnats')
              . ', '
              . $xoopsDB->prefix('divisions')
              . ', '
              . $xoopsDB->prefix('saisons')
              . ', '
              . $xoopsDB->prefix('journees')
              . ' WHERE '
              . $xoopsDB->prefix('journees')
              . '.id_champ='
              . $xoopsDB->prefix('championnats')
              . '.id AND '
              . $xoopsDB->prefix('championnats')
              . '.id_division='
              . $xoopsDB->prefix('divisions')
              . '.id AND '
              . $xoopsDB->prefix('championnats')
              . '.id_saison='
              . $xoopsDB->prefix('saisons')
              . '.id ORDER BY '
              . $xoopsDB->prefix('saisons')
              . '.annee DESC, '
              . $xoopsDB->prefix('championnats')
              . '.id';

    $result = $GLOBALS['xoopsDB']->queryF($query);

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        echo("<option value=\"$row[2]\">$row[0]\n $row[1]/" . ($row[1] + 1) . "\n");

        echo("</option>\n>");
    }

    echo '</select>';

    echo '<input type="hidden" name="type" value=' . GENERAL . '>';

    echo '<input type="submit" value="classement" align="center"> </form>';

    require_once XOOPS_ROOT_PATH . '/footer.php';
}

if (($champ) or ($gr_champ) or ($equipe)) {
    if (!$gr_champ) {
        if (!(isset($type))) {
            $type = GENERAL;
        }

        if (!(isset($debut))) {
            $debut = '1';
        }

        if (!(isset($fin))) {
            $fin = nb_journees($champ);
        }

        // MENU TYPES DE xoops_classeMENT

        require_once XOOPS_ROOT_PATH . '/header.php';

        echo "<form action=\"$PHP_SELF\" method=\"GET\">";

        echo '<P Align=Center>' . CONSULT_BUTEUR_MSG2 . '<select name="type">';

        switch ($type) {
            case GENERAL;
                {
                    echo '<option value=' . GENERAL . ' selected>' . GENERAL . '</option>';
                    echo '<option value=' . DOMICILE . '> ' . DOMICILE . '</option>';
                    echo '<option value=' . EXTERIEUR . '> ' . EXTERIEUR . '</option>';
                }
                break;
            case DOMICILE;
                {
                    echo '<option value=' . GENERAL . '> ' . GENERAL . '</option>';
                    echo '<option value=' . DOMICILE . ' selected> ' . DOMICILE . '</option>';
                    echo '<option value=' . EXTERIEUR . '> ' . EXTERIEUR . '</option>';
                }
                break;
            case EXTERIEUR;
                {
                    echo '<option value=' . GENERAL . '> ' . GENERAL . '</option>';
                    echo '<option value=' . DOMICILE . '> ' . DOMICILE . '</option>';
                    echo '<option value=' . EXTERIEUR . ' selected> ' . EXTERIEUR . '</option>';
                }
                break;
        }

        echo '</select>';

        echo ' ' . CONSULT_CLMNT_MSG2 . ' <select name="debut">';

        $f = 1;

        // echo "<option value=\"1\" selected> 1</option>  ";

        while ($f <= nb_journees($champ)) {
            if ($f == $debut) {
                $select = ' selected';
            } else {
                $select = '';
            }

            echo "<option value=\"$f\"$select> $f</option>";

            $f++;
        }

        echo '</select>';

        echo ' ' . CONSULT_CLMNT_MSG3 . ' <select name="fin">';

        $f = 1;

        $x = nb_journees($champ);

        while ($f <= $x) {
            if ($f == $fin) {
                $select = ' selected';
            } else {
                $select = '';
            }

            echo "<option value=\"$f\"$select> $f</option>";

            // echo "<option value=\"$x\" selected> $x</option>  ";

            // else echo "<option value=\"$f\"> $f</option>";

            $f++;
        }

        echo "<input type=\"hidden\" name=\"champ\" value=\"$champ\"></p>";

        $query = 'SELECT '
                  . $xoopsDB->prefix('clubs')
                  . '.nom, '
                  . $xoopsDB->prefix('equipes')
                  . '.id FROM '
                  . $xoopsDB->prefix('equipes')
                  . ', '
                  . $xoopsDB->prefix('clubs')
                  . ' WHERE '
                  . $xoopsDB->prefix('equipes')
                  . ".id_champ='$champ' AND "
                  . $xoopsDB->prefix('clubs')
                  . '.id='
                  . $xoopsDB->prefix('equipes')
                  . '.id_club';

        $result = $xoopsDB->queryF($query);

        if (!$result) {
            die ($GLOBALS['xoopsDB']->error());
        }

        echo '<center>' . ADMIN_JOUEURS_3 . ' ';

        echo '<select name="equipe" ></center>';

        echo '<option value="0" align="center"> </option>';

        while (false !== ($row = $xoopsDB->fetchRow($result))) {
            $e = $row[1];

            if ($e == $equipe) {
                $select = 'selected';
            } else {
                $select = '';
            }

            echo("<option value=\"$row[1]\"$select>$row[0]\n");

            echo("</option>\n>");
        }

        echo '</select>';

        echo '<input type="submit" value=' . ENVOI . '> ';

        echo '</form>';

        //echo "</b>";
    }

    if (!$gr_champ) {
        $query = 'SELECT '
                 . $xoopsDB->prefix('divisions')
                 . '.nom, '
                 . $xoopsDB->prefix('saisons')
                 . '.annee, ('
                 . $xoopsDB->prefix('saisons')
                 . '.annee)+1 FROM '
                 . $xoopsDB->prefix('championnats')
                 . ', '
                 . $xoopsDB->prefix('divisions')
                 . ', '
                 . $xoopsDB->prefix('saisons')
                 . ' WHERE '
                 . $xoopsDB->prefix('championnats')
                 . ".id='$champ' AND "
                 . $xoopsDB->prefix('divisions')
                 . '.id='
                 . $xoopsDB->prefix('championnats')
                 . '.id_division AND '
                 . $xoopsDB->prefix('saisons')
                 . '.id='
                 . $xoopsDB->prefix('championnats')
                 . '.id_saison';

        $result = $xoopsDB->queryF($query);

        echo '<align="center">';

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            echo $row[0] . '  ' . $row[1] . '/' . $row[2] . '<br>';
        }
    } else {
        $query = 'SELECT '
                 . $xoopsDB->prefix('divisions')
                 . '.nom, '
                 . $xoopsDB->prefix('saisons')
                 . '.annee, ('
                 . $xoopsDB->prefix('saisons')
                 . '.annee)+1 FROM '
                 . $xoopsDB->prefix('championnats')
                 . ', '
                 . $xoopsDB->prefix('divisions')
                 . ', '
                 . $xoopsDB->prefix('saisons')
                 . ' WHERE '
                 . $xoopsDB->prefix('championnats')
                 . '.id IN (';

        $query2 = "SELECT id_champ, libelle FROM groupe_championnat WHERE id_groupe=$gr_champ";

        $result2 = $GLOBALS['xoopsDB']->queryF($query2);

        $x = 0;

        $tab_query = '';

        while (false !== ($row2 = $GLOBALS['xoopsDB']->fetchBoth($result2))) {
            $x++;

            if (1 != $x) {
                $tab_query = $tab_query . ',';
            }

            $tab_query = $tab_query . "'$row2[0]'";

            $nom_gr = $row2[1];
        }

        $query = $query . $tab_query . ') AND ' . $xoopsDB->prefix('divisions') . '.id=' . $xoopsDB->prefix('championnats') . '.id_division AND ' . $xoopsDB->prefix('saisons') . '.id=' . $xoopsDB->prefix('championnats') . '.id_saison';

        $result = $xoopsDB->queryF($query);

        echo '<align="center">' . CONSULT_BUTEUR_MSG3 . " $nom_gr<p align=\"center\">" . CONSULT_BUTEUR_MSG4 . '</p><align="center">';

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            echo $row[0] . '  ' . $row[1] . '/' . $row[2] . '<br>';
        }
    }

    if (!$gr_champ) {
        // SELECTION DES ".$xoopsDB->prefix("parametres")."

        $result = ($GLOBALS['xoopsDB']->queryF('select * from ' . $xoopsDB->prefix('parametres') . " where id_champ='$champ' "));

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            $id_equipe_fetiche = $row[id_equipe_fetiche];
        }

        $result = ($GLOBALS['xoopsDB']->queryF('select * from ' . $xoopsDB->prefix('equipes') . " where id='$id_equipe_fetiche' "));

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            $id_club_fetiche = $row[id_club];
        }

        $EquipeFetiche = $id_equipe_fetiche;
    } else {
        // SELECTION DES ".$xoopsDB->prefix("parametres")."

        $result = ($GLOBALS['xoopsDB']->queryF('select * from ' . $xoopsDB->prefix('parametres') . " where id_champ IN ($tab_query)"));

        $x = 0;

        $tab_id_equipe_fetiche = '';

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            $x++;

            if (1 != $x) {
                $tab_id_equipe_fetiche = $tab_id_equipe_fetiche . ',';
            }

            $tab_id_equipe_fetiche = $tab_id_equipe_fetiche . "'$row[id_equipe_fetiche]'";
        }

        $result = ($GLOBALS['xoopsDB']->queryF('select * from ' . $xoopsDB->prefix('equipes') . " where id IN ($tab_id_equipe_fetiche)"));

        $x = 0;

        $id_club_fetiche = '';

        while (false !== ($row = $GLOBALS['xoopsDB']->fetchBoth($result))) {
            $x++;

            if (1 != $x) {
                $id_club_fetiche = $id_club_fetiche . ',';
            }

            $id_club_fetiche = $id_club_fetiche . "'$row[id_club]'";
        }

        // $EquipeFetiche=$tab_id_club_fetiche;
    }

    if ($gr_champ) {
        if (!(isset($type))) {
            $type = GENERAL;
        }

        if (!(isset($debut))) {
            $debut = '1';
        }

        if (!(isset($fin))) {
            $array = explode(',', $tab_query);

            // echo "<TD>" . sizeof($array) ;

            $fin = 1;

            for ($i = '0'; $i < count($array); $i++) {
                $nb = nb_journees(ereg_replace("'", '', $array[$i]));

                if ($nb > $fin) {
                    $fin = $nb;
                }
            }
        }
    }

    // AFFICHAGE DE TOUS LE CHAMPIONNAT SI L UTILISATEUR Na PAS BORNE

    switch ($type) {
        case GENERAL;    // xoops_classeMENT GENERAL
            {
                //	if (!$gr_champ){
                $legende = 'Classement ' . GENERAL . ' des buteurs, ' . ' journées ' . $debut . ' à ' . $fin;
                $requete = '
			SELECT 	' . $xoopsDB->prefix('buteurs') . '.id_joueur As NumButeur,
				Sum(' . $xoopsDB->prefix('buteurs') . '.buts) AS Total, 
				' . $xoopsDB->prefix('joueurs') . '.nom AS NomJoueur, 
				' . $xoopsDB->prefix('joueurs') . '.prenom as PrenomJoueur, 
				' . $xoopsDB->prefix('joueurs') . '.photo as URLPhoto, 
				' . $xoopsDB->prefix('joueurs') . '.date_naissance AS date_naissance, 
				' . $xoopsDB->prefix('joueurs') . '.position_terrain as Place, 
				' . $xoopsDB->prefix('clubs') . '.nom,
				' . $xoopsDB->prefix('journees') . '.id_champ AS NumChamp, 
				' . $xoopsDB->prefix('matchs') . '.id_equipe_dom as eqDom,
				' . $xoopsDB->prefix('matchs') . '.id_equipe_ext as eqExt,
				' . $xoopsDB->prefix('clubs') . '.id as idClub,
				count(' . $xoopsDB->prefix('buteurs') . '.id) as NbEnForme


			FROM 	' . $xoopsDB->prefix('joueurs') . ', ' . $xoopsDB->prefix('buteurs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('clubs') . '


			WHERE	' . $xoopsDB->prefix('joueurs') . '.id = ' . $xoopsDB->prefix('buteurs') . '.id_joueur
				AND ' . $xoopsDB->prefix('clubs') . '.id = ' . $xoopsDB->prefix('joueurs') . '.id_club
				AND ' . $xoopsDB->prefix('buteurs') . '.id_match = ' . $xoopsDB->prefix('matchs') . '.id 
				AND ' . $xoopsDB->prefix('journees') . '.id = ' . $xoopsDB->prefix('matchs') . '.id_journee
				AND ' . $xoopsDB->prefix('equipes') . '.id_club=' . $xoopsDB->prefix('joueurs') . '.id_club
				AND ' . $xoopsDB->prefix('journees') . ".numero>=$debut 
				AND " . $xoopsDB->prefix('journees') . ".numero<=$fin";

                if (!$gr_champ) {
                    $requete = $requete . ' AND ' . $xoopsDB->prefix('journees') . ".id_champ=$champ ";
                } else {
                    $requete = $requete . ' AND ' . $xoopsDB->prefix('journees') . ".id_champ IN ($tab_query) ";
                }
                if ($equipe) {
                    $requete = $requete . 'AND ' . $xoopsDB->prefix('equipes') . ".id='$equipe'";
                }
                $requete = $requete . '
				AND (' . $xoopsDB->prefix('matchs') . '.id_equipe_dom = ' . $xoopsDB->prefix('equipes') . '.id
				OR ' . $xoopsDB->prefix('matchs') . '.id_equipe_ext = ' . $xoopsDB->prefix('equipes') . '.id)
	
			GROUP BY 
				' . $xoopsDB->prefix('buteurs') . '.id_joueur, 
				' . $xoopsDB->prefix('joueurs') . '.nom, 
				' . $xoopsDB->prefix('joueurs') . '.prenom, 
				' . $xoopsDB->prefix('joueurs') . '.photo, 
				' . $xoopsDB->prefix('joueurs') . '.date_naissance, 
				' . $xoopsDB->prefix('joueurs') . '.position_terrain, 
				' . $xoopsDB->prefix('clubs') . '.nom


			ORDER BY Total DESC , NbEnForme DESC, NomJoueur ASC';
                Buteur($legende, $requete, $type, $id_club_fetiche);
            }
            break;
        case 'Domicile';
            {
                $legende = 'Classement buteurs à domicile, journées ' . $debut . ' à ' . $fin;

                $requete = '
		SELECT 	' . $xoopsDB->prefix('buteurs') . '.id_joueur As NumButeur,
			Sum(' . $xoopsDB->prefix('buteurs') . '.buts) AS Total, 
			' . $xoopsDB->prefix('joueurs') . '.nom AS NomJoueur, 
			' . $xoopsDB->prefix('joueurs') . '.prenom as PrenomJoueur, 
			' . $xoopsDB->prefix('joueurs') . '.photo as URLPhoto,
			' . $xoopsDB->prefix('joueurs') . '.date_naissance AS date_naissance, 
			' . $xoopsDB->prefix('joueurs') . '.position_terrain as Place, 
			' . $xoopsDB->prefix('clubs') . '.nom,
			' . $xoopsDB->prefix('matchs') . '.id_equipe_dom, 
			' . $xoopsDB->prefix('journees') . '.id_champ AS NumChamp, 
			' . $xoopsDB->prefix('matchs') . '.id_equipe_dom as eqDom,
			' . $xoopsDB->prefix('clubs') . '.id as idClub,
			count(' . $xoopsDB->prefix('buteurs') . '.id) as NbEnForme


		FROM 	' . $xoopsDB->prefix('joueurs') . ', ' . $xoopsDB->prefix('buteurs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('clubs') . '


		WHERE	' . $xoopsDB->prefix('joueurs') . '.id = ' . $xoopsDB->prefix('buteurs') . '.id_joueur
	
			AND ' . $xoopsDB->prefix('matchs') . '.id_equipe_dom = ' . $xoopsDB->prefix('equipes') . '.id
			AND ' . $xoopsDB->prefix('clubs') . '.id = ' . $xoopsDB->prefix('joueurs') . '.id_club
			AND ' . $xoopsDB->prefix('matchs') . '.id = ' . $xoopsDB->prefix('buteurs') . '.id_match
			AND ' . $xoopsDB->prefix('journees') . '.id = ' . $xoopsDB->prefix('matchs') . '.id_journee
			AND ' . $xoopsDB->prefix('equipes') . '.id_club=' . $xoopsDB->prefix('joueurs') . '.id_club
			AND ' . $xoopsDB->prefix('journees') . ".numero>=$debut
			AND " . $xoopsDB->prefix('journees') . ".numero<=$fin
			AND " . $xoopsDB->prefix('journees') . ".id_champ=$champ";

                if (!$gr_champ) {
                    $requete = $requete . ' AND ' . $xoopsDB->prefix('journees') . ".id_champ=$champ ";
                } else {
                    $requete = $requete . ' AND ' . $xoopsDB->prefix('journees') . ".id_champ IN ($tab_query) ";
                }

                if ($equipe) {
                    $requete = $requete . 'AND ' . $xoopsDB->prefix('equipes') . ".id='$equipe'";
                }
                $requete = $requete . '

			
	
		GROUP BY 
			' . $xoopsDB->prefix('buteurs') . '.id_joueur, 
			' . $xoopsDB->prefix('joueurs') . '.nom, 
			' . $xoopsDB->prefix('joueurs') . '.prenom, 
			' . $xoopsDB->prefix('joueurs') . '.photo, 
			' . $xoopsDB->prefix('joueurs') . '.date_naissance,
			' . $xoopsDB->prefix('joueurs') . '.position_terrain, 
			' . $xoopsDB->prefix('clubs') . '.nom


		ORDER BY Total DESC , NbEnForme DESC, NomJoueur ASC';

                Buteur($legende, $requete, $type, $id_club_fetiche);
            }
            break;
        case 'Extérieur';
            {
                $legende = "Classement buteurs à l'extérieur, journées " . $debut . ' à ' . $fin;
                $requete = '
		SELECT 	' . $xoopsDB->prefix('buteurs') . '.id_joueur As NumButeur,
			Sum(' . $xoopsDB->prefix('buteurs') . '.buts) AS Total, 
			' . $xoopsDB->prefix('joueurs') . '.nom AS NomJoueur, 
			' . $xoopsDB->prefix('joueurs') . '.prenom as PrenomJoueur, 
			' . $xoopsDB->prefix('joueurs') . '.photo as URLPhoto, 
			' . $xoopsDB->prefix('joueurs') . '.date_naissance AS date_naissance, 
			' . $xoopsDB->prefix('joueurs') . '.position_terrain as Place, 
			' . $xoopsDB->prefix('clubs') . '.nom,
			' . $xoopsDB->prefix('matchs') . '.id_equipe_ext, 
			' . $xoopsDB->prefix('journees') . '.id_champ AS NumChamp, 
			' . $xoopsDB->prefix('matchs') . '.id_equipe_ext as eqExt,
			' . $xoopsDB->prefix('clubs') . '.id as idClub,
			count(' . $xoopsDB->prefix('buteurs') . '.id) as NbEnForme



		FROM 	' . $xoopsDB->prefix('joueurs') . ', ' . $xoopsDB->prefix('buteurs') . ', ' . $xoopsDB->prefix('matchs') . ', ' . $xoopsDB->prefix('journees') . ', ' . $xoopsDB->prefix('equipes') . ', ' . $xoopsDB->prefix('clubs') . '


		WHERE
			' . $xoopsDB->prefix('joueurs') . '.id = ' . $xoopsDB->prefix('buteurs') . '.id_joueur
			AND ' . $xoopsDB->prefix('matchs') . '.id_equipe_ext = ' . $xoopsDB->prefix('equipes') . '.id
			AND ' . $xoopsDB->prefix('clubs') . '.id = ' . $xoopsDB->prefix('joueurs') . '.id_club
			AND ' . $xoopsDB->prefix('matchs') . '.id = ' . $xoopsDB->prefix('buteurs') . '.id_match
			AND ' . $xoopsDB->prefix('journees') . '.id = ' . $xoopsDB->prefix('matchs') . '.id_journee
			AND ' . $xoopsDB->prefix('equipes') . '.id_club=' . $xoopsDB->prefix('joueurs') . '.id_club
			AND ' . $xoopsDB->prefix('journees') . ".numero>=$debut
			AND " . $xoopsDB->prefix('journees') . ".numero<=$fin";
                if (!$gr_champ) {
                    $requete = $requete . ' AND ' . $xoopsDB->prefix('journees') . ".id_champ=$champ ";
                } else {
                    $requete = $requete . ' AND ' . $xoopsDB->prefix('journees') . ".id_champ IN ($tab_query) ";
                }

                if ($equipe) {
                    $requete = $requete . 'AND ' . $xoopsDB->prefix('equipes') . ".id='$equipe'";
                }
                $requete = $requete . '


			AND ' . $xoopsDB->prefix('journees') . ".id_champ=$champ


		GROUP BY 
			" . $xoopsDB->prefix('buteurs') . '.id_joueur, 
			' . $xoopsDB->prefix('joueurs') . '.nom, 
			' . $xoopsDB->prefix('joueurs') . '.prenom, 
			' . $xoopsDB->prefix('joueurs') . '.photo, 
			' . $xoopsDB->prefix('joueurs') . '.date_naissance, 
			' . $xoopsDB->prefix('joueurs') . '.position_terrain, 
			' . $xoopsDB->prefix('clubs') . '.nom


		ORDER BY Total DESC , NbEnForme DESC, NomJoueur ASC';

                Buteur($legende, $requete, $type, $id_club_fetiche);
            }
            break;
    }
}

require_once XOOPS_ROOT_PATH . '/footer.php';
?>

