<?php
ob_start();
session_start();
?>
<html>
<head>
<title>STOĞA ÜRÜN EKLE</title>
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
			<tr><td colspan="2"><b><i>Stoğa Ürün Ekle</i></b></td></tr>
			<form action="stok_ekle?stok=ekle" method="post">
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
				<td align="right">Tür : </td>
            <td><select name="tur">
			<option value="">Tür Seçiniz</option>
      <option value="Batarya">Batarya</option>
			<option value="Beyaz LCD">Beyaz LCD</option>
			<option value="Siyah LCD">Siyah LCD</option>
			<option value="Gold LCD">Gold LCD</option>
			<option value="Gri LCD">Gri LCD</option>
			<option value="Mavi LCD">Mavi LCD</option>
      			</select>
			</td>
			</tr>
			<tr>
				<td align="right">Adet : </td>
            <td><input type="text" name="adet" size="4"></td>
			</tr>
			<tr><td colspan="2" align="right"><input type="submit" value="Stok Ekle"></td></tr>
		</form>

</table>

          <p>
            <?php
           include("baglan.php");
            if(isset($_GET['stok']))
            {
            $marka=$_POST["marka"];
            $model=$_POST["model"];
            $tur=$_POST["tur"];
            $adet=intval($_POST["adet"]);
           if(!ctype_digit($_POST['adet']))
            {
            	echo 'Girdiğiniz adet sayısı yanlış!!!';
            	header("refresh:1;url=stok_ekle");
              
            }
            else if(empty($marka)||empty($model)||empty($tur)||empty($adet))
            {
            	echo 'Boş alan bırakmayınız!!!';
            	header("refresh:1;url=stok_ekle");
             
            }
            else
            {
            	$bak = $baglan->query("select * from stok where marka='$marka' and model='$model' and tur = '$tur'")->fetch();
            
            	if($bak)
            	{
            		$adet_ekle = $adet + $bak['adet']; 
            		$baglan->exec("update stok set adet = '$adet_ekle' where marka='$marka' and model='$model' and tur = '$tur'");
            		echo 'Stok başarıyla eklendi!!!';
            		header("refresh:1;url=stok_ekle");
               
            	}
            	else
            	{
            	$baglan->exec("insert into stok(marka,model,tur,adet) value('$marka','$model','$tur','$adet')");
            	echo 'Stok başarıyla eklendi!!!';
            	header("refresh:1;url=stok_ekle");	
              
              
            	}
            	

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