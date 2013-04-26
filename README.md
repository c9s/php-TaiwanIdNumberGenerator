Taiwan ID Number Generator
==========================

```php
$generator = new CornelTek\TaiwanIdNumberGenerator;

$idNumber = $generator->generate();
$idNumber = $generator->generate("台中縣");
$idNumber = $generator->generate("台中縣","female");
$idNumber = $generator->generate("台中縣","male","1234567");

foreach( range(1,10) as $i ) {
    $idNumber = $generator->generateUnique();
    echo $idNumber, "\n";
}
```


