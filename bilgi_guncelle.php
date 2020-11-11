<?php
ob_start();
session_start();
?>
<html>
<head>
<title>BİLGİ GÜNCELLE</title>
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
$yaz = $baglan->query("SELECT * from giris where kullanici_adi='$_SESSION[kullanici_adi]'")->fetch();

$ad = $yaz["ad"];
$soyad = $yaz["soyad"];

if($_SESSION['isim'] == "") header("location:giris");
else
{
	
	echo "Hoşgeldiniz "."<b>".$_SESSION['isim']."</b>&nbsp;&nbsp;";
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
		<br>
		<table border="0" align="center">
<form action="bilgi_guncelle?yap=guncelle" method="post">
<tr>
<td colspan="2"><b>BİLGİLERİMİ GÜNCELLE</b></td>
</tr>
<tr>
<td align="right">Ad : </td>
<td><input type="text" disabled="disabled" value="<?=$yaz['ad']?>"></td>
</tr>
<tr>
<td align="right">Soyad : </td>
<td><input type="text" disabled="disabled" value="<?=$yaz['soyad']?>"></td>
</tr>
<tr>
<td align="right">Kullanıcı Adı : </td>
<td><input type="text" disabled="disabled" value="<?=$yaz['kullanici_adi']?>"></td>
</tr>

<tr>
<td align="right">Şifre : </td>
<td><input type="password" name="sifre"></td>
</tr>
<tr>
<td align="right">Şifre Tekrar : </td>
<td><input type="password" name="sifre2"></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" value="Güncelle"></td>
</tr>
</form>
</table>

          <p>
            <?php
if(isset($_GET['yap'])=="guncelle")
{

	$sifre = $_POST['sifre'];
	$sifre2 = $_POST['sifre2'];

		
	if(empty($sifre) || empty($sifre2))
	{
		echo "Boş alan bırakmayın!!!";
		header("refresh:1;url=bilgi_guncelle");
		
	}

	
	else if($sifre != $sifre2)
	{
		echo "Şifreler eşleşmiyor!!!";
		header("refresh:1;url=bilgi_guncelle");
	}
	else if(strlen($sifre)<5 || strlen($sifre)>16)
	{
		echo "Şifre en az 5, en fazla 15 karakter olmalı!!";
		header("refresh:1;url=bilgi_guncelle");
	}
	
	
	else
	{
		
		$baglan->exec("UPDATE giris set sifre='$sifre' where kullanici_adi='$_SESSION[kullanici_adi]'");
	
		echo "Bilgileriniz başarıyla güncellendi...";
		header("refresh:1;url=giris?cikis=cik");
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