<?php
ob_start();
session_start();
?>
<html>
<head>
<title>GİRİŞ YAP</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
</head>
<body>
<table width="1000" border="0" align="center">
	  <tr bgcolor="#00CC33">
	    <td colspan="2"><img src="images/banner.jpg" width="1000" height="80"></td>
      </tr>
	 
	  <tr bgcolor="#00CC66">
	    <td align="center"><p>&nbsp;</p>
	      <table class="giris_form" border="0" align="center">
<form method="post" action="giris?giris=gir">
<tr>
<td colspan="2" align="center">GİRİŞ YAP</td>
</tr>
<tr>
<td align="right">Kullanıcı Adı : </td>
<td>


<input type="text" name="kullanici_adi"></td>

</tr>
<tr>
<td align="right">Şifre : </td>
<td><input type="password" name="sifre"></td>

</tr>

<tr>
<td align="right" colspan="2">
<input type="submit" name="giris_yap" value="Giriş Yap"></td>

</tr>
</form>
</table>
	      <p>&nbsp;</p>
          <p>
            <?php
			
if(isset($_GET['giris'])=="gir")
{
	
$kullanici_adi = $_POST["kullanici_adi"];
$sifre = $_POST["sifre"];

if(empty($kullanici_adi) || empty($sifre))
{
	echo "Lütfen boş alan bırakmayınız!!!";
	header("refresh:1;url=giris");
}
else
{
	include("baglan.php");

	$kontrol_et = $baglan->query("select * from giris where kullanici_adi='$kullanici_adi' and sifre='$sifre'",PDO::FETCH_ASSOC);
	if($kontrol_et->rowCount())
	{
	foreach ($kontrol_et as $yaz)
	{
	$isim = $yaz['ad']."&nbsp;".$yaz['soyad'];
	$admin_mi = $yaz['admin_mi'];
	}
		$_SESSION['isim'] = $isim;
		$_SESSION['kullanici_adi'] = $kullanici_adi;
		$_SESSION['sifre'] = $sifre;
		$_SESSION['admin_mi'] = $admin_mi;
		
		header("location:index");
	}
	
	
	$bak = $baglan->query("select * from giris where kullanici_adi='$kullanici_adi'",PDO::FETCH_ASSOC);
	
	if(!$bak->rowCount())
	{
		echo "Böyle bir kullanıcı yok!!!";

		header("refresh:1;url=giris");
		
	}

	$esles = $baglan->query("select * from giris where kullanici_adi='$kullanici_adi' and not sifre='$sifre'",PDO::FETCH_ASSOC);
	if($esles->rowCount())
	{
		echo 'Şifreyi yanlış girdiniz...';
		header("refresh:1;url=giris");
	}
}
}
if(isset($_GET['cikis'])=="cik")
{
	ob_start();
session_start();
session_destroy();
header("location:index");
ob_end_flush();
}
ob_end_flush();
?>
          </p>
        <p>&nbsp; </p></td>

  </tr>
	  <tr bgcolor="#00CC66">
	    <td colspan="2"><img src="images/footer.jpg" width="1000" height="80"></td>
      </tr>
</table>




</body></html>