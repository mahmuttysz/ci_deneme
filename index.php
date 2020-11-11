<?php
ob_start();
session_start();
?>
<html>
<head>
<title>AnaSayfa</title>
<link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
<link href="style.css" rel="stylesheet" type="text/css">
<script src="jquery-3.2.1.js" type="text/javascript"></script>
    <script src="takvim.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#tarih_").Takvim({ event: "mouseover", Time: 1000 });
            
        });
    </script>
    <style type="text/css">
        input text{width:250px;font:10pt tahoma;cursor:crosshair}
        
        .takvim_baslik{text-align:center;font:bold 10pt tahoma;background:#147;color:#fff;border:solid 1px #ccc;}
        .takvim_baslik td{padding:2px 0;}
	    .gun_adi{text-align:center;width:28px;padding:3px 1px;font:bold 10pt tahoma;background:#dcdcdc;border:solid 1px #ccc;}
	    .gun_no td{font:10pt calibri;background:#eee;border:solid 1px #ccc;}
	    .gun_no a{float:left;width:100%;text-decoration:none;text-align:center;color:#000;cursor:pointer;}
	        .gun_no a:hover{background:#800;color:#fff;}
	    #TakvimAlani{position:absolute;overflow:hidden;display:none;}
    </style>
</head>
<body>

	<table width="1000" border="0" align="center">
	  <tr bgcolor="#00CC33">
	    <td colspan="2"><img src="images/banner.jpg" width="1000" height="80"></td>
      </tr>
	  <tr bgcolor="#00CC66">
	    <td align="center"><b><u><i>İŞLEMLER</i></u><b></td>
	    <td align="right">
	    <?php
		
if($_SESSION['isim']==null) header("location:giris");

else
{
	if($_SESSION['kullanici_adi']=="mahmut_tuysuz") echo '<a href="kullanicilar">Kullanıcı Listesi </a>';
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

	    <p align="center"><b><i><u>BİLANÇO</u></i></b></p>
	    <?php
	    include("baglan.php");
	    $kazanilan_ = $baglan->query("select sum(fiyat) as fiyat_ from musteri_cihaz where durum='Teslim Edildi'")->fetch();
	    if($kazanilan_['fiyat_']==null) $kazanilan = 0;
	    else $kazanilan = $kazanilan_['fiyat_'];
	   
	    $beklenen_ =  $baglan->query("select sum(fiyat) as fiyat_ from musteri_cihaz where durum='Bizde'")->fetch();
	    if($beklenen_['fiyat_']==null) $beklenen = 0;
	    else $beklenen = $beklenen_['fiyat_'];

	    $ciro = $kazanilan+$beklenen;
	    echo '
	    	<table border="0" align="center">
	    	<tr><td align="right">Kazanılan para : </td><td><b><i>'.$kazanilan.' TL</i></b></td></tr>
			<tr><td align="right">Kazanılması beklenen para : </td><td><b><i>'.$beklenen.' TL</i></b></td><tr>
			<tr><td align="right">Toplam Ciro : </td><td><b><i>'.$ciro.' TL</i></b></td></tr>
			</table>
			<a href="dokum?listele=Hepsi" target="_blank">Tüm Cihazların Listesi</a>
			<br>
			<b><i><u>Tarihe Göre Listele</u></i></b><br>
			<table border="0" align="center">
			<tr><td>

			<form action="dokum_tarih?listele=Hepsi" target="_blank" method="get">
			<input type="text" id="tarih_" name="tarih">
			<input type="submit" value="Listele">
			</form>

			</td>
			</tr></table>
	    ';
	    ?>
	   
<p> </p>
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