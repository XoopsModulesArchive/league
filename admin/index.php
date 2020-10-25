<?php

$xoopsOption['pagetype'] = 'user';
require __DIR__ . '/admin_header.php';
xoops_cp_header();
$xoopsOption['show_rblock'] = 1;
require '../config.php';
require 'fonctions.php';

echo "<table width='569' border='0' cellpadding='3' cellspacing='1' class='outer'>
  <tr> 
    <td class='even'> <div align='center'><a href='saisons.php'>" . SEASON . "</a></div></td>
    <td class='odd'> <div align='center'><a href='clubs.php'>" . CLUB . "</a></div></td>
    <td class='even'> <div align='center'><a href='divisions.php'>" . DIVISION . "</a></div></td>
    <td class='odd'> <div align='center'><a href='championnats.php'>" . LEAGUE . "</a></div></td>
  </tr>
  <tr> 
    <td class='even'><div align='center'><a href='equipes.php'>" . TEAM . "</a></div></td>
    <td class='odd'><div align='center'><a href='classe.php'>" . CLASSE . "</a></div></td>
    <td class='even'><div align='center'><a href='journees.php'>" . CALENDAR . "</a></div></td>
    <td class='odd'><div align='center'><a href='dates.php'>" . DATE . "</a></div></td>
  </tr>
  <tr> 
    <td class='even'><div align='center'><a href='matchs.php'>" . MATCH . "</a></div></td>
    <td class='odd'><div align='center'><a href='coherence.php'>" . COHERENCE . "</a></div></td>
    <td class='even'><div align='center'><a href='results.php'>" . RESULT . "</a></div></td>
    <td class='odd'><div align='center'><a href='malus_bonus.php'>" . TAP_VERT . "</a></div></td>
  </tr>
  <tr> 
    <td class='even'><div align='center'><a href='parametres.php'>" . PARAMETRE . "</a></div></td>
    
    <td class='odd'><div align='center'><a href='joueurs.php'>" . JOUEUR . "</a></div></td>
    <td class='even'><div align='center'><a href='buteurs.php'>" . BUTEUR . "</a></div></td>
	<td class='odd'><div align='center'><a href='rens.php'>" . CONSULT . "</a></div></td>
  </tr>
  <tr>
  <td class='even'><div align='center'><a href='gestequipes.php'>" . LOGO . "</a></div></td>
    <td class='odd'><div align='center'><a href='graph.php'>" . GRAFIC . "</a></div></td>
	 <td class='even'><div align='center'><a href=coherence.php>" . COHERENCE . "</a></div></td>
	<td class='odd'></td>
    
  </tr>
</table>";
xoops_cp_footer();
?>
