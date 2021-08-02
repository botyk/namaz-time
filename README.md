## Время намаза (muftyat.kz)

[https://namaz.muftyat.kz/kk/namaz/api/](https://namaz.muftyat.kz/kk/namaz/api/)

-----------------------------------------

```php
$lat = '43.238293'; // Широта
$lon = '76.945465'; // Долгота

$nt = new namazTime($lat, $lon);

// На сегодня
$data = $nt->getToday();

// На год
$data = $nt->getYear();

// Список городов казахстана
$data = namazTime::getCites();

echo '<pre>';
print_r($data);
```
