<?php
$start = microtime(true);
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=simtik_polda', 'root', '');
    $pdo->query("SELECT * FROM cache");
    echo "Query done in " . (microtime(true) - $start) . " seconds\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
