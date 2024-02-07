<?php

function format_uang($angka)
{
    return number_format($angka, 0, ',', '.');
}

function terbilang($angka)
{
    $angka = abs($angka);
    $baca = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
    $terbilang = '';

    if ($angka < 12) $terbilang = ' ' . $baca[$angka]; // 1 - 11
    elseif ($angka < 20) $terbilang = terbilang($angka - 10) . ' Belas'; // 12 - 19
    elseif ($angka < 100) $terbilang = terbilang($angka / 10) . ' Puluh' . terbilang($angka % 10); // 20 - 99
    elseif ($angka < 200) $terbilang = ' Seratus' . terbilang($angka - 100); // 100 - 199
    elseif ($angka < 1000) $terbilang = terbilang($angka / 100) . ' Ratus' . terbilang($angka % 100); // 200 - 999
    elseif ($angka < 2000) $terbilang = ' Seribu' . terbilang($angka - 1000); // 1.000 - 1.999
    elseif ($angka < 1000000) $terbilang = terbilang($angka / 1000) . ' Ribu' . terbilang($angka % 1000); // 2000 - 999.999
    elseif ($angka < 1000000000) $terbilang = terbilang($angka / 1000000) . ' Juta' . terbilang($angka % 1000000); // 1.000.000 - 999.999.999

    return $terbilang;
}

function tanggal_indonesia($tgl, $tampilHari = true)
{
    $nama_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $nama_hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');

    // mengambil substring dari format tanggal YYYY-MM-DD
    $tahun = substr($tgl, 0, 4); // substring dari parameter $tgl, index ke 0 diambil 4 karakter
    $bulan = $nama_bulan[(int) substr($tgl, 5, 2)]; // substring dari parameter $tgl, index ke 6 diambil 2 karakter
    $tanggal = substr($tgl, 8, 2); // substring dari parameter $tgl, index ke 8 diambil 2 karakter
    $text = '';

    if ($tampilHari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun)); // deklarasi urutan hari
        $hari = $nama_hari[$urutan_hari]; // menentukan nama hari berdasarkan urutan hari
        $text .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text .= "$tanggal $bulan $tahun";
    }

    return $text;
}
