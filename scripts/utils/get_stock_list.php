<?php
	/* 
			Функция для получения строк - аргументов функции safety_db_query() при использовании массива
		Функция safety_db_query() принемает в качестве второго аргумента sql запрос, где вместо похже подставляемых 
		данных стоят знаки вопроса ("?"). В качестве третьего аргумента - строку с типом передаваемых данных 
		(i, c, s, d - int, char, string, double соответственно). Далее предаются переменные, в которых находятся
		данные. Функция getStringsFromArray возвращает строки для дальнейшей подстановки в функцию safety_db_query 
		в формате ["qm"=>"?, ?, ?", 'iii'] сформированных на основе массива, переданного в первом аргументе и, при 
		необходимости, символа типа данных (второй аргумент. По умолчанию 'i')
	*/
	function getStringsFromArray( $array, $dtype = 'i' ){
		$retstr = ['qm', 'i']; // Возвращаемая строка
		$retstr['qm'] = '';
		$retstr['i'] = '';
		foreach($array as $a){
			$retstr['qm'] = $retstr['qm'].'?, ';
			$retstr['i'] = $retstr['i'].$dtype;
		}
		$retstr['qm'] = substr($retstr['qm'], 0, -2); // Удаление пробела и запятой с конца
		return $retstr;
	}
	
	// Функция для полечения списка акций, доступных пользователю
	function get_stock_list($user_id, $db_link){
		$user_stocks = safety_db_query($db_link, "SELECT stock_id FROM personal_stocks WHERE user_id = ?", 'i', $user_id); // Список id всех акций, доступных пользователю
		$user_stock_formated = []; // Форматированный список id акций
		foreach ($user_stocks as $us) {
			$user_stock_formated[] = $us['stock_id'];
		}
		$dtStr = getStringsFromArray($user_stock_formated);
		$stock_list = [];
		if($user_stock_formated != [])
			$stock_list = safety_db_query($db_link, "SELECT * FROM stocks WHERE id IN (".$dtStr['qm'].") ORDER BY discount_size", $dtStr['i'], ...$user_stock_formated); // Получение списка акций
		return $stock_list;
	}
?>