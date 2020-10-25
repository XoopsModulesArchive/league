<?php

function b_champion_show()
{
    global $DB, $xoopsConfig, $xoopsUser;

    $block = [];

    $block['title'] = '&nbsp; Championnat';

    $myts = new MyTextSanitizer();

    $block['content'] .= '<table border="0" cellpadding="3" cellspacing="5"><tr><td> ';

    $block['content'] .= '<a  href=' . XOOPS_URL . '/modules/League/consult/classement.php>' . L_CLASSEMENT . '</a><br> ';

    $block['content'] .= '</td> </tr> <tr> <td>';

    $block['content'] .= '<a  href=' . XOOPS_URL . '/modules/League/consult/matchs.php>' . L_CALENDRIER . '</a><br> ';

    $block['content'] .= '</td> </tr> <tr> <td>';

    $block['content'] .= '<a  href=' . XOOPS_URL . '/modules/League/consult/duel.php>' . L_DUEL . '</a><br> ';

    $block['content'] .= '</td> </tr> <tr> <td>';

    $block['content'] .= '<a  href=' . XOOPS_URL . '/modules/League/consult/buteur.php>' . L_BUTEUR . '</a><br> ';

    $block['content'] .= '</td> </tr> <tr> <td>';

    $block['content'] .= '<a  href=' . XOOPS_URL . '/modules/League/consult/club.php>' . L_CLUB . '</a><br> ';

    $block['content'] .= '</td>  </tr> </table> ';

    return $block;
}

?>


 
