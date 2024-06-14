<?php
require 'db_connection.php';

try {
    $stmt = $conn->prepare("SELECT firstName, lastName, email FROM users");
    $stmt->execute();

    // Sonuçları set edin
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll();

    echo "<table><tr><th>İsim</th><th>Soyisim</th><th>E-posta</th></tr>";
    foreach ($users as $user) {
        echo "<tr><td>".$user['firstName']."</td><td>".$user['lastName']."</td><td>".$user['email']."</td></tr>";
    }
    echo "</table>";
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}

$conn = null;
?>
