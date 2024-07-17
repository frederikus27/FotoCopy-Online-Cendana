<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'username', 'password', 'database');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Simpan data ke database
$sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil. <a href='masuk.html'>Masuk</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
