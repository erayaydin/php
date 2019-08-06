<?php

$cards = [];

$csv = array_map('str_getcsv', file('text.txt'));

foreach($csv as $item){
	$bin = $item[0];
	$bank = $item[2];
	$card = $item[3];
	$type = $item[4];

	$banks = [
		"T.C. ZİRAAT BANKASI A.Ş." => "ziraat",
		"T. HALK BANKASI A.Ş." => "halkbank",
		"T. VAKIFLAR BANKASI T.A.O." => "vakifbank",
		"TÜRK EKONOMİ BANKASI A.Ş." => "teb",
		"AKBANK T.A.Ş." => "akbank",
		"ŞžEKERBANK T.A.Ş." => "sekerbank",
		"T. GARANTİ BANKASI A.Ş." => "garanti",
		"T. İŞ BANKASI A.Ş." => "isbank",
		"YAPI ve KREDİ BANKASI A.Ş." => "yapikredi",
		"FORTIS BANK A.Ş." => "fortis",
		"CITIBANK A.Ş." => "citibank",
		"TURKISH BANK A.Ş." => "turkishbank",
		"ING BANK A.Ş." => "ingbank",
		"MILLENNIUM BANK A.Ş." => "millennium",
		"TURKLAND BANK A.Ş." => "turkland",
		"FİNANS BANK A.Ş." => "finansbank",
		"HSBC BANK A.Ş." => "hsbc",
		"EUROBANK TEKFEN A.Ş." => "eurobank",
		"DENİZBANK A.Ş." => "denizbank",
		"ANADOLUBANK A.Ş." => "anadolubank",
		"ALBARAKA TÜRK KATILIM BANKASI A.Ş." => "albaraka",
		"KUVEYT TÜRK KATILIM BANKASI A.Ş." => "kuveytturk",
		"TÜRKİYE FİNANS KATILIM BANKASI A.Ş." => "turkiyefinans",
		"ASYA KATILIM BANKASI A.Ş." => "bankasya",
		"PROVUS BİLİŞİM " => "provus",
	];

	$cards[$item[0]] = [
		"bank" => $banks[$item[2]],
		"card" => strtolower($item[3]),
		"type" => strtolower($item[4]),
	];
}

$f = fopen("banks.json", "w+");
fwrite($f, json_encode($cards));
fclose($f);
