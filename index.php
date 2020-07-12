<?php
//****************************************************
//Globe*Trotter Xoops Module v.1 by Bassman
//Website: http://www.xoopshq.com
// Based on:
//Globe*Trotter phpNuke Module v.1 by Sixf00t4
//Website: http://www.sixf00t4.com
//Project website: http://sourceforge.net/projects/globetrotter/
//Email: support@xenolth.biz
//
//
//
//
//****************************************************
include ('../../mainfile.php');
include ('../../header.php');
include XOOPS_ROOT_PATH.'/modules/globetrotter/config.php';
    OpenTable();
 echo "<center><iframe name=\"globetrotterembed\" src=\"globetrotter.php\" scrolling=\"yes\" width=\"100%\" height=\"600\" marginwidth=\"0\" marginheight=\"0\" frameborder=\"no\"></iframe>";
   echo "<b>To add your message, drag one of the icons to a location on the map";
    CloseTable();
include XOOPS_ROOT_PATH.'/footer.php';
?>
