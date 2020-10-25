<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
$modversion['name']        = _MI_phpleague_NAME;
$modversion['version']     = 0.71;
$modversion['description'] = _MI_phpleague_DESC;
$modversion['credits']     = "";
$modversion['license']     = "";
$modversion['author']      = "Xoopsé par Winsion";
$modversion['image']       = "images/phpleague.png";
$modversion['dirname']     = "League";

$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables
$modversion['tables'][0]  = "buteurs";
$modversion['tables'][1]  = "championnats";
$modversion['tables'][2]  = "classe";
$modversion['tables'][3]  = "clmnt";
$modversion['tables'][4]  = "clmnt_graph";
$modversion['tables'][5]  = "clubs";
$modversion['tables'][6]  = "divisions";
$modversion['tables'][7]  = "donnee";
$modversion['tables'][8]  = "equipes";
$modversion['tables'][9]  = "joueurs";
$modversion['tables'][10] = "journees";
$modversion['tables'][11] = "logo";
$modversion['tables'][12] = "matchs";
$modversion['tables'][13] = "parametres";
$modversion['tables'][14] = "rens";
$modversion['tables'][15] = "saisons";
$modversion['tables'][16] = "tapis_vert";

// Partie administration
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu']  = "admin/menu.php";

// Menu
$modversion['hasMain'] = 0;

// Templates
// $modversion['templates'][1]['file'] = 'phpleague_index.html';
// $modversion['templates'][1]['description'] = 'Afficher le texte se trouvant dans la base';

// Blocks
$modversion['blocks'][1]['file']        = "champion.php";
$modversion['blocks'][1]['name']        = LEAGUE;
$modversion['blocks'][1]['description'] = "Gestion de championnat";
$modversion['blocks'][1]['show_func']   = "b_champion_show";
?>
