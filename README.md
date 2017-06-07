# php7-mysql
This PHP script emulates MySQL extension for PHP 7 using MySQLi extension

Just include this file on top of your old application and it will work with old mysql_*() functions.

If you already have a constant named MYSQL_LINK, you have to replace all "MYSQL_LINK" strings in this file with suitable one. (e.g. "MYSQL_LINK_2")

If you already use a function named mysql_link(), yo have to replace all "mysql_link(" strings in this file with suitable one. (e.g. "mysql_link_2(")

If you already have a global variable named dbl, you have to change the value of the MYSQL_LINK constant.

Note that the replaces must be case sensitive.

Not implemented functions:
* mysql_field_flags()
* mysql_list_processes()
* mysql_tablename()
