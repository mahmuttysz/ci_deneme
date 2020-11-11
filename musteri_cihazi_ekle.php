<?php
ob_start();
session_start();
?>
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
<title>MÜŞTERİ EKLE</title>
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
	    <td align="center">        <br>
        <table border="0">
          <tr>
            <td colspan="2" align="center"><strong>MÜŞTERİ CİHAZI EKLE</strong></td>
          </tr>
		  
		  <form method="post" action="musteri_cihazi_ekle?ekle=1">
          <tr>
            <td align="right">Ad : </td>
            <td>
              <input type="text" name="ad">
            </td>
          </tr>
          <tr>
            <td align="right">Soyad : </td>
            <td><input type="text" name="soyad"></td>
          </tr>
           <tr>
            <td align="right">Cep No : </td>
            <td><input type="text" value="+90" disabled="disabled" size="3"> - <input type="text" name="cep" size="12" maxlength="10"></td>
          </tr>
          <tr>
            <td align="right">Marka : </td>
            <td><select name="marka">
			<option value="">Marka Seçiniz</option>
			<option value="Samsung">Samsung</option>
			<option value="iPhone">iPhone</option>
			<option value="LG">LG</option>
			<option value="HTC">HTC</option>
			<option value="General Mobile">General Mobile</option>
			<option value="ASUS">ASUS</option>
			<option value="BlackBerry">BlackBerry</option>
			<option value="Sony">Sony</option>
			<option value="Nokia">Nokia</option>
			<option value="Turkcell">Turkcell</option>
			<option value="Avea">Avea</option>
			<option value="Vodafone">Vodafone</option>
			<option value="Casper">Casper</option>
			<option value="Lenovo">Lenovo</option>
			<option value="Diğer">Diğer</option>
			</select>
			</td>
          </tr>
         <tr>
            <td align="right">Model : </td>
            <td><input type="text" name="model"></td>
          </tr>
          
         
     	  <tr>
            <td align="right">Arıza : </td>
            <td><textarea name="ariza" cols="19" rows="8"></textarea></td>
          </tr>
          <tr>
            <td align="right">Fiyat : </td>
            <td><input type="text" name="fiyat" size="4" maxlength="4"> TL</td>
          </tr>
		  
		  <tr>
            <td align="right">&nbsp;</td>
            <td align="center"><input type="reset" value="Formu Sıfırla">&nbsp;&nbsp;<input type="submit" value="Kişi Ekle"></td>
          </tr>
          </form>
        </table>
        <p>
          <?php

		if(isset($_GET['ekle']))
			{
				$ad = $_POST['ad'];
				$soyad = $_POST['soyad'];
				$marka = $_POST['marka'];
				$model = $_POST['model'];
				$ariza = $_POST['ariza'];
				$cep = $_POST['cep'];
				$fiyat = intval($_POST['fiyat']);
				$cep_b = substr($cep,0,1);
				$cep_k = ctype_digit($cep);
				if($cep_b!=5)
				{
					echo "Cep no yanlış girildi '5' ile başlamalı.<br>";
					header("refresh:1;url=musteri_cihazi_ekle");
					
				}
				
				else if(!$cep_k)
				{
					echo "Cep no yanlış girildi sadece sayı olabilir.<br>";
					header("refresh:1;url=musteri_cihazi_ekle");
					
				}
				
				else if(strlen($cep)<10)
				{
					echo "Cep no 10 haneden küçük olamaz..<br>";
					header("refresh:1;url=musteri_cihazi_ekle");
					
				}
				
				
				
					
					
				else if(empty($ad)||empty($soyad)||empty($marka)||empty($model)||empty($cep)||empty($ariza)||empty($fiyat))
				{
					echo "Lütfen boş alan bırakmayınız!!!<br>";
					header("refresh:1;url=musteri_cihazi_ekle");
					
				}
				
				else
				{
					
					date_default_timezone_set('Europe/Istanbul');
					$tarih =  date("j").".".date("n").".".date("Y")." ".date("H").":".date("i");


					$kim=md5($ad).md5($soyad).md5($marka).md5(rand(0,999999));
					
					
					include("baglan.php");
					
					$baglan->exec("insert into musteri_cihaz(kim,ad,soyad,marka,model,cep,ariza,fiyat,alis_tarih) values('$kim','$ad','$soyad','$marka','$model','$cep','$ariza','$fiyat','$tarih')");
					
					echo "Kişi başarıyla eklendi....";
					header("refresh:1;url=musteri_cihazi_ekle");
					
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

<?php
ob_end_flush();
?>
