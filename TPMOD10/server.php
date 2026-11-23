<?php
// Mengatur jenis konten response dari server menjadi teks biasa.
header("Content-Type: text/plain; charset=UTF-8");

// Memastikan data nama dikirim menggunakan metode POST.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Metode request tidak diizinkan.";
    exit;
}

// Mengambil dan membersihkan input nama.
$nama = trim($_POST["nama"] ?? "");

// Memvalidasi agar input nama tidak kosong.
if ($nama === "") {
    http_response_code(400);
    echo "Input nama tidak boleh kosong!";
    exit;
}

// Mengamankan nama sebelum dimasukkan ke dalam response.
$namaAman = htmlspecialchars($nama, ENT_QUOTES, "UTF-8");

// Mengirim response teks sesuai instruksi tugas.
echo "Halo, " . $namaAman . "! Selamat datang di AJAX!";
?>
