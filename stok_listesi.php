<?php
ob_start();
session_start();
?>
<html>
<head>
<title>STOK LİSTESİ</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
</head>
<body>
<table width="1000" border="0" align="center">
	  <tr bgcolor="#00CC33">
	    <td colspan="2"><img src="images/banner.jpg" width="1000" height="80"></td>
      </tr>
	  <tr bgcolor="#00CC66">
	    <td align="center"><b><u><i>İŞLEMLER</i></u></b></td>
	    <td align="right"><?php
		
if($_SESSION['isim'] == "") header("location:giris");
else
{
	echo "Hoşgeldiniz "."<b>".$_SESSION['isim']."</b>&nbsp;&nbsp;";
	echo '<a href="bilgi_guncelle"><img src="images/guncelle.png" width="30" height="25" title="Bilgilerimi Güncelle">
	</a>
		<a href="giris?cikis=cik"><img src="images/cikis.png" width="30" height="25" title="Çıkış Yap"></a>
	';
	}
?></td>
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
	    	<p align="center"><b><i>STOK LİSTESİ</i></b></p>
	    	<table border="1">	

	    	<tr><th>MARKA</th><th>MODEL</th><th>TÜR</th><th>ADET</th></tr>
	    	<?php
	    	include("baglan.php");
			
			if(isset($_GET['dus']))
			{
				$al = $baglan->query("select * from stok where id='$_GET[hangi]'")->fetch();
				if($al['adet']==0)
				{
					header("location:stok_listesi");
				}
			else
					{
					$adet_g = $al['adet']-1;
					$baglan->exec("update stok set adet = '$adet_g' where id='$_GET[hangi]'");
					header("location:stok_listesi");	
					}
		}
			else if(isset($_GET['ekle']))
			{
				$al_ = $baglan->query("select * from stok where id='$_GET[hangi]'")->fetch();
				
				$adet_g_ = $al_['adet']+1;
				$baglan->exec("update stok set adet = '$adet_g_' where id='$_GET[hangi]'");
				header("location:stok_listesi");
				
			}
			else
			{
				$sirala = $baglan->query("SELECT * from stok order by adet desc");
				
				if ($sirala->rowCount())
				{
					foreach($sirala as $yaz)
			{
				if($yaz['adet']==0)
				{
					
					echo '<tr bgcolor="red"><td><font color="white">'.$yaz['marka'].'</font></td>';
					echo '<td><font color="white">'.$yaz['model'].'</font></td>';
						echo '<td><font color="white">'.$yaz['tur'].'</font></td>';
							echo '<td><font color="white">&nbsp;<b>'.$yaz['adet'].'</b> ==><a href="stok_listesi?dus=cikar&hangi='.@$yaz['id'].'">
							<button>Stok Düş</button></a> -- <a href="stok_listesi?ekle=artir&hangi='.@$yaz['id'].'">
							<button>Stok Arttır</button></a></font></td>';	
					
				}
				else
				{
				echo '<tr><td>'.$yaz['marka'].'</td>';
					echo '<td>'.$yaz['model'].'</td>';
						echo '<td>'.$yaz['tur'].'</td>';
							echo '<td>&nbsp;<b>'.$yaz['adet'].'</b> ==><a href="stok_listesi?dus=cikar&hangi='.@$yaz['id'].'">
							<button>Stok Düş</button></a> -- <a href="stok_listesi?ekle=artir&hangi='.@$yaz['id'].'">
							<button>Stok Arttır</button></a></td>';	
				}
				
			}
				}
	    	
			}


			$sor_samsung = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Samsung' and not tur='Batarya'")->fetch();
			if($sor_samsung['adet_']==null) $samsung = 0;
			else $samsung = $sor_samsung['adet_'];
				
		
			

			$sor_iphone = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='iPhone' and not tur='Batarya'")->fetch();
			if($sor_iphone['adet_']==null) $iphone = 0;
			else $iphone = $sor_iphone['adet_'];
			
			
			$sor_lg = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='LG' and not tur='Batarya'")->fetch();
			if($sor_lg['adet_']==null) $lg = 0;
			else $lg = $sor_lg['adet_'];


			$sor_htc = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='HTC' and not tur='Batarya'")->fetch();
			if($sor_htc['adet_']==null) $htc = 0;
			else $htc = $sor_htc['adet_'];


			$sor_sony = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Sony' and not tur='Batarya'")->fetch();
			if($sor_sony['adet_']==null) $sony = 0;
			else $sony= $sor_sony['adet_'];


			$sor_nokia = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Nokia' and not tur='Batarya'")->fetch();
			if($sor_nokia['adet_']==null) $nokia = 0;
			else $nokia = $sor_nokia['adet_'];


			$sor_tr = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Turkcell' and not tur='Batarya'")->fetch();
			if($sor_tr['adet_']==null) $tr = 0;
			else $tr = $sor_tr['adet_'];

			$sor_bb = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='BlackBerry' and not tur='Batarya'")->fetch();
			if($sor_bb['adet_']==null) $bb = 0;
			else $bb = $sor_bb['adet_'];

			$sor_asus = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='ASUS' and not tur='Batarya'")->fetch();
			if($sor_asus['adet_']==null) $asus = 0;
			else $asus = $sor_asus['adet_'];

			$sor_gm = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='General Mobile' and not tur='Batarya'")->fetch();
			if($sor_gm['adet_']==null) $gm = 0;
			else $gm = $sor_gm['adet_'];

			$sor_avea = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Avea' and not tur='Batarya'")->fetch();
			if($sor_avea['adet_']==null) $avea = 0;
			else $lg = $sor_avea['adet_'];

			$sor_vf = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Vodafone' and not tur='Batarya'")->fetch();
			if($sor_vf['adet_']==null) $vf = 0;
			else $vf = $sor_vf['adet_'];

			$sor_casper = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Casper' and not tur='Batarya'")->fetch();
			if($sor_casper['adet_']==null) $casper = 0;
			else $casper = $sor_casper['adet_'];


			$sor_len = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Lenovo' and not tur='Batarya'")->fetch();
			if($sor_len['adet_']==null) $len = 0;
			else $len = $sor_len['adet_'];


			$sor_diger = $baglan->query("SELECT sum(adet) as adet_ from stok where marka='Diğer' and not tur='Batarya'")->fetch();
			if($sor_diger['adet_']==null) $diger = 0;
			else $diger = $sor_diger['adet_'];


			$sor_toplam = $baglan->query("SELECT sum(adet) as adet_ from stok where not tur='Batarya'")->fetch();
			if($sor_toplam['adet_']==null) $toplam = 0;
			else $toplam = $sor_toplam['adet_'];
   	?>
</tr>
</table>
<p><b>MARKALARA GÖRE EKRANLARIN BİLANÇOSU</b></p>
<p>Toplam <b><i><?=$samsung?></i></b> adet Samsung LCD;</p>
<p>Toplam <b><i><?=$iphone?></i></b> adet iPhone LCD;</p>
<p>Toplam <b><i><?=$lg?></i></b> adet LG LCD;</p>
<p>Toplam <b><i><?=$htc?></i></b> adet HTC LCD;</p>
<p>Toplam <b><i><?=$gm?></i></b> adet General Mobile LCD;</p>
<p>Toplam <b><i><?=$asus?></i></b> adet ASUS LCD;</p>
<p>Toplam <b><i><?=$bb?></i></b> adet BlackBerry LCD;</p>
<p>Toplam <b><i><?=$sony?></i></b> adet Sony LCD;</p>
<p>Toplam <b><i><?=$nokia?></i></b> adet Nokia LCD;</p>
<p>Toplam <b><i><?=$tr?></i></b> adet Turkcell LCD;</p>
<p>Toplam <b><i><?=$vf?></i></b> adet Vodafone LCD;</p>
<p>Toplam <b><i><?=$avea?></i></b> adet Avea LCD;</p>
<p>Toplam <b><i><?=$casper?></i></b> adet Casper LCD;</p>
<p>Toplam <b><i><?=$len?></i></b> adet Lenovo LCD;</p>
<p>Toplam <b><i><?=$diger?></i></b> adet Diğer LCD;</p>
<p>Genel Toplam <b><i><?=$toplam?></i></b> adet LCD;</p>
          <p>
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