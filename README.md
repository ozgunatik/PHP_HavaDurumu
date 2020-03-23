# PHP Hava Durumu 

#### 1.Adım Bağlan Fonksiyonu

```sh
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
```

#### 2.Adım İl Kodları
Verileri alacağımız web sitesine bağlanırken kullanacağımız bir şehir kodu vardır. Bu şehir kodlarına  [buraya tıklayarak ](https://weather.codes/turkey/) ulaşabilirsiniz.
```sh
Ankara: TUXX0002
İstanbul: TUXX0014
İzmir: TUXX0015
Bursa: TUXX0039
Eskişehir: TUXX0040
```

#### 3.Adım Verileri Çekmek
Çekmek istediğiniz diğer verileri Copy outerHtml ile çekebilirsiniz. Bunun için küçük bir araştırma yapmanız yararınıza olacaktır.

```sh
$il = "TUXX0014"; /*Bandirma*/
$baglan = Baglan("https://weather.com/tr-TR/kisisel/bugun/l/".$il.":1:TU");
preg_match_all('#<p class="today_nowcard-timestamp">(.*?)</p>#si', $baglan, $saat);
preg_match_all('#<div class="today_nowcard-temp">(.*?)</div>#si', $baglan, $bugun);
preg_match_all('#<div class="today_nowcard-phrase">(.*?)</div>#si', $baglan, $durum);
preg_match_all('#<span class="deg-feels" className="deg-feels">(.*?)</span>#si', $baglan, $hissedilen);
```
#### 4.Adım Verileri İşlemek 
```sh
$saat = explode(":", strip_tags($saat[0][0]));
$saat = substr($saat[0], -2).":".substr($saat[1], 0, 2);
$derece = intval(strip_tags($bugun[0][0]))."°";
$durum = strip_tags($durum[0][0]);
$hissedilen = intval(strip_tags($hissedilen[0][0]))."°";
```
Verileri çektikten sonra göstermek istediğiniz yerde verilerinizi listeleyebilirsiniz. Şehirleri arrayList oluşturup istenilen şehirleride sıralabilirsiniz.


