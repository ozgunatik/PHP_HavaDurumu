 <?php 

function Baglan($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
	$cikti = curl_exec($curl);
	curl_close($curl);
	return $cikti;}

	$il = "TUXX0038";

	$baglan = Baglan("https://weather.com/tr-TR/kisisel/bugun/l/".$il.":1:TU");
	preg_match_all('#<p class="today_nowcard-timestamp">(.*?)</p>#si', $baglan, $saat);
	preg_match_all('#<div class="today_nowcard-temp">(.*?)</div>#si', $baglan, $bugun);
	preg_match_all('#<div class="today_nowcard-phrase">(.*?)</div>#si', $baglan, $durum);
	preg_match_all('#<span class="deg-feels" className="deg-feels">(.*?)</span>#si', $baglan, $hissedilen);
	preg_match_all('#<h1 class="h4 today_nowcard-location" classname="h4 today_nowcard-location">(.*?)</h1>#si', $baglan, $image);
	preg_match_all('#<span>(.*?)<span class="Percentage__percentSymbol__2Q_AR">%</span></span>#si', $baglan, $nem);


	$saat = explode(":", strip_tags($saat[0][0]));
	$saat = substr($saat[0], -2).":".substr($saat[1], 0, 2);
	$derece = intval(strip_tags($bugun[0][0]))."°";
	$durum = strip_tags($durum[0][0]);
	$hissedilen = intval(strip_tags($hissedilen[0][0]))."°";
	$sehir = strip_tags($image[0][0]);
	$nem = strip_tags($nem[0][6]);

	echo $nem . $saat ;

?>