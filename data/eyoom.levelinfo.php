<?php
	if (!defined('_GNUBOARD_')) exit;
	$levelinfo = array(
		"1" => array("name" => "Level 1","min" => "0","max" => "20"),
		"2" => array("name" => "Level 2","min" => "20","max" => "60"),
		"3" => array("name" => "Level 3","min" => "60","max" => "120"),
		"4" => array("name" => "Level 4","min" => "120","max" => "200"),
		"5" => array("name" => "Level 5","min" => "200","max" => "300"),
		"6" => array("name" => "Level 6","min" => "300","max" => "420"),
		"7" => array("name" => "Level 7","min" => "420","max" => "560"),
		"8" => array("name" => "Level 8","min" => "560","max" => "720"),
		"9" => array("name" => "Level 9","min" => "720","max" => "900"),
		"10" => array("name" => "Level 10","min" => "900","max" => "1100"),
		"11" => array("name" => "Level 11","min" => "1100","max" => "1320"),
		"12" => array("name" => "Level 12","min" => "1320","max" => "1560"),
		"13" => array("name" => "Level 13","min" => "1560","max" => "1820"),
		"14" => array("name" => "Level 14","min" => "1820","max" => "2100"),
		"15" => array("name" => "Level 15","min" => "2100","max" => "2400"),
		"16" => array("name" => "Level 16","min" => "2400","max" => "2720"),
		"17" => array("name" => "Level 17","min" => "2720","max" => "3060"),
		"18" => array("name" => "Level 18","min" => "3060","max" => "3420"),
		"19" => array("name" => "Level 19","min" => "3420","max" => "3800"),
		"20" => array("name" => "Level 20","min" => "3800","max" => "4200"),
		"21" => array("name" => "Level 21","min" => "4200","max" => "4620"),
		"22" => array("name" => "Level 22","min" => "4620","max" => "5060"),
		"23" => array("name" => "Level 23","min" => "5060","max" => "5520"),
		"24" => array("name" => "Level 24","min" => "5520","max" => "6000"),
		"25" => array("name" => "Level 25","min" => "6000","max" => "6500"),
		"26" => array("name" => "Level 26","min" => "6500","max" => "7020"),
		"27" => array("name" => "Level 27","min" => "7020","max" => "7560"),
		"28" => array("name" => "Level 28","min" => "7560","max" => "8120"),
		"29" => array("name" => "Level 29","min" => "8120","max" => "8700"),
		"30" => array("name" => "Level 30","min" => "8700","max" => "9300"),
		"31" => array("name" => "Level 31","min" => "9300","max" => "9920"),
		"32" => array("name" => "Level 32","min" => "9920","max" => "10560"),
		"33" => array("name" => "Level 33","min" => "10560","max" => "11220"),
		"34" => array("name" => "Level 34","min" => "11220","max" => "11900"),
		"35" => array("name" => "Level 35","min" => "11900","max" => "12600"),
		"36" => array("name" => "Level 36","min" => "12600","max" => "13320"),
		"37" => array("name" => "Level 37","min" => "13320","max" => "14060"),
		"38" => array("name" => "Level 38","min" => "14060","max" => "14820"),
		"39" => array("name" => "Level 39","min" => "14820","max" => "15600"),
		"40" => array("name" => "Level 40","min" => "15600","max" => "16400"),
		"41" => array("name" => "Level 41","min" => "16400","max" => "17220"),
		"42" => array("name" => "Level 42","min" => "17220","max" => "18060"),
		"43" => array("name" => "Level 43","min" => "18060","max" => "18920"),
		"44" => array("name" => "Level 44","min" => "18920","max" => "19800"),
		"45" => array("name" => "Level 45","min" => "19800","max" => "20700"),
		"46" => array("name" => "Level 46","min" => "20700","max" => "21620"),
		"47" => array("name" => "Level 47","min" => "21620","max" => "22560"),
		"48" => array("name" => "Level 48","min" => "22560","max" => "23520"),
		"49" => array("name" => "Level 49","min" => "23520","max" => "24500"),
		"50" => array("name" => "Level 50","min" => "24500","max" => "25500"),
		"51" => array("name" => "Level 51","min" => "25500","max" => "26520"),
		"52" => array("name" => "Level 52","min" => "26520","max" => "27560"),
		"53" => array("name" => "Level 53","min" => "27560","max" => "28620"),
		"54" => array("name" => "Level 54","min" => "28620","max" => "29700"),
		"55" => array("name" => "Level 55","min" => "29700","max" => "30800"),
		"56" => array("name" => "Level 56","min" => "30800","max" => "31920"),
		"57" => array("name" => "Level 57","min" => "31920","max" => "33060"),
		"58" => array("name" => "Level 58","min" => "33060","max" => "34220"),
		"59" => array("name" => "Level 59","min" => "34220","max" => "35400"),
		"60" => array("name" => "Level 60","min" => "35400","max" => "36600"),
		"61" => array("name" => "Level 61","min" => "36600","max" => "37820"),
		"62" => array("name" => "Level 62","min" => "37820","max" => "39060"),
		"63" => array("name" => "Level 63","min" => "39060","max" => "40320"),
		"64" => array("name" => "Level 64","min" => "40320","max" => "41600"),
		"65" => array("name" => "Level 65","min" => "41600","max" => "42900"),
		"66" => array("name" => "Level 66","min" => "42900","max" => "44220"),
		"67" => array("name" => "Level 67","min" => "44220","max" => "45560"),
		"68" => array("name" => "Level 68","min" => "45560","max" => "46920"),
		"69" => array("name" => "Level 69","min" => "46920","max" => "48300"),
		"70" => array("name" => "Level 70","min" => "48300","max" => "49700"),
		"71" => array("name" => "Level 71","min" => "49700","max" => "51120"),
		"72" => array("name" => "Level 72","min" => "51120","max" => "52560"),
		"73" => array("name" => "Level 73","min" => "52560","max" => "54020"),
		"74" => array("name" => "Level 74","min" => "54020","max" => "55500"),
		"75" => array("name" => "Level 75","min" => "55500","max" => "57000"),
		"76" => array("name" => "Level 76","min" => "57000","max" => "58520"),
		"77" => array("name" => "Level 77","min" => "58520","max" => "60060"),
		"78" => array("name" => "Level 78","min" => "60060","max" => "61620"),
		"79" => array("name" => "Level 79","min" => "61620","max" => "63200"),
		"80" => array("name" => "Level 80","min" => "63200","max" => "64800"),
		"81" => array("name" => "Level 81","min" => "64800","max" => "66420"),
		"82" => array("name" => "Level 82","min" => "66420","max" => "68060"),
		"83" => array("name" => "Level 83","min" => "68060","max" => "69720"),
		"84" => array("name" => "Level 84","min" => "69720","max" => "71400"),
		"85" => array("name" => "Level 85","min" => "71400","max" => "73100"),
		"86" => array("name" => "Level 86","min" => "73100","max" => "74820"),
		"87" => array("name" => "Level 87","min" => "74820","max" => "76560"),
		"88" => array("name" => "Level 88","min" => "76560","max" => "78320"),
		"89" => array("name" => "Level 89","min" => "78320","max" => "80100"),
		"90" => array("name" => "Level 90","min" => "80100","max" => "81900"),
		"91" => array("name" => "Level 91","min" => "81900","max" => "83720"),
		"92" => array("name" => "Level 92","min" => "83720","max" => "85560"),
		"93" => array("name" => "Level 93","min" => "85560","max" => "87420"),
		"94" => array("name" => "Level 94","min" => "87420","max" => "89300"),
		"95" => array("name" => "Level 95","min" => "89300","max" => "91200"),
		"96" => array("name" => "Level 96","min" => "91200","max" => "93120"),
		"97" => array("name" => "Level 97","min" => "93120","max" => "95060"),
		"98" => array("name" => "Level 98","min" => "95060","max" => "97020"),
		"99" => array("name" => "Level 99","min" => "97020","max" => "99000"),
		"100" => array("name" => "Level 100","min" => "99000","max" => "101000"),
		"101" => array("name" => "Level 101","min" => "101000","max" => "103020"),
		"102" => array("name" => "Level 102","min" => "103020","max" => "105060"),
		"103" => array("name" => "Level 103","min" => "105060","max" => "107120"),
		"104" => array("name" => "Level 104","min" => "107120","max" => "109200"),
		"105" => array("name" => "Level 105","min" => "109200","max" => "111300"),
		"106" => array("name" => "Level 106","min" => "111300","max" => "113420"),
		"107" => array("name" => "Level 107","min" => "113420","max" => "115560"),
		"108" => array("name" => "Level 108","min" => "115560","max" => "117720"),
		"109" => array("name" => "Level 109","min" => "117720","max" => "119900"),
		"110" => array("name" => "Level 110","min" => "119900","max" => "122100"),
		"111" => array("name" => "Level 111","min" => "122100","max" => "124320"),
	);
?>