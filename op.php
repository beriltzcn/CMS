<?php

include 'func.php';

$c = getDB();

$op = $_POST["op"];

if ($op == "change_pw")
{
    checkSession();
    $id = $_SESSION['id'];
    $pw = $_POST['npw'];
    qWNR("update kullanicilar set pw = :pw where id = $id", ['pw' => $pw], $c );
    echo "ok";
}

if ($op == "del_assignment")
{
    $id = $_POST['id'];
    qWNR("delete from dersler where id = $id", null, $c);
}

if ($op == "ders_ekle")
{
    $kisiId = $_POST['kisi_id'];
    $kisiAd = $_POST['kisi_ad'];
    $dersAdi = $_POST['ders_adi'];
    $period = $_POST['period'];
    $day = $_POST['day'];
    $sinif = $_POST['sinif'];
    
   

    $q = "insert into dersler values (0, $day, $period, $sinif, '$dersAdi', '$kisiAd', $kisiId)";
    qWNR($q, null, $c);
    
}

if ($op == "login")
{
    $un = $_POST["un"];
    $pw = $_POST["pw"];

    $q = "select count(*) as 'cnt', id, ad, un from kullanicilar where un = :un and pw = :pw";
    $r = qW1R($q, ['un' => $un, 'pw' => $pw], $c);

    $cnt = $r['cnt'];

    if ($cnt == 1)
    {
        //Giriş Bilgileri Doğru
        session_start();
        $_SESSION['id'] = $r['id'];
        $_SESSION['ad'] = $r['ad'];
        header("Location: index.php");
    }
    else
    {
        header("Location: login.php?err=1");
    }
}