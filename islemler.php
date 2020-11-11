<?php
ob_start();
session_start();
?>
<html>
<head>
<title>AnaSayfa</title>
<link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<table width="1000" border="0" align="center">
	  <tr bgcolor="#00CC33">
	    <td colspan="2"><img src="images/banner.jpg" width="1000" height="80"></td>
      </tr>
	  <tr bgcolor="#00CC66">
	    <td align="center"><b><u><i>İŞLEMLER</i></u><b></td>
	    <td align="right"><?php
		
if($_SESSION['isim']=="") header("location:giris");

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
	    <p align="center"><b><i>TESLİM ET</i></b></p>
	    <?php
	    include("baglan.php");
	    if(isset($_GET["teslim"]))
	    {
	       $al = $baglan->query("select * from musteri_cihaz where kim='$_GET[kisi]'")->fetch();
	   
	   echo '<table><tr><td align="right"><b>Ad : </b></td><td>'.$al["ad"].'</td></tr>
	    <tr><td align="right"><b>Soyad :</b></td><td>'.$al["soyad"].'</td></tr>
	    <tr><td align="right"><b>Marka : </b></td><td>'.$al["marka"].'</td></tr>
	    <tr><td align="right"><b>Model :</b></td><td>'.$al["model"].'</td></tr>
	    <tr><td align="right"><b>Alış Tarihi : </b></td><td>'.$al["alis_tarih"].'</td></tr>
	    <form action="islemler?islem=tamam&kisi='.$_GET["kisi"].'" method="post">
	    <tr><td align="right"><b>Arıza : </b></td><td><textarea name="ariza" cols="19" rows="8">'.$al["ariza"].'</textarea></td></tr>
	    <tr><td align="right"><b>Fiyat : </b></td><td><input type="text" name="fiyat" size="4" maxlength="4" value="'.$al['fiyat'].'"> TL</td></tr>
	    <tr><td align="right"><b>İade : </b></td><td><input type="checkbox" name="iade" value="1"></td></tr>
	    <tr><td></td><td align="right"><input type="submit" value="Teslim Et"></td></tr>
	    <tr></tr>
	    </table>
</form
	    ';	
	    }
	 	else if(isset($_GET["islem"]))
	 	{
	 		date_default_timezone_set('Europe/Istanbul');
			$tarih =  date("j").".".date("n").".".date("Y")." ".date("H").":".date("i");
	 		$durum = "Teslim Edildi";


	 		$ariza = $_POST["ariza"];
	 		$fiyat = intval($_POST['fiyat']);
	 		$iade = @$_POST["iade"];
	 		if(empty($_POST['fiyat'])||empty($ariza)) 
	 		{
	 		echo "Lütfen boş alan bırakmayınız!!!";
	 		header("refresh:1;url=islemler?teslim=et&kisi=$_GET[kisi]");
	 		
	 		}
	 		else if($iade=="1")
	 		{
	 			$ariza="iade";
	 			$fiyat=0;
	 			$baglan->exec("update musteri_cihaz set ariza='$ariza',fiyat='$fiyat',teslim_tarih='$tarih',durum='$durum' where kim='$_GET[kisi]'");
	 		echo "Cihaz teslim edildi!!!";
	 		header("refresh:1;url=index");
	 		}
	 		else if(!ctype_digit($_POST['fiyat']))
	 		{
	 		echo "Lütfen geçerli fiyat giriniz!!!";
	 		header("refresh:1;url=islemler?teslim=et&kisi=$_GET[kisi]");
	 		}

	 		else
	 		{
	 		
	 		
	 		$baglan->exec("update musteri_cihaz set ariza='$ariza',fiyat='$fiyat',teslim_tarih='$tarih',durum='$durum' where kim='$_GET[kisi]'");
	 		echo "Cihaz teslim edildi!!!";
	 		header("refresh:1;url=index");
	 		}
	 		
	 		
	 		
	 		
	 	}

	    else
	    {
	    	header("location:index");
	    }
	     ?>

	     </td>
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