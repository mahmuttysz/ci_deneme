var aylar = new Array(); aylar[0] = "Ocak"; aylar[1] = "Şubat"; aylar[2] = "Mart"; aylar[3] = "Nisan"; aylar[4] = "Mayıs"; aylar[5] = "Haziran"; aylar[6] = "Temmuz"; aylar[7] = "Ağustos"; aylar[8] = "Eylül"; aylar[9] = "Ekim"; aylar[10] = "Kasım"; aylar[11] = "Aralık";
var gunler_kisa = new Array(); gunler_kisa[0] = "Pzt"; gunler_kisa[1] = "Sal"; gunler_kisa[2] = "Çar"; gunler_kisa[3] = "Per"; gunler_kisa[4] = "Cum"; gunler_kisa[5] = "Cmt"; gunler_kisa[6] = "Pzr";
function ay_gun_sayisi_bul(month, year) { var m = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; if (month != 2) return m[month - 1]; if (year % 4 != 0) return m[1]; if (year % 100 == 0 && year % 400 != 0) return m[1]; return m[1] + 1; }
var tarih = new Date(); var aktif_ay = tarih.getMonth(); var aktif_yil = tarih.getFullYear(); var bugun = tarih.getDate();
function takvim_olustur(){var takvim = ""; var ay_index = aktif_ay; tarih.setMonth(aktif_ay); tarih.setFullYear(aktif_yil);var gun = ay_gun_sayisi_bul(tarih.getMonth() + 1, tarih.getFullYear());var baslangic = tarih.getDay();baslangic = (7 - ((bugun - baslangic) % 7) + 1) % 7;if (baslangic == 0) baslangic = 7;if (aktif_ay < 0) ay_index = (aktif_ay + 13);takvim += "<table style=\"border-collapse:collapse;background:#fff;\"><tr class=\"takvim_baslik\"><td onclick=\"geri()\" colspan=\"1\" style=\"cursor:pointer;\"><</td><td colspan=\"5\">" + aylar[ay_index] + " - " + tarih.getFullYear() + "</td><td colspan=\"1\" onclick=\"ileri()\" style=\"cursor:pointer;\">></td></tr>";takvim += "<tr><td class=\"gun_adi\">" + gunler_kisa[0] + "</td><td class=\"gun_adi\">" + gunler_kisa[1] + "</td><td class=\"gun_adi\">" + gunler_kisa[2] + "</td><td class=\"gun_adi\">" + gunler_kisa[3] + "</td><td class=\"gun_adi\">" + gunler_kisa[4] + "</td><td class=\"gun_adi\">" + gunler_kisa[5] + "</td><td class=\"gun_adi\">" + gunler_kisa[6] + "</td></tr>";for (var i = 1; i < gun + 7; i = i + 7) {if (i < 7) {takvim += "<tr class=\"gun_no\">";for (var k = 1; k < baslangic; k++) {takvim += "<td> </td>";}for (var m = 1; m <= 7 - baslangic + 1; m++) {takvim += "<td><a onclick=\"tarih_al(" + aktif_yil + ", " + (aktif_ay + 1) + ", " + m + ")\">" + m + "</a></td>";}takvim += "</tr>";}else if (i > 7) {takvim += "<tr class=\"gun_no\">"; var adet = 0;for (var j = i - baslangic + 1; j < i + 8 - baslangic; j++) {if (j > gun) { break; }takvim += "<td><a onclick=\"tarih_al(" + aktif_yil + ", " + (aktif_ay + 1) + ", " + j + ")\">" + j + "</a></td>"; adet += 1;}if (adet < 7 && adet != 0)for (var t = 0; t < 7 - adet; t++) {takvim += "<td> </td>"};takvim += "</tr>";}}takvim += "</table>";return takvim;}
function ileri() { aktif_ay += 1; if (aktif_ay >= 12) { aktif_ay = aktif_ay % 12; aktif_yil += 1; } $("#TakvimAlan").html(takvim_olustur()); }
function geri() { if (aktif_ay == 0) { aktif_ay = 12; aktif_yil -= 1; } aktif_ay -= 1; $("#TakvimAlan").html(takvim_olustur()); }
function tarih_al(yil, ay, gun) {
    var trh = new Date();
    trh.setFullYear(yil, ay, gun);
    
    //var sonuc = trh.getFullYear() + "-" + trh.getMonth() + "-" + trh.getDate() + " " + trh.getHours() + ":" + trh.getMinutes() + ":" + trh.getSeconds(); /*mysql formatı*/
    var sonuc = trh.getDate()+"."+trh.getMonth()+"."+trh.getFullYear();  /*Burada tarih formatımızı kendimize göre ayarlayacağız*/
    
    AktifNesne.val(sonuc);
    (TakvimOpacity) ? ($("#TakvimAlan").animate({ marginTop: "-" + $("#TakvimAlani").height() + "px", opacity: "0" }, TakvimGorunmeZamani, function() { $("#TakvimAlani").remove(); })) : ($("#TakvimAlan").animate({ marginTop: "-" + $("#TakvimAlani").height() + "px" }, TakvimGorunmeZamani, function() { $("#TakvimAlani").remove(); }));
}
var AktifNesne, TakvimGorunmeZamani, TakvimOpacity;
(function($) {
    $.fn.Takvim = function(settings) {
        settings = $.extend({ event: "focus", Time: 1000, Opacity: true }, settings);
        return this.each(function() {
            $(this).bind(settings.event, function() {
                AktifNesne = $(this);
                TakvimGorunmeZamani = settings.Time;
                TakvimOpacity = settings.Opacity;
                var TakvimAlani = "<div id=\"TakvimAlani\"><div id=\"TakvimAlan\">" + takvim_olustur() + "</div><div>";
                $("#TakvimAlani").remove();
                $("body").append(TakvimAlani);
                $("#TakvimAlan").css("margin-top", "-" + $("#TakvimAlani").height() + "px");
                $("#TakvimAlani").css("left", AktifNesne.offset().left).css("top", AktifNesne.offset().top + AktifNesne.height() * 3 / 2);
                $("#TakvimAlani").show();
                (TakvimOpacity) ? ($("#TakvimAlan").css("opacity", "0").animate({ marginTop: "0", opacity: "1" }, TakvimGorunmeZamani)):($("#TakvimAlan").animate({ marginTop: "0" }, TakvimGorunmeZamani));
            });
        });
    }
})(jQuery);