<?php
ob_start();
session_start();
?>
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
<title>MÜŞTERİ CİHAZI LİSTELE</title>
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
	    <td valign="top" width="184"><br>
      <div align="center"><a href="index"">ANASAYFA</a></div><br>
      <div align="center"><a href="musteri_cihazi_ekle">MÜŞTERİ CİHAZI EKLE</a></div><br>
      <div align="center"><a href="musteri_cihazi_listele?listele=1&s=1">MÜŞTERİ CİHAZI LİSTESİ</a></div><br>
      <div align="center"><a href="stok_ekle">STOĞA ÜRÜN EKLE</a></div><br>
		<div align="center"><a href="stok_listesi">STOK LİSTESİ</a></div><br>
        </td>
	    <td align="center">
       
		<?php
		
		include("baglan.php");
		

		if(isset($_GET['listele']))
		{

			$al = $baglan->query("select * from musteri_cihaz where durum='Bizde' order by ad asc",PDO::FETCH_ASSOC);
		echo '<p align="center"><b><i><u>Cihaz Filtrele</u></i></b></p><table width="600"><tr>';
		echo '<form method="post" action="musteri_cihazi_listele?arama=goster">
		<td align="right">Adını veya Soyadını Yazınız :</td><td align="left"> <input type="text" size="17" name="ara">&nbsp;
		<input type="submit" value="Ara"></td></form></tr>';
		echo '<tr align="center"><td colspan="2"><u><i>Ya da;</i></u></td></tr><tr><form method="post" action="musteri_cihazi_listele?filtre=goster">
		<td align="right">Marka Seçiniz : </td><td align="left"><select name="filtrele">
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
			</select>&nbsp;
		<input type="submit" value="Ara"></td></tr></form></table><hr>';
		echo '<p align="center"><b><i><u>BİZDEKİ CİHAZLAR</u></i></b></p>';
		
		echo 'Toplam <b>'.$al->rowCount().'</b> cihaz kayıtlı.';
		echo '<table width="600" border="1"><tr><th>AD</th><th>SOYAD</th><th>MARKA</th><th>DETAY</th></tr>';
		if($al->rowCount())
		{
			$sayfa = @$_GET['s'];
	if (empty($sayfa)|| !is_numeric($sayfa))
	{
	$sayfa = 1;
	}
	$kacar = 10;
	$k_sayisi_ = $baglan->query("select count(id) as kayit from musteri_cihaz where durum='Bizde'")->fetch();
	$k_sayisi = $k_sayisi_['kayit'];
	$s_sayisi = ceil($k_sayisi/$kacar);
	$nereden = ($sayfa*$kacar)-$kacar;
	$bul = $baglan->query("select * from musteri_cihaz where durum='Bizde' order by ad asc limit $nereden,$kacar");

		if($bul->rowCount())
		{
			foreach($bul as $yaz)
			{
					echo '<tr><td>'.$yaz['ad'].'</td>';
			echo '<td>'.$yaz['soyad'].'</td>';
			echo '<td>'.$yaz['marka'].'</td>';
			if(@$_GET['kisi']==$yaz['kim']) echo '<td><a href="musteri_cihazi_listele?listele=1&s='.@$_GET['s'].'"><i><b>Gizle</b></i></a></td></tr>';
			else echo '<td><a href="musteri_cihazi_listele?listele=1&s='.@$_GET['s'].'&kisi='.$yaz['kim'].'"><i><b>Göster</b></i></a></td></tr>';
		}
		
			
		}
		
		echo "</table>";
		
		if($sayfa!=1) echo '<a href="musteri_cihazi_listele?listele=1&s=1"><button>İlk</button></a> ';

	$geri = $sayfa-1;
	if($sayfa!=1) echo '<a href="musteri_cihazi_listele?listele=1&s='.$geri.'"><button>Geri</button></a> ';
	for($i=1;$i<=$s_sayisi;$i++)
	{
		
	echo '<a href="musteri_cihazi_listele?listele=1&s='.$i.'">';
	if ($sayfa==$i) echo '<b><i>|-'.$i.'-|</i></b></a> ';
	else echo '|-'.$i.'-|</a> ';
	}

	$ileri = $sayfa+1;
	if($sayfa!=$s_sayisi) echo '<a href="musteri_cihazi_listele?listele=1&s='.$ileri.'"><button>İleri</button></a> ';

	if($sayfa!=$s_sayisi) echo '<a href="musteri_cihazi_listele?listele=1&s='.$s_sayisi.'"><button>Son</button></a> ';
		}
		else
		{
			echo '<tr><td colspan="4">HENÜZ KİMSE KAYITLI DEĞİL!!!</td></tr></table>';
		}

		if(isset($_GET['kisi']))
		{
			
			$yaz_k = $baglan->query("select * from musteri_cihaz where kim='$_GET[kisi]'")->fetch();
			
			echo'
			<table width="600" border="0">
          <tr>
            <td colspan="2" align="center"><strong><i><u>CİHAZ BİLGİSİ DÜZENLE</u></i></strong></td>
          </tr>
			';
			
				echo '
		  <form method="post" action="musteri_cihazi_listele?duzenle='.$yaz_k['kim'].'">
          <tr>
            <td align="right">Ad : </td>
            <td> 
              <input type="text" name="ad" value="'.$yaz_k['ad'].'">
            </td>
          </tr>
          <tr>
            <td align="right">Soyad : </td>
            <td><input type="text" name="soyad" value="'.$yaz_k['soyad'].'"></td>
          </tr>
            <tr>
            <td align="right">Cep No : </td>
            <td><input type="text" value="+90" disabled="disabled" size="3"> - <input type="text" name="cep" size="10" maxlength="10" value="'.$yaz_k['cep'].'"></td>
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
		
			</select><b>'.$yaz_k['marka'].'</b> 
			</td>
          </tr>
          <tr>
          <td align="right">Model : </td>
          <td><input type="text" name="model" value="'.$yaz_k['model'].'"></td>
          </tr>
          <tr>
            <td align="right">Arıza : </td>
            <td><textarea name="ariza" cols="19" rows="8">'.$yaz_k['ariza'].'</textarea></td>
          </tr>
		    <tr>
          <td align="right">Fiyat : </td>
          <td><input type="text" name="fiyat" size="4" maxlength="4" value="'.$yaz_k['fiyat'].'"> TL</td>
          </tr>
		   <td align="right">Kişi İşlemleri : </td>
		   <td>
		   <a href="islemler?teslim=et&kisi='.$yaz_k['kim'].'">Teslim Et</a>
		   </td>
		   </tr>
          <tr>
            <td> </td>
            <td align="left"><input type="reset" value="Formu Sıfırla">&nbsp;
			&nbsp;<input type="submit" value="Kişiyi Güncelle"></td>
          </tr>
          </form>';
			
			
		  echo '

        </table>
        <p>&nbsp;</p>
			';
			
		}
		}
		
		else if(isset($_GET['arama']))
		{
			echo '<table width="600" border="1"><tr><th>AD</th><th>SOYAD</th><th>MARKA</th><th>DETAY</th></tr>';
			$ara = $_POST['ara'];
			if(empty($ara))
			{
				echo '<tr><td colspan="4">Lütfen arama alanını boş geçmeyin!! <a href="musteri_cihazi_listele?listele=1">
				<< Geri</a></tr>';
				
			}
			else
			{
				$ara_k_ = $baglan->query("select * from musteri_cihaz where ad like '%$ara%' or soyad like '%$ara%' and durum='Bizde'",PDO::FETCH_ASSOC);

			if($ara_k_->rowCount())
			{
				foreach($ara_k_ as $ara_k)
				{
				echo '<tr align="center"><td>'.$ara_k['ad'].'</td>';
				echo '<td>'.$ara_k['soyad'].'</td>';
				echo '<td>'.$ara_k['marka'].'</td>';
			   echo '<td  width="40"><a href="?listele=1&kisi='.$ara_k['kim'].'"><i><b>Göster</b></i></a></td></tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="4">Eşleşme bulunamadı!! <a href="musteri_cihazi_listele?listele=1">
				<< Geri</a></tr>';
				
			}
				
			
			}
			
			echo '</table>';
		}
		
		
	
			else if(isset($_GET['duzenle']))
			{
				$ad = $_POST['ad'];
				$soyad = $_POST['soyad'];
				$marka = $_POST['marka'];
				$model = $_POST['model'];
				$ariza = $_POST['ariza'];			
				$cep = $_POST['cep'];
				$fiyat= intval($_POST['fiyat']);
				$cep_b = substr($cep,0,1);
				$cep_k = ctype_digit($cep);
				if($cep_b!=5)
				{
					echo "Cep no yanlış girildi '5' ile başlamalı.<br>";
					header("refresh:1;url=musteri_cihazi_listele?listele=1");
					
				}
				
				else if(!$cep_k)
				{
					echo "Cep no yanlış girildi sadece sayı olabilir.<br>";
					header("refresh:1;url=musteri_cihazi_listele?listele=1");
				
				}
				
				
				else if(strlen($cep)<10)
				{
					echo "Cep no 10 haneden küçük olamaz..<br>";
					header("refresh:1;url=musteri_cihazi_listele?listele=1");
					
				}
				else if(empty($ad)||empty($soyad)||empty($cep)||empty($marka)||empty($model)||empty($ariza)||empty($fiyat))
				{
					echo "Lütfen boş alan bırakmayınız!!!<br>";
					header("refresh:1;url=musteri_cihazi_listele?listele=1");
					
				}
			
				else
				{	
	
					
					$baglan->exec("update musteri_cihaz set ad='$ad',soyad='$soyad',cep='$cep',marka='$marka',model='$model',ariza='$ariza',fiyat='$fiyat' where kim='$_GET[duzenle]'");
					
					echo "Kişi başarıyla güncellendi....";
					header("refresh:1;url=musteri_cihazi_listele?listele=1&kisi=$_GET[duzenle]");
				}
				}
			
			else if(isset($_GET['filtre']))
			{
				$filtre_k = $_POST['filtrele'];
				
				$gor=$baglan->query("select * from musteri_cihaz where marka='$filtre_k' and durum='Bizde'",PDO::FETCH_ASSOC);
				echo '<table border="1"><tr><th>AD</th><th>SOYAD</th><th>MARKA</th><th>DETAY</th></tr>';
				
				if($gor->rowCount())
				{
					foreach($gor as $yaz_f)
				{
					echo '<tr width="40"><td width="40">'.$yaz_f['ad'].'</td>';
				echo '<td>'.$yaz_f['soyad'].'</td>';
				echo '<td width="40">'.$yaz_f['marka'].'</td>';
				echo '<td  width="40"><a href="musteri_cihazi_listele?listele=1&kisi='.$yaz_f['kim'].'"><i><b>Göster</b></i></a></td></tr>';
				
				}
			}
				else
				{
					echo '<tr><td colspan="4" align="center">FİLTREYE UYGUN KİŞİ BULUNAMADI... <a href="musteri_cihazi_listele?listele=1">
					<< Geri</a></tr>';
				
				}
				echo "</table>";
				
				
			}

else
{
	header("location:index.php");
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