<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $jenis_kertas = $_POST['jenis_kertas'];
    $jumlah = $_POST['jumlah'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["dokumen"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["dokumen"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["dokumen"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx" && $fileType != "jpg" && $fileType != "jpeg" && $fileType != "png") {
        echo "Sorry, only PDF, DOC, DOCX, JPG, JPEG & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file)) {
            // File successfully uploaded
            $dokumen = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Email configuration
    $to = "your_email@example.com"; // Replace with your email address
    $subject = "Pesanan Baru dari " . $nama;
    $message = "Nama: " . $nama . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Alamat: " . $alamat . "\n";
    $message .= "Jenis Kertas: " . $jenis_kertas . "\n";
    $message .= "Jumlah Halaman: " . $jumlah . "\n";
    $message .= "Dokumen: " . $dokumen . "\n";

    // Send email
    $headers = "From: noreply@yourwebsite.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Pesanan berhasil dikirim. <a href='index.html'>Kembali ke Beranda</a>";
    } else {
        echo "Maaf, terjadi kesalahan saat mengirim pesanan Anda.";
    }
} else {
    echo "Invalid request method.";
}
?>
