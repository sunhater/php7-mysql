<?php

/* This PHP script emulates MySQL extension for PHP 7 using MySQLi extension
 *
 * Just include this file on top of your old application and it will work
 * with old mysql_*() functions.
 *
 * If you already have a constant named MYSQL_LINK, you have to replace all
 * "MYSQL_LINK" strings in this file with suitable one. (e.g. "MYSQL_LINK_2")
 *
 * If you already use a function named mysql_link(), yo have to replace all
 * "mysql_link(" strings in this file with suitable one. (e.g. "mysql_link_2(")
 *
 * If you already have a global variable named dbl, you have to change the
 * value of the MYSQL_LINK constant.
 *
 * Note that the replaces must be case sensitive.
 *
 * Not implemented functions:
 *     mysql_field_flags()
 *     mysql_list_processes()
 *     mysql_tablename()
 *
 * Pavel Tzonkov (C)2017
 */

define('MYSQL_LINK', 'dbl');
$GLOBALS[MYSQL_LINK] = null;

function mysql_link($link=null) {
    return ($link === null) ? $GLOBALS[MYSQL_LINK] : $link;
}

function mysql_connect($host, $user, $pass) {
    $GLOBALS[MYSQL_LINK] = mysqli_connect($host, $user, $pass);
    return $GLOBALS[MYSQL_LINK];
}

function mysql_pconnect($host, $user, $pass) {
    return mysql_connect($host, $user, $pass);
}

function mysql_select_db($db, $link=null) {
    $link = mysql_link($link);
    return mysqli_select_db($link, $db);
}

function mysql_close($link=null) {
    $link = mysql_link($link);
    return mysqli_close($link);
}

function mysql_error($link=null) {
    $link = mysql_link($link);
    return mysqli_error($link);
}

function mysql_errno($link=null) {
    $link = mysql_link($link);
    return mysqli_errno($link);
}

function mysql_ping($link=null) {
    $link = mysql_link($link);
    return mysqli_ping($link);
}

function mysql_stat($link=null) {
    $link = mysql_link($link);
    return mysqli_stat($link);
}

function mysql_affected_rows($link=null) {
    $link = mysql_link($link);
    return mysqli_affected_rows($link);
}

function mysql_client_encoding($link=null) {
    $link = mysql_link($link);
    return mysqli_character_set_name($link);
}

function mysql_thread_id($link=null) {
    $link = mysql_link($link);
    return mysqli_thread_id($link);
}

function mysql_escape_string($string) {
    return mysql_real_escape_string($string);
}

function mysql_real_escape_string($string, $link=null) {
    $link = mysql_link($link);
    return mysqli_real_escape_string($link, $string);
}

function mysql_query($sql, $link=null) {
    $link = mysql_link($link);
    return mysqli_query($link, $sql);
}

function mysql_unbuffered_query($sql, $link=null) {
    $link = mysql_link($link);
    return mysqli_query($link, $sql, MYSQLI_USE_RESULT);
}

function mysql_set_charset($charset, $link=null){
    $link = mysql_link($link);
    return mysqli_set_charset($link, $charset);
}

function mysql_get_host_info($link=null) {
    $link = mysql_link($link);
    return mysqli_get_host_info($link);
}

function mysql_get_proto_info($link=null) {
    $link = mysql_link($link);
    return mysqli_get_proto_info($link);
}

function mysql_get_server_info($link=null) {
    $link = mysql_link($link);
    return mysqli_get_server_info($link);
}

function mysql_info($link=null) {
    $link = mysql_link($link);
    return mysqli_info($link);
}

function mysql_get_client_info() {
    $link = mysql_link();
    return mysqli_get_client_info($link);
}

function mysql_create_db($db, $link=null) {
    $link = mysql_link($link);
    $db = str_replace('`', '', mysqli_real_escape_string($link, $db));
    return mysqli_query($link, "CREATE DATABASE `$db`");
}

function mysql_drop_db($db, $link=null) {
    $link = mysql_link($link);
    $db = str_replace('`', '', mysqli_real_escape_string($link, $db));
    return mysqli_query($link, "DROP DATABASE `$db`");
}

function mysql_list_dbs($link=null) {
    $link = mysql_link($link);
    return mysqli_query($link, "SHOW DATABASES");
}

function mysql_list_fields($db, $table, $link=null) {
    $link = mysql_link($link);
    $db = str_replace('`', '', mysqli_real_escape_string($link, $db));
    $table = str_replace('`', '', mysqli_real_escape_string($link, $table));
    return mysqli_query($link, "SHOW COLUMNS FROM `$db`.`$table`");
}

function mysql_list_tables($db, $link=null) {
    $link = mysql_link($link);
    $db = str_replace('`', '', mysqli_real_escape_string($link, $db));
    return mysqli_query($link, "SHOW TABLES FROM `$db`");
}

function mysql_db_query($db, $sql, $link=null) {
    $link = mysql_link($link);
    mysqli_select_db($link, $db);
    return mysqli_query($link, $sql);
}



function mysql_fetch_row($qlink) {
    return mysqli_fetch_row($qlink);
}

function mysql_fetch_assoc($qlink) {
    return mysqli_fetch_assoc($qlink);
}

function mysql_fetch_array($qlink, $result=MYSQLI_BOTH) {
    return mysqli_fetch_array($qlink, $result);
}

function mysql_fetch_lengths($qlink) {
    return mysqli_fetch_lengths($qlink);
}

function mysql_insert_id($qlink) {
    return mysqli_insert_id($qlink);
}

function mysql_num_rows($qlink) {
    return mysqli_num_rows($qlink);
}

function mysql_num_fields($qlink) {
    return mysqli_num_fields($qlink);
}

function mysql_data_seek($qlink, $row) {
    return mysqli_data_seek($qlink, $row);
}

function mysql_field_seek($qlink, $offset) {
    return mysqli_field_seek($qlink, $offset);
}

function mysql_fetch_object($qlink, $class="stdClass", array $params=null) {
    return ($params === null)
        ? mysqli_fetch_object($qlink, $class)
        : mysqli_fetch_object($qlink, $class, $params);
}

function mysql_db_name($qlink, $row, $field='Database') {
    mysqli_data_seek($qlink, $row);
    $db = mysqli_fetch_assoc($qlink);
    return $db[$field];
}

function mysql_fetch_field($qlink, $offset=null) {
    if ($offset !== null)
        mysqli_field_seek($qlink, $offset);
    return mysqli_fetch_field($qlink);
}

function mysql_result($qlink, $offset, $field=0) {
    if ($offset !== null)
        mysqli_field_seek($qlink, $offset);
    $row = mysqli_fetch_array($qlink);
    return (!is_array($row) || !isset($row[$field]))
        ? false
        : $row[$field];
}

function mysql_field_len($qlink, $offset) {
    $field = mysqli_fetch_field_direct($qlink, $offset);
    return is_object($field) ? $field->length : false;
}

function mysql_field_name($qlink, $offset) {
    $field = mysqli_fetch_field_direct($qlink, $offset);
    if (!is_object($field))
        return false;
/**/return empty($field->orgname) ? $field->name : $field->orgname;
}

function mysql_field_table($qlink, $offset) {
    $field = mysqli_fetch_field_direct($qlink, $offset);
    if (!is_object($field))
        return false;
/**/return empty($field->orgtable) ? $field->table : $field->orgtable;
}

function mysql_field_type($qlink, $offset) {
    $field = mysqli_fetch_field_direct($qlink, $offset);
    return is_object($field) ? $field->type : false;
}

function mysql_free_result($qlink) {
    try {
        mysqli_free_result($qlink);
    } catch (Exception $e) {
        return false;
    }
    return true;
}
