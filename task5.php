<?php

/*
Написать программу, которая будет считать максимальное количество последовательных “1” в массиве. Длина массива произвольная. Массив состоит только из 0 и 1.

Пример:
Входной массив: nums = [1,1,0,1,1,1]
Правильный ответ 3: первые две цифры или последние три цифры являются последовательными 1. Максимальное количество последовательных “1” это 3.
*/

function sequenceCount(array $arr): int
{
	$res = 0;

	$count = 0;
	foreach ($arr as $elem) {

		if ($elem === 1) {
			$count++;
		} else {
			if ($count !== 0) {
				$res = max($count, $res);
				$count = 0;
				if ($res >= count($arr)/2) {
					return $res;
				}
			}
		}
	}

	return max($count, $res);
}

$nums1 = [1,1,1,1,1,1,1]; //7
$nums2 = [0,0,0]; //0
$nums3 = [0,0,0,1,1,1,1,1,1,1]; //7
$nums4 = [1,1,1,0,0,0,1,1,1,0]; //3

var_dump(
	sequenceCount($nums1),
	sequenceCount($nums2),
	sequenceCount($nums3),
	sequenceCount($nums4),
);

/*
	int(7)
	int(0)
	int(7)
	int(3)
*/


