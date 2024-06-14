<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Formdan gelen verileri al
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$birthDate = $_POST['birthDate'];
$gender = $_POST['gender'];

// Sunucu tarafında validasyonlar yap
$errors = [];

// İsim ve soyisim kontrolü
if (empty($firstName) || empty($lastName)) {
    $errors[] = "İsim ve soyisim alanları boş bırakılamaz.";
}

// E-posta format kontrolü
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Geçerli bir e-posta adresi giriniz.";
}

// Şifre uzunluğu kontrolü
if (strlen($password) < 6) {
    $errors[] = "Şifreniz en az 6 karakter uzunluğunda olmalıdır.";
}

// Doğum tarihi kontrolü
if (empty($birthDate)) {
    $errors[] = "Doğum tarihi alanı boş bırakılamaz.";
}

// Cinsiyet kontrolü
if (empty($gender)) {
    $errors[] = "Cinsiyet alanı boş bırakılamaz.";
}

// Hata var mı kontrol et
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
    exit; // Hataları göster ve işlemi durdur
}

// Veritabanı bağlantısı
require 'db_connection.php';

// E-posta benzersizliği kontrolü
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<p style='color: red;'>Bu e-posta adresi zaten kayıtlı.</p>";
        exit;
    }

    // Kullanıcı verilerini veritabanına ekle
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, birthDate, gender) 
                            VALUES (:firstName, :lastName, :email, :password, :birthDate, :gender)");
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Şifreyi hash'le
    $stmt->bindParam(':birthDate', $birthDate);
    $stmt->bindParam(':gender', $gender);

    $stmt->execute();
    echo "<p style='color: green;'>Yeni kayıt başarıyla oluşturuldu.</p>";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

$conn = null;
?>
