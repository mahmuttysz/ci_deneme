<?php
ob_start();
session_start();
?>
 <head>
 <title>TARİHE GÖRE LİSTE</title>
 <link rel="Shortcut Icon"  href="images/icon.jpg" type="image/x-icon">
<style type="text/css">
	
	body{
		background-color: turquoise;
	}

</style>
</head>
<body>
<font face="Arial">
	  <b><i><u><p align="center">TARİHE GÖRE CİHAZLARIN LİSTESİ</p></u></i></b>
	  <?php
	  $tarih = $_GET['tarih'];
	echo '<p align="center"><a href="dokum_tarih?listele=Hepsi&tarih='.$tarih.'">Hepsi</a> - <a href="dokum_tarih?listele=Bizde&tarih='.$tarih.'">Bizde</a> - <a href="dokum_tarih?listele=TeslimEdildi&tarih='.$tarih.'">Teslim Edildi</a></p>'
	   ;  ?>
	    <table border="1" width="1200" align="center"><tr><th>AD</th><th>SOYAD</th><th>CEP</th><th>MARKA</th><th>MODEL</th><th width="25">ARIZA</th><th>FİYAT</th><th>ALIŞ TARİHİ</th><th>TESLİM TARİHİ</th><th>DURUM</th></tr>

	    
	    	<?php
	    	include("baglan.php");
	    	
	    	if(empty($_GET["tarih"]))
 			{
 				echo "<tr><td colspan='10' align='center'><b>LÜTFEN TARİH SEÇENEKLERİNİ BOŞ BIRAKMAYIN!!!</b></td></tr></table>";
 				
			}
			else
			{
			$tarih= $_GET["tarih"];
	    	
			if(@$_GET["listele"]=="Bizde") $cihazlar=$baglan->query("select * from musteri_cihaz where alis_tarih like '%$tarih%' and durum='Bizde' order by id desc",PDO::FETCH_ASSOC);

			else if(@$_GET["listele"]=="TeslimEdildi") $cihazlar=$baglan->query("select * from musteri_cihaz where alis_tarih like '%$tarih%' and durum='Teslim Edildi' order by id desc",PDO::FETCH_ASSOC);

	    	else $cihazlar=$baglan->query("select * from musteri_cihaz where alis_tarih like '%$tarih%' order by id desc",PDO::FETCH_ASSOC);

	    	
	    	if($cihazlar->rowCount())
	    	{
	    		foreach($cihazlar as $yaz)
	    		{
	    			$kac = strlen($yaz['ariza']);
	    			if ($yaz["durum"]=="Bizde") 
	    			{
	    			echo '<tr align="center" bgcolor="red"> <td><font color="white">'.$yaz["ad"].'</font></td>';
	    			echo '<td><font color="white">'.$yaz["soyad"].'</font></td>';
	    			echo '<td><font color="white">0'.$yaz["cep"].'</font></td>';
	    			echo '<td><font color="white">'.$yaz["marka"].'</font></td>';
	    			echo '<td><font color="white">'.$yaz["model"].'</font></td>';
	    			if($kac>20) echo '<td><font color="white">'.substr($yaz["ariza"],0,20).' ...</font></td>';
	    			else echo '<td><font color="white">'.$yaz["ariza"].'</font></td>';
	    			echo '<td><font color="white">'.$yaz["fiyat"].' TL</font></td>';
	    			echo '<td><font color="white">'.$yaz["alis_tarih"].'</font></td>';
	    			echo '<td><font color="white">'.$yaz["teslim_tarih"].'</font></td>';
	    			echo '<td><font color="white">'.$yaz['durum'].'</font></td>';
	    			}
	    			else
	    			{
	    			echo '<tr align="center" bgcolor="#60c46c"> <td>'.$yaz["ad"].'</td>';
	    			echo '<td>'.$yaz["soyad"].'</td>';
	    			echo '<td>0'.$yaz["cep"].'</td>';
	    			echo '<td>'.$yaz["marka"].'</td>';
	    			echo '<td>'.$yaz["model"].'</td>';
	    			if($kac>20) echo '<td class="max">'.substr($yaz["ariza"],0,20).' ...</td>';
	    			else echo '<td class="max">'.$yaz["ariza"].'</td>';
	    			echo '<td>'.$yaz["fiyat"].' TL</td>';
	    			echo '<td>'.$yaz["alis_tarih"].'</td>';
	    			echo '<td>'.$yaz["teslim_tarih"].'</td>';
	    			echo '<td>'.$yaz['durum'].'</td>';
	    			}
	    		}
	    	}
	    	else{
	    		
	    		echo'<tr><td colspan="10" align="center"><b>KRİTERE UYGUN CİHAZ YOK!!!!</b></td>';
	    		}
	    		
	    		echo "</tr></table>
	    		
	    		<p align='center'>Toplam ==> <b><i>".$cihazlar->rowCount()."</i></b> ...</p>
	    		";	
			}
	    
	    	?>

	    	</font>
	    	</body>
			<?php
			ob_end_flush();
			?>