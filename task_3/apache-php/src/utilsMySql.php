<?php
    const
    host = 'mysql',
    dbUser = 'user',
    password = 'password',
    db = 'appDB';

    function openConnectionToDB(): mysqli { return new mysqli(
        host, dbUser, password, db
    );
    }
?>
