<?php

    //database constants
    const DB_USER = 'root';
    const DB_NAME = 'research_project';
    const DB_HOST = 'localhost';
    const DB_PASSWORD = '';

    //dirs
    const ROOT_DIR = '/opt/lampp/htdocs/ehealth';
    const TEMPLATE_DIR = ROOT_DIR . '/templates';

    //useful constants for validation
    define("alphabet", "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ");
    define("nums", "0123456789");
    define("alphabet2", "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ,#-.");
    define("regexQualified", ["FirstName", "LastName", "OtherNames", "Address"]);
?>