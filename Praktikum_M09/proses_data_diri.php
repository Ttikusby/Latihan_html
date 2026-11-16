
<?php

// 1. Memeriksa metode pengiriman data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. Mengambil data dari form HTML
    $nama = trim($_POST["nama"] ?? "");
    $tanggal_lahir = $_POST["tanggal_lahir"] ?? "";

    // 3. Mengambil pilihan hobi
    $hobi = $_POST["hobi"] ?? [];

    // 4. Mengubah format tanggal menjadi bahasa Indonesia

    $bulan = [
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember"
    ];

    $tanggal = DateTime::createFromFormat(
        '!Y-m-d',
        $tanggal_lahir
    );

    if (
        !$tanggal ||
        $tanggal->format('Y-m-d') !== $tanggal_lahir
    ) {
        die("Tanggal lahir tidak valid.");
    }

    $hari = (int) $tanggal->format("d");
    $nomor_bulan = (int) $tanggal->format("m");
    $tahun = $tanggal->format("Y");

    $tanggal_indonesia = $hari . " " .
                         $bulan[$nomor_bulan] . " " .
                         $tahun;

    // 5. Menggabungkan pilihan hobi

    $daftar_hobi = [
        "Membaca",
        "Olahraga",
        "Musik",
        "Lainnya"
    ];

    // Memastikan hobi yang diterima sesuai pilihan form
    $hobi = array_intersect($daftar_hobi, $hobi);

    if (count($hobi) > 0) {
        $hasil_hobi = implode(", ", $hobi);
    } else {
        $hasil_hobi = "Tidak ada hobi yang dipilih";
    }

} else {
    // Jika halaman dibuka tanpa mengirim form
    header("Location: form_data_diri.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Data Diri</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 100%;
            max-width: 450px;
            margin: 50px auto;
            padding: 25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 25px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }

        .data {
            display: flex;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .label {
            width: 120px;
            font-weight: bold;
        }

        .isi {
            flex: 1;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            color: #087bdb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

    <div class="container">

        <h2>Tampilan Data Anda</h2>

        <div class="data">
            <div class="label">Nama Lengkap:</div>

            <div class="isi">
                <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>
            </div>
        </div>

        <div class="data">
            <div class="label">Tanggal Lahir:</div>

            <div class="isi">
                <?= htmlspecialchars($tanggal_indonesia) ?>
            </div>
        </div>

        <div class="data">
            <div class="label">Hobi:</div>

            <div class="isi">
                <?= htmlspecialchars($hasil_hobi) ?>
            </div>
        </div>

        <a href="form_data_diri.html">
            &laquo; Kembali ke Form
        </a>

    </div>

</body>
</html>
