<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'username', 'password', 'database');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Cek email dan password
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['nama'];
        header("Location: pesan.html");
    } else {
        echo "Password salah. <a href='masuk.html'>Coba lagi</a>";
    }
} else {
    echo "Email tidak ditemukan. <a href='masuk.html'>Coba lagi</a>";
}

$conn->close();
?>
