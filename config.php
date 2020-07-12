<?
// Copryright (c) 2003-2004 Xenolth.biz. All righs reserved.

/******************** Xenolth's Globe*Trotter Config File ********************/
/** Please fill in the below variables for Globe*Trotter to work.
/** NOTE: It is strongly recommended that you use the install utility that came
/** inside of the zip file when you downloaded Globe*Trotter. (Make sure that you
/** know what you're doing before manually editing any of these variables!)
/** (If the zip file did not include the install.php file, download Globe*Trotter
/** directly from Xenolth at http://www.xenolth.biz.
***/

/***** Enter the URL for the image that would would like to show in the background of your Globe*Trotter. *****/
$BG_image = "map.gif";

/***** Enter your email address if you would like Globe*Trotter to email you when
/***** someone adds a post. If you do not want Globe*Trotter to email you,
/***** leave this variable blank.
******/
$EMAIL_address = "";

/***** Enter the URL for the language pack that you would like to use for your Globe*Trotter *****/
/***** (You can download files that will translate your Globe*Trotter into different languages! Check it out at http://www.xenolth.biz) *****/
require "english.lang";

/***** Enter the URLS for the icons you would like to use with your Globe*Trotter *****/
$ICONS_to_use = array("icons/1.gif", "icons/2.gif", "icons/3.gif", "icons/4.gif", "icons/5.gif", "icons/6.gif", "icons/7.gif", "icons/8.gif", "icons/9.gif");

$directory = "XOOPS_ROOT_PATH/modules/globetrotter/"; // This is the directory where you have uploaded all the files for Globe*Trotter.
$MYSQL_host = XOOPS_DB_HOST; // This is nearly always localhost. So if you're not sure, use localhost.
$MYSQL_username = XOOPS_DB_USER; // Fill in the username you need to connect to your MySQL database. If you are not sure what your username is, enter the username of your FTP account (Usually, those two are equal).
$MYSQL_password = XOOPS_DB_PASS; // Fill in the password you need to connect to your MySQL database. If you are not sure what your password is, enter the username of your FTP account (Usually, those two are equal).
$MYSQL_database = XOOPS_DB_NAME; // Fill in the name of the database you want Xenolth's Globe*Trotter to store its data in.
$MYSQL_table_prefix = "xoops_"; // Fill in the prefix of the tables that Globe*Trotter will store its data in. You may leave this blank. This value will be prepended to all table names to allow multiple Globe*Trotter installations inside of a single database.

$FIELDS_num = 4; // The number of fields your Globe*Trotter uses.
$FIELDS_name = array(1=>"field1", "field2", "field3", "field4"); // The names of the tables where the data from your globe*Trotter fields are stored
$FIELDS_display_name = array(1=>"name", "email", "website", "message"); // The display names that correlate to the table names.

$GLOBETROTTER_version = "dev_012805"; // This is the Globe*Trotter version that you have. Do not edit this variable -- it will be used by Globe*Trotter when you upgrade to a newer version.

$template  = "Light-Gray-slim"; // This is the template name to use simply enter the name of a template folder under templates/
                                // The templates and template code were donated by Spaceman-Spiff (http://www.monkey-pirate.com/blogs/spiff/)
                                // The default installed templates are:
                                //     Dark-Gray-slim
                                //     Light-Blue
                                //     Light-BlueGreen
                                //     Light-Cream
                                //     Light-Grey-slim
                                //     Light-Orange
                                //     Light-Purple
                                //     Light-Red
                                //     wood-transparent
                                //     wood-withbg
                                //     XP
?>

<style type="text/css">

<?
require("templates/$template/template.php");
?>

</style>
