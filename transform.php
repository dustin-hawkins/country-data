<?php

$csv = array_map('str_getcsv', file('countries.csv'));
$headers = array_shift($csv);
$currencies = json_decode(file_get_contents('currencies.json'), true);
$json = [];

foreach ($csv as $row) {
   $countryCode = strtolower($row[1]);
   $currencyCode = strtoupper($row[3]);
   
   $json[$countryCode] = [
       'countryCode' => strtoupper($row[1]),
       'currencyCode' => $currencyCode,
       'currencySymbol' => $currencies[$currencyCode]['symbol_native'] ?? $currencyCode,
       'name' => $row[0],
       'currencyName' => $row[2],
       'currencyNamePlural' => $currencies[$currencyCode]['name_plural'] ?? $row[2],
       'currencyDecimalDigits' =>  $currencies[$currencyCode]['decimal_digits'] ?? 2,
       'currencyRounding' =>  $currencies[$currencyCode]['rounding'] ?? 0,
       'numericCurrencyCode' => $row[3],
       
   ];
}

echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
