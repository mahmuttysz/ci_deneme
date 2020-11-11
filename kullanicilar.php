<?php
ob_start();
session_start();
?>
<html>
<head>
<title>KULLANICILAR</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
</head>
<body>
<table width="1000" border="0" align="center">
	  <tr bgcolor="#00CC33">
	    <td colspan="2"><img src="images/banner.jpg" width="1000" height="80"></td>
      </tr>
	  <tr bgcolor="#00CC66">
	    <td align="center"><b><u><i>İŞLEMLER</i></u><b></td>
	    <td align="right"><?php


include("baglan.php");
if($_SESSION['isim'] == "") header("location:giris");
else
{
	if($_SESSION["kullanici_adi"]!="mahmut_tuysuz") header("location:giris?cikis=cik");
	
	echo " Hoşgeldiniz "."<b>".$_SESSION['isim']."</b>&nbsp;&nbsp;";
	echo '<a href="bilgi_guncelle"><img src="images/guncelle.png" width="30" height="25" title="Bilgilerimi Güncelle">
	</a>
		<a href="giris?cikis=cik"><img src="images/cikis.png" width="30" height="25" title="Çıkış Yap"></a>
	
	';
	}?></td>
      </tr>
	  <tr bgcolor="#00CC66">
	   <td valign="top" width="200"><br>
       <div align="center"><a href="index"">ANASAYFA</a></div><br>
      <div align="center"><a href="musteri_cihazi_ekle">MÜŞTERİ CİHAZI EKLE</a></div><br>
      <div align="center"><a href="musteri_cihazi_listele?listele=1&s=1">MÜŞTERİ CİHAZI LİSTESİ</a></div><br>
      <div align="center"><a href="stok_ekle">STOĞA ÜRÜN EKLE</a></div><br>
		<div align="center"><a href="stok_listesi">STOK LİSTESİ</a></div><br>
        </td>
	    <td align="center">
	<p align="center"><b><i><u>KULLANICI LİSTESİ</u></i></b></p>

         <?php


if(@$_GET["admin_ayar"]=="degistir")
{
	$bak = $baglan->query("select * from giris where id='$_GET[id]'")->fetch();
	$admin_mi=$bak['admin_mi'];
	if($admin_mi == "Hayır") $admin="Evet";
	else $admin="Hayır";
$baglan->exec("update giris set admin_mi='$admin' where id='$_GET[id]'");
header("location:kullanicilar");
}


else
{
$suz=$baglan->query("select * from giris where not kullanici_adi='mahmut_tuysuz'",PDO::FETCH_ASSOC);

echo '<table border="1"><tr><th>AD</th><th>SOYAD</th><th>KULLANICI ADI</th><th>ŞİFRE</th><th>ADMİN Mİ</th><th>DÜZENLE</th><th>SİL</th></tr>';
if($suz->rowCount())
{

	foreach($suz as $al)
	{
	echo '<tr><td>'.$al['ad'].'</td>';
	echo '<td>'.$al['soyad'].'</td>';
	echo '<td>'.$al['kullanici_adi'].'</td>';
	echo '<td>'.$al['sifre'].'</td>';
	echo '<td>'.$al['admin_mi'].'<a href="kullanicilar?admin_ayar=degistir&id='.$al["id"].'"><button>Değiştir</button></a></td>';
	echo '<td><a href="kullanicilar?guncelle=kisi&kim='.$al["id"].'"><button>Güncelle</button></a></td>';
	echo '<td><a href="kullanicilar?sil=kisi&kim='.$al["id"].'"><button>Sil</button></a></td>';
	}
	
}
else{
	
header("location:index");
}

}

echo "</tr></table>";
else {
@$kim = $baglan->query("select * from giris where id='$_GET[kim]'")->fetch();
echo '
<p align="center"><b><i><u>KULLANICI DÜZENLE</u></i></b></p>
<table border="0" align="center">
<form action="kullanicilar?guncelle_=1&kim='.@$_GET['kim'].'" method="post">
<tr>
<td align="right">Ad : </td>
<td><input type="text" name="kullanici_adi" value="'.$kim['ad'].'"></td>
</tr>
<tr>
<td align="right">Soyad : </td>
<td><input type="text" name="kullanici_adi" value="'.$kim['soyad'].'"></td>
</tr>
<tr>
<td align="right">Kullanıcı Adı : </td>
<td><input type="text" name="kullanici_adi" value="'.$kim['kullanici_adi'].'"></td>
</tr>
<tr>
<td align="right">Şifre : </td>
<td><input type="text" name="sifre" value="'.$kim['sifre'].'"></td>
</tr>

<tr>
<td align="right"> </td>
<td><input type="reset"  value="Formu Sıfırla"> <input type="submit"  value="Güncelle"></td>
</tr>

</form>
</table>';
}
if (isset($_GET["guncelle_"]))
{

$ad = $_POST["ad"];
$soyad = $_POST["soyad"];	
$kullanici_adi = $_POST["kullanici_adi"];
$sifre = $_POST["sifre"];

if(empty($kullanici_adi)||(empty($ad)||(empty($soyad)||empty($sifre))
{

echo "Boş bırakma!!!!!!!!!!!";

header("refresh:1;url=kullanicilar");

}
else
{

$baglan->exec("update giris set ad='$ad',soyad='$soyad',kullanici_adi='$kullanici_adi',sifre='$sifre' where id='$_GET[kim]'");

echo 'Kişi güncellendi....';

header("refresh:1;url=kullanicilar");
}

}

?>
        </p>
        <p>&nbsp;</p></td>
      </tr>
	  <tr bgcolor="#00CC66">
	    <td colspan="2"><img src="images/footer.jpg" width="1000" height="80"></td>
      </tr>
</table>
</body>
</html>

<?php
ob_end_flush();
?>