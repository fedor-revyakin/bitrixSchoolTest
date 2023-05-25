<?php

/*
Выведи ассоциативный массив в обратном порядке без использования array_reverse()
*/

function assocReverse(array $assocArr): array {
	
	$temp = array_keys($assocArr);

	for ($i = count($temp) - 1; $i >= 0; $i--) {
		$res[$temp[$i]] = $assocArr[$temp[$i]];
	}

	return $res ?? [];
}

var_dump(assocReverse(["a" => 1, "b" => 2, "c" => 3]));

/*
Вывод:

	array(3) {
	  ["c"]=>
	  int(3)
	  ["b"]=>
	  int(2)
	  ["a"]=>
	  int(1)
}*/
