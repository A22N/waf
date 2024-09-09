<?php
    try {
        $conn = new PDO(
            "mysql:host=" . getenv('MYSQL_HOSTNAME') . ";dbname=" . getenv('MYSQL_DATABASE'),
            getenv('MYSQL_USER'),
            getenv('MYSQL_PASSWORD')
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
