# PHP_HavaDurumu
PHP ile Hava Durumunu Projemize Eklemek 

Bağlan Fonksiyonumuz

PHP ile Hava Durumunu Çekme | KodAdasi.COM

Bağlan Fonksiyonumuz

function Baglan($url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
	$cikti = curl_exec($curl);
	curl_close($curl);
	return $cikti;
}

Verileri alacağımız web sitesine bağlanırken kullanacağımız bir şehir kodu vardır. Bu şehir kodlarına buraya tıklayarak ulaşabilirsiniz.
https://weather.codes/turkey/

Ankara: TUXX0002
İstanbul: TUXX0014
İzmir: TUXX0015
Bursa: TUXX0039
Eskişehir: TUXX0040
...
Kod yapımızda ise bir $il değişkeni oluşturup kodu tanımlamalıyız;

$il = "TUXX0038";

3. Adım: Verileri Çekmek
Verileri temel halde çekmek için bu kodu kullanacağız;

$baglan = Baglan("https://weather.com/tr-TR/kisisel/bugun/l/".$il.":1:TU");
preg_match_all('#<p class="today_nowcard-timestamp">(.*?)</p>#si', $baglan, $saat);
preg_match_all('#<div class="today_nowcard-temp">(.*?)</div>#si', $baglan, $bugun);
preg_match_all('#<div class="today_nowcard-phrase">(.*?)</div>#si', $baglan, $durum);
preg_match_all('#<span class="deg-feels" className="deg-feels">(.*?)</span>#si', $baglan, $hissedilen);Kodu Kopyala
4. Adım: Verileri İşlemek
Gelen verileri doğru değişkenlere ve doğru halleri ile aktarmak için kullanacağız;

$saat = explode(":", strip_tags($saat[0][0]));
$saat = substr($saat[0], -2).":".substr($saat[1], 0, 2);
$derece = intval(strip_tags($bugun[0][0]))."°";
$durum = strip_tags($durum[0][0]);
$hissedilen = intval(strip_tags($hissedilen[0][0]))."°";

