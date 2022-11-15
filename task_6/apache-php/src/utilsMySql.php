<?php
    session_start();

    //$themeStyleSheet = 'utils/light.css';
    //if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    //    $themeStyleSheet = 'css/dark_theme.css';
    //}

    const
    host = 'mysql',
    dbUser = 'user',
    password = 'password',
    db = 'appDB';

    function openConnectionToDB(): mysqli {
        return new mysqli(
        host, dbUser, password, db
    );
    }
?>
