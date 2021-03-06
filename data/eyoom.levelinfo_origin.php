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
		"31" => array("name" => "Level 31","min" => "93000","max" => "99200"),
		"32" => array("name" => "Level 32","min" => "99200","max" => "105600"),
		"33" => array("name" => "Level 33","min" => "105600","max" => "112200"),
		"34" => array("name" => "Level 34","min" => "112200","max" => "119000"),
		"35" => array("name" => "Level 35","min" => "119000","max" => "126000"),
		"36" => array("name" => "Level 36","min" => "126000","max" => "133200"),
		"37" => array("name" => "Level 37","min" => "133200","max" => "140600"),
		"38" => array("name" => "Level 38","min" => "140600","max" => "148200"),
		"39" => array("name" => "Level 39","min" => "148200","max" => "156000"),
		"40" => array("name" => "Level 40","min" => "156000","max" => "164000"),
		"41" => array("name" => "Level 41","min" => "164000","max" => "172200"),
		"42" => array("name" => "Level 42","min" => "172200","max" => "180600"),
		"43" => array("name" => "Level 43","min" => "180600","max" => "189200"),
		"44" => array("name" => "Level 44","min" => "189200","max" => "198000"),
		"45" => array("name" => "Level 45","min" => "198000","max" => "207000"),
		"46" => array("name" => "Level 46","min" => "207000","max" => "216200"),
		"47" => array("name" => "Level 47","min" => "216200","max" => "225600"),
		"48" => array("name" => "Level 48","min" => "225600","max" => "235200"),
		"49" => array("name" => "Level 49","min" => "235200","max" => "245000"),
		"50" => array("name" => "Level 50","min" => "245000","max" => "255000"),
		"51" => array("name" => "Level 51","min" => "255000","max" => "265200"),
		"52" => array("name" => "Level 52","min" => "265200","max" => "275600"),
		"53" => array("name" => "Level 53","min" => "275600","max" => "286200"),
		"54" => array("name" => "Level 54","min" => "286200","max" => "297000"),
		"55" => array("name" => "Level 55","min" => "297000","max" => "308000"),
		"56" => array("name" => "Level 56","min" => "308000","max" => "319200"),
		"57" => array("name" => "Level 57","min" => "319200","max" => "330600"),
		"58" => array("name" => "Level 58","min" => "330600","max" => "342200"),
		"59" => array("name" => "Level 59","min" => "342200","max" => "354000"),
		"60" => array("name" => "Level 60","min" => "354000","max" => "366000"),
		"61" => array("name" => "Level 61","min" => "366000","max" => "378200"),
		"62" => array("name" => "Level 62","min" => "378200","max" => "390600"),
		"63" => array("name" => "Level 63","min" => "390600","max" => "403200"),
		"64" => array("name" => "Level 64","min" => "403200","max" => "416000"),
		"65" => array("name" => "Level 65","min" => "416000","max" => "429000"),
		"66" => array("name" => "Level 66","min" => "429000","max" => "442200"),
		"67" => array("name" => "Level 67","min" => "442200","max" => "455600"),
		"68" => array("name" => "Level 68","min" => "455600","max" => "469200"),
		"69" => array("name" => "Level 69","min" => "469200","max" => "483000"),
		"70" => array("name" => "Level 70","min" => "483000","max" => "497000"),
		"71" => array("name" => "Level 71","min" => "497000","max" => "511200"),
		"72" => array("name" => "Level 72","min" => "511200","max" => "525600"),
		"73" => array("name" => "Level 73","min" => "525600","max" => "540200"),
		"74" => array("name" => "Level 74","min" => "540200","max" => "555000"),
		"75" => array("name" => "Level 75","min" => "555000","max" => "570000"),
		"76" => array("name" => "Level 76","min" => "570000","max" => "585200"),
		"77" => array("name" => "Level 77","min" => "585200","max" => "600600"),
		"78" => array("name" => "Level 78","min" => "600600","max" => "616200"),
		"79" => array("name" => "Level 79","min" => "616200","max" => "632000"),
		"80" => array("name" => "Level 80","min" => "632000","max" => "648000"),
		"81" => array("name" => "Level 81","min" => "648000","max" => "664200"),
		"82" => array("name" => "Level 82","min" => "664200","max" => "680600"),
		"83" => array("name" => "Level 83","min" => "680600","max" => "697200"),
		"84" => array("name" => "Level 84","min" => "697200","max" => "714000"),
		"85" => array("name" => "Level 85","min" => "714000","max" => "731000"),
		"86" => array("name" => "Level 86","min" => "731000","max" => "748200"),
		"87" => array("name" => "Level 87","min" => "748200","max" => "765600"),
		"88" => array("name" => "Level 88","min" => "765600","max" => "783200"),
		"89" => array("name" => "Level 89","min" => "783200","max" => "801000"),
		"90" => array("name" => "Level 90","min" => "801000","max" => "819000"),
		"91" => array("name" => "Level 91","min" => "819000","max" => "837200"),
		"92" => array("name" => "Level 92","min" => "837200","max" => "855600"),
		"93" => array("name" => "Level 93","min" => "855600","max" => "874200"),
		"94" => array("name" => "Level 94","min" => "874200","max" => "893000"),
		"95" => array("name" => "Level 95","min" => "893000","max" => "912000"),
		"96" => array("name" => "Level 96","min" => "912000","max" => "931200"),
		"97" => array("name" => "Level 97","min" => "931200","max" => "950600"),
		"98" => array("name" => "Level 98","min" => "950600","max" => "970200"),
		"99" => array("name" => "Level 99","min" => "970200","max" => "990000"),
		"100" => array("name" => "Level 100","min" => "990000","max" => "1010000"),
		"101" => array("name" => "Level 101","min" => "1010000","max" => "1030200"),
		"102" => array("name" => "Level 102","min" => "1030200","max" => "1050600"),
		"103" => array("name" => "Level 103","min" => "1050600","max" => "1071200"),
		"104" => array("name" => "Level 104","min" => "1071200","max" => "1092000"),
		"105" => array("name" => "Level 105","min" => "1092000","max" => "1113000"),
	);
?>