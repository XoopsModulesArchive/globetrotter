<?php
// Copryright (c) 2003-2004 Xenolth.biz. All righs reserved.

require "config.php";

function build_relational_db($prefix) {
        mysql_query("drop table if exists {$prefix}field1");
        mysql_query("drop table if exists {$prefix}field2");
        mysql_query("drop table if exists {$prefix}field3");
        mysql_query("drop table if exists {$prefix}field4");

        mysql_query("create table {$prefix}field1 (id mediumint not null, user_input varchar(255), primary key (id))")
              or die("<p>Could not create table <i>{$prefix}field1</i>.</p>" . mysql_error());
              print "<p>Successfully created table <i>{$prefix}field1</i>...</p>";

        mysql_query("create table {$prefix}field2 (id mediumint not null, user_input varchar(255), primary key (id))")
              or die("<p>Could not create table <i>{$prefix}field2</i>.</p>" . mysql_error());
              print "<p>Successfully created table <i>{$prefix}field2</i>...</p>";

        mysql_query("create table {$prefix}field3 (id mediumint not null, user_input varchar(255), primary key (id))")
              or die("<p>Could not create table <i>{$prefix}field3</i>.</p>" . mysql_error());
              print "<p>Successfully created table <i>{$prefix}field3</i>...</p>";

        mysql_query("create table {$prefix}field4 (id mediumint not null, user_input blob, primary key (id))")
              or die("<p>Could not create table <i>{$prefix}field4</i>.</p>" . mysql_error());
              print "<p>Successfully created table <i>{$prefix}field4</i>...</p>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Xenolth's Globe*Trotter Install Utility</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#ffffff">

<table border="0" cellspacing="0" cellpadding="0" width="100%"  height="100%">
  <tr>
	<td width="50%"></td>
	<td valign="top">
      <table width="780" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#F77100" height="37" align="center" valign="bottom"><h3><b><font color="#ffffff">Xenolth's Globe*Trotter Install Utility</font></b></p></td>
        </tr>
      </table>
<?php
if ((!isset($_POST["INSTALL_step"])) && (!isset($_GET["INSTALL_step"]))) {
      $directory = $HTTP_SERVER_VARS['PHP_SELF'];
      $directory = eregi_replace ("install.php", "", $directory);
      ?>
      <h3>This program will install Xenolth's Globe*Trotter on your server.</h3>

      <p><i>Note: For Globe*Trotter to work correctly, you must upload all of the files into the same directory (install.php, globetrotter.php, config.php, the image files, etc. must all be in the same directory)</i></p>

      <p><b>Please enter the following information:</b></p>

      <form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF']; ?>" method="post">
      <table border="0" align="center" cellpadding="2">
      <tr>
      	<td valign="top"><p><b>Install into directory:</b></p></td><td width="400"><input type="text" name="directory" value="<?php echo $directory; ?>"/>
        <p>This is the directory where you have uploaded all the files for Globe*Trotter</p></td>
        </tr><tr>
      	<td valign="top"><p><b>MySQL Host:</b></p></td><td width="400"><input type="text" name="MYSQL_host" value="localhost" />
      	<p>This is nearly always localhost. So if you're not sure, use localhost.</p></td>
      </tr><tr>
      	<td valign="top"><p><b>MySQL Username:</p></b></td><td width="400"><input type="text" name="MYSQL_username" />
      	<p>Fill in the username you need to connect to your MySQL database. If you are not sure what your username is, enter the username of your FTP account (Usually, those two are equal).</p></td>
      </tr><tr>
      	<td valign="top"><p><b>MySQL Password:</p></b></td><td width="400"><input type="password" name="MYSQL_password" />
      	<p>Fill in the password you need to connect to your MySQL database. If you are not sure what your password is, enter the username of your FTP account (Usually, those two are equal).</p></td>
      </tr><tr>
      	<td valign="top"><p><b>MySQL Database Name:</p></b></td><td width="400"><input type="text" name="MYSQL_database" />
      	<p>Fill in the name of the database you want Xenolth's Globe*Trotter to store its data in.</p></td>
      </tr><tr>
      	<td valign="top"><p><b>MySQL Table Prefix:</p></b></td><td width="400"><input type="text" name="MYSQL_table_prefix" value="globetrotter_" />
      	<p>Fill in the prefix of the tables that Globe*Trotter will store its data in. You may leave this blank. This value will be prepended to all table names to allow multiple Globe*Trotter installations inside of a single database. <b>Make sure that none of the tables inside of the database begin with this prefix (or make sure that these tables don't contain any important information) because they may be deleted!</p></td>
      </tr><tr>
      	<td colspan="2" align="center"><input type="submit" value="Submit" /><input type="reset" value="Start Over" /></td>
      </tr>
      </table>
      	<input type="hidden" name="INSTALL_step" value="1" />
      </form>
<?php
} elseif (isset($_POST["INSTALL_step"]) && ($_POST["INSTALL_step"]==1)) {
        $INSTALL_step =          $_POST["INSTALL_step"];
        $directory =             $_POST["directory"];
        $MYSQL_host =            $_POST["MYSQL_host"];
        $MYSQL_username =        $_POST["MYSQL_username"];
        $MYSQL_password =        $_POST["MYSQL_password"];
        $MYSQL_database =        $_POST["MYSQL_database"];
        $MYSQL_table_prefix =    $_POST["MYSQL_table_prefix"];

                $ERROR_log[1] =          "";
                $ERROR_log[2] =          "";
                $ERROR_log[3] =          "";
                $ERROR_log[4] =          "";
                $ERROR_log[5] =          "";
                $ERROR_log[6] =          "";
                $ERROR_count  =           0;

                function ERRORMSG_open($var) {
                	if($var==0) {
                		echo("<p><b>The Following Errors Occurred While Installing Globe*Trotter:</b></p>");
                		echo("<ul>");
                	}
                }

                if ($directory=="") {
                	ERRORMSG_open($ERROR_count);
                	echo("<li /><p>Please enter the <b>directory</b> where you have uploaded all the files for Globe*Trotter (including this install utility)</p>");
                	$ERROR_log[1] = "directory";
                	$ERROR_count++;

                }

                if ($MYSQL_host=="") {
                	ERRORMSG_open($ERROR_count);
                	echo("<li /><p>Please enter the <b>MySQL host</b> (If you're not sure, enter <i>localhost</i>)</p>");
                	$ERROR_log[2] = "MYSQL_host";
                	$ERROR_count++;

                }

                if ($MYSQL_database=="") {
                	ERRORMSG_open($ERROR_count);
                	echo("<li /><p>Please enter a <b>MySQL database</b> for Xenolth's Globe*Trotter to use</p>");
                	$ERROR_log[3] = "MYSQL_database";
                	$ERROR_count++;

                }

                if ($ERROR_count>0) {
                	echo("</ul>");
                }

                if ($ERROR_count!=0) {
                ?>
                        <p><b>Please correct the errors below:</b></p>

                        <form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF']; ?>" method="post">
                        <table border="0" align="center" cellpadding="2">
                        <tr>
      	                        <td valign="top"><p><b><?php if($ERROR_log[1]=="directory") echo("<font color=\"#ff0000\">"); ?>Install into directory:<?php if($ERROR_log[1]=="directory") echo("</font>"); ?></b></p></td><td width="400"><input type="text" name="directory" value="<?php echo $directory; ?>"/>
                                <p>This is the directory where you have uploaded all the files for Globe*Trotter</p></td>
                        </tr><tr>
                        	<td valign="top"><p><b><?php if($ERROR_log[2]=="MYSQL_host") echo("<font color=\"#ff0000\">"); ?>MYSQL Host:<?php if($ERROR_log[2]=="MYSQL_host") echo("</font>"); ?></b></p></td><td width="400"><input type="text" name="MYSQL_host" value="<?php echo("$MYSQL_host"); ?>" />
                        	<p>This is nearly always localhost. So if you're not sure, use localhost.</p></td>
                        </tr><tr>
                        	<td valign="top"><p><b>MySQL Username:</b></p></td><td width="400"><input type="text" name="MYSQL_username" value="<?php echo("$MYSQL_username"); ?>" />
                        	<p>Fill in the username you need to connect to your MySQL database. If you are not sure what your username is, enter the username of your FTP account (Usually, those two are equal).</p></td>
                        </tr><tr>
                        	<td valign="top"><p><b>MySQL Password:</b></p></td><td width="400"><input type="password" name="MYSQL_password" /><br />
                        	<p>Fill in the password you need to connect to your MySQL database. If you are not sure what your password is, enter the username of your FTP account (Usually, those two are equal).</p></td>
                        </tr><tr>
                        	<td valign="top"><p><b><?php if($ERROR_log[3]=="MYSQL_database") echo("<font color=\"#ff0000\">"); ?>MySQL Database name:<?php if($ERROR_log[3]=="MYSQL_database") echo("</font>"); ?></b></p></td><td width="400"><input type="text" name="MYSQL_database" value="<?php echo("$MYSQL_database"); ?>" />
                        	<p>Fill in the name of the database you want Xenolth's Globe*Trotter to store its data in.</p></td>
                        </tr><tr>
                        	<td valign="top"><p><b>MySQL Table Prefix:</p></b></td><td width="400"><input type="text" name="MYSQL_table_prefix" value="<?php echo $MYSQL_table_prefix; ?>" />
                        	<p>Fill in the prefix of the tables that Globe*Trotter will store its data in. You may leave this blank. This value will be prepended to all table names to allow multiple Globe*Trotter installations inside of a single database. <b>Make sure that none of the tables inside of the database begin with this prefix (or make sure that these tables don't contain any important information) because they may be deleted!</p></td>
                        </tr><tr>
                        	<td colspan="2" align="center"><input type="submit" value="Submit" /><input type="reset" value="Start Over" /></td>
                        </tr>
                        </table>
                        	<input type="hidden" name="INSTALL_step" value="1" />
                        </form>

                <?php
                } else {
                        $MYSQL_link = mysql_connect($MYSQL_host, $MYSQL_username, $MYSQL_password)
                        	or die ("<p><b>There was an error logging into the database</b></p> <p>Please click the \"back\" button, and make sure that the host, username, and password you entered were correct.</p>" . mysql_error());
                        	print "<p>Successfully connected to <i>$MYSQL_host</i>...</p>";
                        mysql_close($MYSQL_link);
                        //Verify that the MYSQL host, username and password are valid before writing anything to the config file.

                        chmod ("config.php", 0777); //Try to CHMOD the config file so thatr this script can write to it.

                        // Write the user's input to the config file.
                        $buffer = fopen ("config.php", "r");

                        $CONFIG_file = fread ($buffer , filesize ("config.php"));

                        /***** Make sure that the user has not added/deleted spaces into the config file *****/
                        $CONFIG_file = eregi_replace("\$directory *= *\"", "\$directory = \"", $CONFIG_file);
                        $CONFIG_file = eregi_replace("\$MYSQL_host *= *\"", "\$MYSQL_host = \"", $CONFIG_file);
                        $CONFIG_file = eregi_replace("\$MYSQL_username *= *\"", "\$MYSQL_username = \"", $CONFIG_file);
                        $CONFIG_file = eregi_replace("\$MYSQL_password *= *\"", "\$MYSQL_password = \"", $CONFIG_file);
                        $CONFIG_file = eregi_replace("\$MYSQL_username *= *\"", "\$MYSQL_database = \"", $CONFIG_file);
                        $CONFIG_file = eregi_replace("\$MYSQL_table_prefix *= *\"", "\$MYSQL_table_prefix = \"", $CONFIG_file);
                        $CONFIG_file = eregi_replace("\" *;", "\";", $CONFIG_file);

                        $VAR_beginpos = strpos($CONFIG_file, "\$directory = \"");
                        $VAR_endpos = strpos($CONFIG_file, "\";", $VAR_beginpos);
                        $VAR_chars = $VAR_endpos-$VAR_beginpos;
                        $CONFIG_file = substr_replace($CONFIG_file, "\$directory = \"$directory", $VAR_beginpos, $VAR_chars);


                        $VAR_beginpos = strpos($CONFIG_file, "\$MYSQL_host = \"");
                        $VAR_endpos = strpos($CONFIG_file, "\";", $VAR_beginpos);
                        $VAR_chars = $VAR_endpos-$VAR_beginpos;
                        $CONFIG_file = substr_replace($CONFIG_file, "\$MYSQL_host = \"$MYSQL_host", $VAR_beginpos, $VAR_chars);

                        $VAR_beginpos = strpos($CONFIG_file, "\$MYSQL_username = \"");
                        $VAR_endpos = strpos($CONFIG_file, "\";", $VAR_beginpos);
                        $VAR_chars = $VAR_endpos-$VAR_beginpos;
                        $CONFIG_file = substr_replace($CONFIG_file, "\$MYSQL_username = \"$MYSQL_username", $VAR_beginpos, $VAR_chars);

                        $VAR_beginpos = strpos($CONFIG_file, "\$MYSQL_password = \"");
                        $VAR_endpos = strpos($CONFIG_file, "\";", $VAR_beginpos);
                        $VAR_chars = $VAR_endpos-$VAR_beginpos;
                        $CONFIG_file = substr_replace($CONFIG_file, "\$MYSQL_password = \"$MYSQL_password", $VAR_beginpos, $VAR_chars);

                        $VAR_beginpos = strpos($CONFIG_file, "\$MYSQL_database = \"");
                        $VAR_endpos = strpos($CONFIG_file, "\";", $VAR_beginpos);
                        $VAR_chars = $VAR_endpos-$VAR_beginpos;
                        $CONFIG_file = substr_replace($CONFIG_file, "\$MYSQL_database = \"$MYSQL_database", $VAR_beginpos, $VAR_chars);

                        $VAR_beginpos = strpos($CONFIG_file, "\$MYSQL_table_prefix = \"");
                        $VAR_endpos = strpos($CONFIG_file, "\";", $VAR_beginpos);
                        $VAR_chars = $VAR_endpos-$VAR_beginpos;
                        $CONFIG_file = substr_replace($CONFIG_file, "\$MYSQL_table_prefix = \"$MYSQL_table_prefix", $VAR_beginpos, $VAR_chars);

                        $VAR_beginpos = strpos($CONFIG_file, "\$GLOBETROTTER_version = \"");
                        $VAR_endpos = strpos($CONFIG_file, "\";", $VAR_beginpos);
                        $VAR_chars = $VAR_endpos-$VAR_beginpos;
                        $CONFIG_file = substr_replace($CONFIG_file, "\$GLOBETROTTER_version = \"dev_012805", $VAR_beginpos, $VAR_chars);

                        fclose($buffer);

                        $buffer = fopen ("config.php", "w");
                        fwrite ($buffer, $CONFIG_file);
                        fclose($buffer);

			chmod ("config.php", 0755); //Now that this script no longer needs to write to the config file, CHMOD it to that no one can write to it anymore.
                        print "<p>Successfully saved your settings to config.php...</p>";
                        ?>

                        <h1>Please read the following Lisence Agreement.</h1>
                        <p>You must accept the terms of this agreement to use this software. By using this software, you agree to abide by the terms in this Lisence Agreement.</p>

                        <form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF']; ?>" method="post">
                        <center>
                        <textarea rows="10" cols="80">
                        <?php include "lisence.txt"; ?>
                        </textarea>
                        <input type="hidden" name="INSTALL_step" value="2" /><br />
                        <input type="submit" value="OK" />
                        </center>

                        <?php
                }   // if ($ERROR_count!=0)
} elseif (isset($_POST["INSTALL_step"]) && ($_POST["INSTALL_step"]==2)) {
                        include "config.php";
                        
                        $MYSQL_link = mysql_connect($MYSQL_host, $MYSQL_username, $MYSQL_password)
                        	or die ("<p><b>There was an error logging into the database</b></p> <p>Please click the \"back\" button, and make sure that the host, username, and password you entered were correct.</p>" . mysql_error());
                        	print "<p>Successfully connected to <i>$MYSQL_host</i>...</p>";

                        mysql_query("create database if not exists $MYSQL_database")
                            or die("<p>Could not connect to or create database <i>$MYSQL_database</i></b></p>" . mysql_error());
                            print "<p>Successfully created database <i>" . $MYSQL_database . "</i>...</p>";

                        mysql_select_db($MYSQL_database);

                        if (mysql_query("SELECT * FROM {$MYSQL_table_prefix}globetable")) {
                        ?>
                                <h3>Table <i><?php echo $MYSQL_table_prefix; ?>globetable</i> already exists. Unfortunately, you cannot upgrade from Beta 1.0 to 1.0 release due to a database change in preparation for 2.0 that will allow you to use custom fields.</h3>
                                <h4>All future releases will be upgradable. However, due to the small scale of deployment of Beta 1.0, we did not create an upgrade script from Beta 1.0 to 1.0.</h4>
                                
                                <p><a href="<?php echo $HTTP_SERVER_VARS['PHP_SELF']; ?>?INSTALL_step=2&overwrite=yes">Click here to continue with the installation of Globe*Trotter.</a> You will permanently loose all the posts stored in the database. (If you want to keep your posts, please manually re-insert them after this utility has completed the installation of Globe*Trotter)</p>
                        <?php
                        } else {
                                mysql_query("create table {$MYSQL_table_prefix}globetable (id mediumint not null auto_increment, xcords varchar(4), ycords varchar(4), icon varchar(20), primary key (id))")
                                      or die("<p>Could not create table <i>{$MYSQL_table_prefix}globetable</i>.</p>" . mysql_error());
                                      print "<p>Successfully created table <i>{$MYSQL_table_prefix}globetable</i>...</p>";

                                build_relational_db($MYSQL_table_prefix);
                        ?>
                                      <h2 align="center">Congratulations!</h2>
                                      <p>Xenolth's Globe*Trotter 1.0 has been successfully installed on your server. Please click the "continue" button below to setup Globe*Trotter on your website.</p>

                                      <center>
                                      <form action="setup.php" action="post">
                                      <input type="submit" value="Continue..." />
                                      </form>
                                      </center>
                        <?php
                        } //end else
                        mysql_close($MYSQL_link);
} elseif ((isset($_GET["INSTALL_step"])) && ($_GET["INSTALL_step"]==2)) {
                        include "config.php";
                        if ($_GET["overwrite"]=="yes") {
                                      $MYSQL_link = mysql_connect($MYSQL_host, $MYSQL_username, $MYSQL_password)
                                      	or die ("<p><b>There was an error logging into the database</b></p> <p>Please click the \"back\" button, and make sure that the host, username, and password you entered were correct.</p>" . mysql_error());
                                      	print "<p>Connected successfully to <i>" . $MYSQL_host . "</i>...</p>";

                                      mysql_select_db($MYSQL_database);

                                      mysql_query("drop table {$MYSQL_table_prefix}globetable");
                                      	print "<p>Table <i>{$MYSQL_table_prefix}globetable</i> has been deleted...</p>";

                                      mysql_query("create table {$MYSQL_table_prefix}globetable (id mediumint not null auto_increment, xcords varchar(4), ycords varchar(4), icon varchar(20), primary key (id))")
                                            or die("<p>Could not create table <i>{$MYSQL_table_prefix}globetable</i>.</p>" . mysql_error());
                                            print "<p>Successfully created table <i>{$MYSQL_table_prefix}globetable</i>...</p>";

                                      build_relational_db($MYSQL_table_prefix);

                                      mysql_close($MYSQL_link);
                        }
                        ?>
                        <h2 align="center">Congratulations!</h2>
                        <p>Xenolth's Globe*Trotter 1.0 has been successfully installed on your server. Please click the "continue" button below to setup Globe*Trotter on your website.</p>

                        <center>
                        <form action="setup.php" action="post">
                        <input type="submit" value="Continue..." />
                        </form>
                        </center>

                        <?php
}   //end elseif ((isset($_GET["INSTALL_step"])) && ($_GET["INSTALL_step"]==2))
?>
      <br>
      <table border="0" cellpadding="0" cellspacing="0" width="780">
      <tr>
	  <td valign="middle" height="47">
            <p align="center">Copyright &copy; 2003 Xenolth.biz</p>
          </td>
      </tr>
      <tr>
      <td colspan="2" height="15" bgcolor="#F77100"></td>
      </tr>
      </table>
<br>
<td width="50%"></td>
</tr>
</table>
</body>
</html>
