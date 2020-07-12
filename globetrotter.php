<?
// Copryright (c) 2003-2004 Xenolth.biz. All righs reserved.
include "../../mainfile.php";
include_once XOOPS_ROOT_PATH.'/header.php';
require XOOPS_ROOT_PATH.'/modules/globetrotter/config.php';
list($BG_width, $BG_height) = getimagesize($BG_image);

function delnl2br($string) {
         $string = eregi_replace("\n?\r?", "", $string);
         return $string;
}

?>
<html>
<head>
<!--Feel free to edit this title-->
<title>Globe*Trotter</title>
<link rel="stylesheet" type="text/css" href="style.css">

<script language="JavaScript">
<!--
BG_width = <?=$BG_width;?>;
BG_height = <?=$BG_height;?>;

<?
if (isset($_POST["step"])) {   // Detect if the user has just submitted a post
    if (($_POST["FORM_field1"]=="") || ($_POST["FORM_field4"]=="") || (!isset($_POST["FORM_icon"]))) {
        $ifprocess=0;     //There was an error in the visitor's submission. So, set this variable to 0 to tell the script
                          // (at the bottom) not to add this post to the database.
        ?>

        FLAG_ifplace = 0;
        FINGER_ifmove = 0;
        FORM_ifdrop = 0;

        <?

        echo("alert(\"{$LANG_cant_add_post}:");
        if ($_POST["FORM_field1"]=="") {
            echo("\\n- {$LANG_name}.");
        }
        if ($_POST["FORM_field4"]=="") {
            echo ("\\n- {$LANG_message}. ");
        }
        if (!isset($_POST["FORM_icon"])) {
            echo ("\\n- {$LANG_icon}. ");
        }
        echo ("\");");
    } else {
        $ifprocess=1;
?>
setTimeout("STEP_2()",1000);
function STEP_2 () {
    document.location="<?=$HTTP_SERVER_VARS['PHP_SELF']; ?>";  //Refresh the page so that the visitor can see the post that he just added.
                                                                      //"step" is set to 2 so that the error checking is bypassed.
}
<?
    }
}
?>

ICON_to_move = "0";
fillingform = "0";
MESSAGE_showhide = "hide";
document.onmousemove=ICON_move;
document.onmouseup=ICON_drop;

function ICON_drag(icon, x, y) {
        if (fillingform!="1") {
                    ICON_to_move = icon;
                    ICON_x = x;
                    ICON_y = y;
                    document.dropForm.FORM_icon.value = icon; // Fill the hidden field with the name of the icon
        }
}

function ICON_drop(e) {
        if( !e ) { e = window.event; } if( !e || ( typeof( e.pageX ) != 'number' && typeof( e.clientX ) != 'number' ) ) { return [ 0, 0 ]; }
        if( typeof( e.pageX ) == 'number' ) { var posX = e.pageX; var posY = e.pageY; } else {
           var posX = e.clientX; var posY = e.clientY;
           if( !( ( window.navigator.userAgent.indexOf( 'Opera' ) + 1 ) || ( window.ScriptEngine && ScriptEngine().indexOf( 'InScript' ) + 1 ) || window.navigator.vendor == 'KDE' ) ) {
              if( document.documentElement && ( document.documentElement.scrollTop || document.documentElement.scrollLeft ) ) {
                 posX += document.documentElement.scrollLeft; posY += document.documentElement.scrollTop;
              } else if( document.body && ( document.body.scrollTop || document.body.scrollLeft ) ) {
                 posX += document.body.scrollLeft; posY += document.body.scrollTop;
              }
           }
        }

        if ((ICON_to_move!="0") && (fillingform!="1") && (posX<=BG_width) && (posY<=BG_height)) {

                    if(posX+322<=BG_width){
                            if (document.layers) {
                                   document.layers["DIV_FORM_tail_left"].pageX = posX+3;
                                   document.layers["DIV_FORM_tail_left"].pageY = posY-7;
                                   document.layers["DIV_form"].pageX = posX+22;
                            } else {
                                   document.getElementById("DIV_FORM_tail_left").style.left = posX+3;
                                   document.getElementById("DIV_FORM_tail_left").style.top = posY-7;
                                   document.getElementById("DIV_form").style.left = posX+22;
                            }
                    } else if(posX-322>=0) {
                            if (document.layers) {
                                   document.layers["DIV_FORM_tail_right"].pageX = posX-23;
                                   document.layers["DIV_FORM_tail_right"].pageY = posY-7;
                                   document.layers["DIV_form"].pageX = posX-322;
                            } else {
                                   document.getElementById("DIV_FORM_tail_right").style.left = posX-23;
                                   document.getElementById("DIV_FORM_tail_right").style.top = posY-7;
                                   document.getElementById("DIV_form").style.left = posX-322;
                            }
                    } else {
                            if (document.layers) {
                                   document.layers["DIV_FORM_tail_left"].pageX = posX+3;
                                   document.layers["DIV_FORM_tail_left"].pageY = posY-7;
                                   document.layers["DIV_form"].pageX = posX+22;
                            } else {
                                   document.getElementById("DIV_FORM_tail_left").style.left = posX+3;
                                   document.getElementById("DIV_FORM_tail_left").style.top = posY-7;
                                   document.getElementById("DIV_form").style.left = posX+22;
                            }
                    }

                    if((posY-20>=0) && (posY+210<=BG_height)) {
                            if (document.layers) {
                                   document.layers["DIV_form"].pageY = posY-20;
                            } else {
                                   document.getElementById("DIV_form").style.top = posY-20;
                            }
                    } else if(posY+210>BG_height) {
                            if (document.layers) {
                                   document.layers["DIV_form"].pageY = BG_height-210;
                            } else {
                                   document.getElementById("DIV_form").style.top = BG_height-210;
                            }
                    } else if(posY-20<0) {
                            if (document.layers) {
                                   document.layers["DIV_form"].pageY = 0;
                            } else {
                                   document.getElementById("DIV_form").style.top = 0;
                            }
                    } else {
                            if (document.layers) {
                                   document.layers["DIV_form"].pageY = posY-210;
                            } else {
                                   document.getElementById("DIV_form").style.top = posY-20;
                            }
                    }

                    document.dropForm.FORM_xcords.value = posX-3; // Fill the hidden fields with the coordinants of where the
                    document.dropForm.FORM_ycords.value = posY-12; // visitor clicked. When the visitor clicks the "submit"
                    fillingform = "1";

        } else if ((ICON_to_move!="0") && (fillingform!="1") && ((posX>BG_width) || (posY>BG_height))) {
                    alert("The world is round but this map isn't. You just fell off the edge... please put your icon somewhere INSIDE the map.");
                    FORM_hide();
        }
}

function ICON_move(e) {
    if ((ICON_to_move!="0") && (fillingform!="1")) {
          if( !e ) { e = window.event; } if( !e || ( typeof( e.pageX ) != 'number' && typeof( e.clientX ) != 'number' ) ) { return [ 0, 0 ]; }
          if( typeof( e.pageX ) == 'number' ) { var posX = e.pageX; var posY = e.pageY; } else {
             var posX = e.clientX; var posY = e.clientY;
             if( !( ( window.navigator.userAgent.indexOf( 'Opera' ) + 1 ) || ( window.ScriptEngine && ScriptEngine().indexOf( 'InScript' ) + 1 ) || window.navigator.vendor == 'KDE' ) ) {
                if( document.documentElement && ( document.documentElement.scrollTop || document.documentElement.scrollLeft ) ) {
                   posX += document.documentElement.scrollLeft; posY += document.documentElement.scrollTop;
                } else if( document.body && ( document.body.scrollTop || document.body.scrollLeft ) ) {
                   posX += document.body.scrollLeft; posY += document.body.scrollTop;
                }
             }
          }

          if (document.layers) {
                document.layers[ICON_to_move].pageX = posX-5;
                document.layers[ICON_to_move].pageY = posY-11;
          } else {
                document.getElementById(ICON_to_move).style.left = posX-5;
                document.getElementById(ICON_to_move).style.top = posY-11;
          }
    } //end if (ICON_to_move!="0")
}   //end ICON_move(e)

function FORM_hide() {
    document.getElementById("DIV_FORM_tail_left").style.top = -100;
    document.getElementById("DIV_FORM_tail_right").style.top = -100;
    document.getElementById("DIV_form").style.top = -350;
    document.getElementById(ICON_to_move).style.left = ICON_x;
    document.getElementById(ICON_to_move).style.top = ICON_y;

    ICON_to_move = "0";
    fillingform = "0";
} //end FORM_hide()

function MESSAGE_show (MESSAGE_id) {    // When the visitor mouses over an icon, this script will display the respective message.
    xcords = display[MESSAGE_id][1];
    ycords = display[MESSAGE_id][2];
    
    document.getElementById("field1").innerHTML = display[MESSAGE_id][4];
    if(display[MESSAGE_id][5]!="") {
           document.getElementById("field2").innerHTML = "(<a href=\"mailto:"+display[MESSAGE_id][5]+"\">"+display[MESSAGE_id][5]+"</a>)";
    } else {
           document.getElementById("field2").innerHTML = "";
    }
    if(display[MESSAGE_id][6]!="") {
           document.getElementById("field3").innerHTML = "<br /><a href=\"http://"+display[MESSAGE_id][6]+"\" target=\"_blank\">http://"+display[MESSAGE_id][6]+"</a>";
    } else {
           document.getElementById("field3").innerHTML = "";
    }
//    document.getElementById("field4").innerHTML = " ";
    document.message.field4.value = display[MESSAGE_id][7];
//    document.getElementById("field4").innerHTML = display[MESSAGE_id][7];


    if(xcords+200<=BG_width){
           document.getElementById("DIV_SB_tail_left").style.left = xcords+8;
           document.getElementById("DIV_SB_tail_left").style.top = ycords+4;
           document.getElementById("DIV_sb").style.left = xcords+27;
    } else if(xcords-200>=0) {
           document.getElementById("DIV_SB_tail_right").style.left = xcords-18;
           document.getElementById("DIV_SB_tail_right").style.top = ycords+4;
           document.getElementById("DIV_SB").style.left = xcords-217;
    } else {
           document.getElementById("DIV_FORM_tail_left").style.left = xcords+3;
           document.getElementById("DIV_FORM_tail_left").style.top = ycords+4;
           document.getElementById("DIV_form").style.left = xcords+27;
    }

    if((ycords-20>=0) && (ycords+100<=BG_height)) {
           document.getElementById("DIV_sb").style.top = ycords-20;
    } else if(ycords+100>BG_height) {
           document.getElementById("DIV_sb").style.top = BG_height-100;
    } else if(ycords-20<0) {
           document.getElementById("DIV_sb").style.top = 0;
    } else {
           document.getElementById("DIV_sb").style.top = ycords-20;
    }
} //end MESSAGE_show (MESSAGE_id, MESSAGE_ycords)

function MESSAGE_timeout_hide () {
    MESSAGE_showhide = "hide"; // This will allow the message to be hidden (Unless the user's mouse re-enters
                               // the message before the "setTimeout" function calls the "MESSAGE_hide" function.)

/***** Don't allow the form to drop or the flag to be placed when the user clicks inside of the message *****/
    FLAG_ifplace = 1;
    FORM_ifdrop = 1;

    setTimeout("MESSAGE_hide()",500);
}//end MESsAGE_timeout_hide(x)

function MESSAGE_hide() {
    if(MESSAGE_showhide=="hide") {
        if (document.layers) {
                document.layers["DIV_sb"].pageY = -1000;
                document.layers["DIV_SB_tail_left"].pageY = -100;
                document.layers["DIV_SB_tail_right"].pageY = -100;
        } else {
                document.getElementById("DIV_sb").style.top = "-1000px";
                document.getElementById("DIV_SB_tail_left").style.top = "-100px";
                document.getElementById("DIV_SB_tail_right").style.top = "-100px";
        }
    }
} //end MESSAGE_hide()

function MESSAGE_mouseover() {
    MESSAGE_showhide="show"; // This will prevent the message from being hidden while the user's mouse is inside of it.
} //end MESSAGE_mouseover()

function MESSAGE_mouseout(MESSAGE_id) {
    MESSAGE_timeout_hide(MESSAGE_id);
}
//-->
</script>
</head>

<body>
<!-------------------------- Create Hidden Objects --------------------------->
<div id="DIV_form" style="position:absolute;z-index:5;top:-1000;px;">
<form method="post" action="<?=$HTTP_SERVER_VARS['PHP_SELF'];?>" name="dropForm">
      <table border="0" cellspacing="0" cellpadding="0" width="300">
      <tr><td height="3" colspan="3"><img src="icons/FORM_top.gif"></td></tr>
      <tr>
      <td width="1" background="icons/B_bar.gif" border="0" cellpadding="0" cellspacing="0"><img src="icons/B_bar.gif" /></td>
      <td>
      <table border="0" bgcolor="#9999ff">
      <tr><td><b><?=$LANG_name;?>:<font color="ff0000">*</font></b></td><td><input type="text" size="30" name="FORM_field1" value="<? if(isset($_POST["FORM_field1"])) echo($_POST["FORM_field1"]); ?>" /></td></tr>
      <tr><td><b><?=$LANG_email;?>:</b></td><td><input type="text" size="30" name="FORM_field2" value="<? if(isset($_POST["FORM_field2"])) echo($_POST["FORM_field2"]); ?>" /></td></tr>
      <tr><td><b><?=$LANG_website;?>:</b></td><td><b>http://</b><input type="text" size="24" name="FORM_field3" value="<? if(isset($_POST["FORM_field3"])) echo($_POST["FORM_field3"]); ?>" /></td></tr>
      <tr><td colspan="2"><b><?=$LANG_enter_message;?>:<font color="ff0000">*</font></b><br />
      <textarea name="FORM_field4" rows="3" cols="30"><? if(isset($_POST["FORM_field4"])) echo($_POST["FORM_field4"]); ?></textarea></td></tr>
      <tr><td colspan="2">
         <table border="0" align="center" width="50%" border="0"><tr>
              <input type="hidden" name="step" value="1" />
              <td width="50%" align="left"><input type="submit" name="FORM_submit" value="<?=$LANG_submit;?>"></td>
              <td width="50%" align="right"><input type="reset" name="FORM_cancel" value="<?=$LANG_cancel;?>" onclick="FORM_hide()"></td>
         </tr></table>
<p><?=$LANG_asterisk_required;?></p>
      </td></tr></table>
</td>
<td width="1" background="icons/B_bar.gif"><img src="icons/B_bar.gif" /></td>
</tr>
<tr><td height="3" colspan="3"><img src="icons/FORM_bottom.gif" /></td></tr>
</table>
<input type="hidden" name="FORM_xcords" value="<? if(isset($_POST["FORM_xcords"])) echo($_POST["FORM_xcords"]); ?>" />
<input type="hidden" name="FORM_ycords" value="<? if(isset($_POST["FORM_ycords"])) echo($_POST["FORM_ycords"]); ?>" />
<input type="hidden" name="FORM_icon" value="<? if(isset($_POST["FORM_ycords"])) echo($_POST["FORM_ycords"]); else echo($ICONS_to_use[0]);?>" />
</form></div>

<div id="DIV_FORM_tail_left" style="position:absolute;z-index:6;top:-100px;">
<img src="icons/FORM_tail_left.gif" /></div>

<div id="DIV_FORM_tail_right" style="position:absolute;z-index:6;top:-100px;">
<img src="icons/FORM_tail_right.gif" /></div>

<div id="DIV_sb" style="position:absolute;z-index:6;top:-1000px;width:220;" onmouseover="MESSAGE_mouseover();" onmouseout="MESSAGE_timeout_hide();">
      <table border="0" cellspacing="0" cellpadding="0" width="200">
      <tr><td height="3" colspan="3"><img src="icons/SB_top.gif" width="200" height="3" /></td></tr>
      <tr>
      <td width="1" background="icons/B_bar.gif" width="1"></td>
      <td bgcolor="#ffffe1" width="198">
          <p><b><span id="field1"></span> <span id="field2"></span></b>
          <span id="field3"><br /></span></p>
          <p><form name="message"><textarea name="field4" rows="3" cols="19"></textarea></message></p>
      </td>
      <td width="1" background="icons/B_bar.gif" width="1"><img src="icons/B_bar.gif" /></td>
      </tr>
      <tr><td height="3" colspan="3"><img src="icons/SB_bottom.gif" width="200" height="4" /></td></tr>
      </table>
</div>

<div id="DIV_SB_tail_left" style="position:absolute;z-index:6;top:-100px;" onmouseover="MESSAGE_mouseover();" onmouseout="MESSAGE_timeout_hide();">
<img src="icons/SB_tail_left.gif" /></div>

<div id="DIV_SB_tail_right" style="position:absolute;z-index:6;top:-100px;" onmouseover="MESSAGE_mouseover();" onmouseout="MESSAGE_timeout_hide();">
<img src="icons/SB_tail_right.gif" /></div>
<!---------------------- Finish Creating Hidden Objects ---------------------->

<div id="DIV_map" style="position:absolute;z-index:0;left:0px;top:0px;width:712;height:440;"></div>
<table border="0" cellpadding="0" cellspacing="0" background="<?=$BG_image;?>" width="<?=$BG_width;?>" height="<?=$BG_height;?>" /><tr><td></td></td></table>
<table border="0" align="center"><tr><td align="center">
<?

$ICON_left = $BG_width/2;
$ICON_top = $BG_height+40;
foreach ($ICONS_to_use as $icon) {
        list($ICON_width, $ICON_height) = getimagesize($icon);
        echo("<div id=\"$icon\" style=\"position:absolute;z-index:2;left:$ICON_left;top:$ICON_top;width:$ICON_width;height:$ICON_height;\" onmousedown=\"ICON_drag('$icon', '$ICON_left', '$ICON_top')\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"$icon\" width=\"$ICON_width\" height=\"$ICON_height\"><tr><td></td></tr></table></div>\n");
        $ICON_left+=$ICON_width+10;
}
?>

<?
$MYSQL_link =	"";
$MYSQL_result =	"";
$MYSQL_row =	"";
$FIELDS_pre = array();
$FIELDS_colnames = array();
$FIELDS_ids = array();
$a = 1;
$b = 0;
$JSCIPT_display_arr = array();
$JSCIPT_display_entry = array();
$JSCIPT_display_field = "";

$FIELDS_pre[] = $MYSQL_table_prefix . "globetable";
$FIELDS_colnames[] = $MYSQL_table_prefix . "globetable.id";
$FIELDS_colnames[] = $MYSQL_table_prefix . "globetable.xcords";
$FIELDS_colnames[] = $MYSQL_table_prefix . "globetable.ycords";
$FIELDS_colnames[] = $MYSQL_table_prefix . "globetable.icon";
$FIELDS_ids[] = $MYSQL_table_prefix . "globetable.id";

$FIELDS_str = implode(", ", $FIELDS_pre);
$FIELDS_colnames_str = implode(", ", $FIELDS_colnames);
$FIELDS_ids_str = implode(" = ", $FIELDS_ids);

$MYSQL_link = mysql_connect(XOOPS_DB_HOST, XOOPS_DB_USER, XOOPS_DB_PASS)
	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>");
mysql_select_db(XOOPS_DB_NAME)
	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>");

$MYSQL_result[0] = mysql_query("SELECT * FROM {$MYSQL_table_prefix}globetable order by ycords")
	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>" . mysql_error());

foreach($FIELDS_name as $temp) {
        $MYSQL_result[$a] = mysql_query("SELECT {$MYSQL_table_prefix}globetable.id, {$MYSQL_table_prefix}globetable.ycords, {$MYSQL_table_prefix}{$temp}.user_input FROM {$MYSQL_table_prefix}globetable, {$MYSQL_table_prefix}{$temp} WHERE {$MYSQL_table_prefix}globetable.id = {$MYSQL_table_prefix}{$temp}.id order by {$MYSQL_table_prefix}globetable.ycords")
        	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>" . mysql_error());

        while ($FIELDS_row = mysql_fetch_array($MYSQL_result[$a], MYSQL_NUM)) {
                $display[$a][$b] = $FIELDS_row[2];
                $b++;
        }
        $a++;
        $b = 0;
}
$b = 0;


while ($row[0] = mysql_fetch_array($MYSQL_result[0], MYSQL_NUM)) {
        $id = $row[0][0];
        $DIV_xcords = $row[0][1];
        $DIV_ycords = $row[0][2];
	$DIV_icon = $row[0][3];
        list($ICON_width, $ICON_height) = getimagesize($DIV_icon);

        echo ("\n");
?>
	<div id="icon<?=$id;?>" style="position:absolute;z-index:2;top:<?=$DIV_ycords;?>px;left:<?=$DIV_xcords;?>px;width:<?=$ICON_width;?>;height:<?=$ICON_height;?>;" onmouseover="MESSAGE_show(<?=$id;?>);" onmouseout="MESSAGE_timeout_hide();">
        <table border="0" cellpadding="0" cellspacing="0" background="<?=$DIV_icon;?>" width="<?=$ICON_width;?>" height="<?=$ICON_height;?>"><tr><td></td></tr></table>
        </div>
<?
$JSCRIPT_display_arr[$b][0] = $id;
$JSCRIPT_display_arr[$b][1] = $DIV_xcords;
$JSCRIPT_display_arr[$b][2] = $DIV_ycords;
$JSCRIPT_display_arr[$b][3] = $DIV_icon;
$JSCRIPT_display_arr[$b][4] = $display[1][$b];
$JSCRIPT_display_arr[$b][5] = $display[2][$b];
$JSCRIPT_display_arr[$b][6] = $display[3][$b];
$JSCRIPT_display_arr[$b][7] = $display[4][$b];
$b++;
}

?>

<script language="javascript">
<!--
<?
$a=0;
$b=0;
if(isset($JSCRIPT_display_arr)) {
?>
display = new Array();
<?
        foreach($JSCRIPT_display_arr as $JSCIPT_display_entry) {
        ?>
        display[<?=$JSCRIPT_display_arr[$a][0];?>] = new Array();
        <?
                foreach($JSCIPT_display_entry as $JSCIPT_display_field) {
                        ?>
                        display[<?=$JSCRIPT_display_arr[$a][0];?>][<?=$b;?>] = <? if(($b!=1) && ($b!=2)) echo("\""); echo $JSCRIPT_display_arr[$a][$b]; if(($b!=1) && ($b!=2)) echo("\"");?>;
                        <?
                        $b++;
                }
                $b=0;
                $a++;
        }
}
mysql_close($MYSQL_link);
?>
//-->
</script>
<?

if ((isset($ifprocess)) && ($ifprocess==1)) {
	$MYSQL_link =	"";
        $MYSQL_result =	"";
        $MYSQL_row =	"";
        $EMAIL_message = "Someone has just signed your Globe*Trotter! Here's details of the new post:\n\n------------------------------\n";

        $VAR_xcords = $_POST["FORM_xcords"];
        $VAR_ycords = $_POST["FORM_ycords"];
        $VAR_icon = $_POST["FORM_icon"];

        $VAR_fields = array(1=>delnl2br($_POST["FORM_field1"]), delnl2br($_POST["FORM_field2"]), delnl2br($_POST["FORM_field3"]), delnl2br($_POST["FORM_field4"]));

        $i = 1;

        $MYSQL_link = mysql_connect($MYSQL_host, $MYSQL_username, $MYSQL_password)
        	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>" . mysql_error());

        mysql_select_db($MYSQL_database)
        	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>" . mysql_error());

        mysql_query("insert into {$MYSQL_table_prefix}globetable values (NULL, '$VAR_xcords', '$VAR_ycords', '$VAR_icon');")
        	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>" . mysql_error());

        $id = mysql_query("select last_insert_id()");
        $id = mysql_fetch_array($id, MYSQL_NUM);
        $id = $id[0];

        while ($i<=$FIELDS_num) {
                mysql_query("insert into {$MYSQL_table_prefix}{$FIELDS_name[$i]} values ($id, '$VAR_fields[$i]');")
                	or die ("<h1>PARDON OUR DUST!</h1><p>This site is experiencing technical difficulties. Please be patient if things do not appear correctly.</p>" . mysql_error());

                $EMAIL_message .= "\n{$FIELDS_name[$i]}: {$VAR_fields[$i]}";
                $i++;
        }

        mysql_close($MYSQL_link);

        if((isset($EMAIL_address)) && ($EMAIL_address!="")) {
                mail($EMAIL_address, "Someone has just signed your Globe*Trotter!", $EMAIL_message, "From: globetrotter@{$_SERVER['SERVER_NAME']}");
        }
}
?>
</body>
</html>
<?
//include XOOPS_ROOT_PATH.'/footer.php';
?>
