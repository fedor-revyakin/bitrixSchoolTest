<?php

/*
Чему должен быть равен $a, чтобы условие вернуло true.
*/

$a = true;
if ($a == 1 && $a == 2 && $a == 3) {
	print("\$a = true\n");
}

/*
Чтобы условие выполнилось, нужно преобразование вторых операндов в тип bool (1, 2 и 3 преобразуются в значение true). Преобразование второго операнда к bool выполнится если тип первого операнда bool (https://www.php.net/manual/ru/language.operators.comparison.php#language.operators.comparison.types).
*/
