<?php
    $server     = "localhost";
    $username   = "primagsm_maha";
    $password   = "Mahayasa005";
    $database   = "primagsm_ilkom_jadwal";
    
    mysql_connect($server, $username, $password) or die("Koneksi Gagal");
    mysql_select_db($database) or die("Tidak bisa memilih database");
?>