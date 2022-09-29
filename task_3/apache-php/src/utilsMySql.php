<?php
    const
    host = 'db-task3',
    dbUser = 'user',
    password = 'password',
    db = 'appDB';

    function openConnectionToDB(): mysqli { return new mysqli(
        host, dbUser, password, db
    );
    }
?>
