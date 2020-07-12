# phpMyAdmin MySQL-Dump
# version 2.2.2
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# --------------------------------------------------------

#
# Table structure for table `field1`
#

CREATE TABLE field1 (
  id mediumint not null, user_input varchar(255), primary key (id));
# --------------------------------------------------------

#
# Table structure for table `field2`
#

CREATE TABLE field2 (
  id mediumint not null, user_input varchar(255), primary key (id));
# --------------------------------------------------------

#
# Table structure for table `field3`
#

CREATE TABLE field3 (
  id mediumint not null, user_input varchar(255), primary key (id));
# --------------------------------------------------------

# Table structure for table `field4`
#

CREATE TABLE field4 (id mediumint not null, user_input blob, primary key (id));
# --------------------------------------------------------

# Table structure for table `globetable`

CREATE TABLE globetable (
  id mediumint(9) NOT NULL auto_increment,
  xcords varchar(4) default NULL,
  ycords varchar(4) default NULL,
  icon varchar(20) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;
