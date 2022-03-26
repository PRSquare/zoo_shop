//
// Этот скрипт генерирует цвета на основе имени пользователя для отображения комментариев
//

var allCommens = document.getElementsByClassName('comment');
for(var i = 0; i < allCommens.length; ++i){
	var sum = 1;
	elem = allCommens[i].getElementsByClassName('comment_b')[0];
	str = elem.innerHTML; // Имя пользователя
	for(var j = 0; j < str.length; ++j){
		sum *= str[j].charCodeAt(0)-97 ? str[j].charCodeAt(0)-97 : 1; // Переводим char в int и суммируем все символы
	}
	sum *= sum; // Возводим получившуюся сумму в квадрат, чтобы увеличить разброс
	sum = sum%1912; // Ограничиваем максимальное значение до 0x777
	var color = sum.toString(16); // Переводим в строку в шестнадцатеричной системе счисления
	var diff = 3-color.length; // Если длинна строки меньше 3-х (получившееся число меньше 0x100 или 256)
	if( diff != 0 ){
		for(var j = 0; j < diff; ++j){
			color += '5'; // Добавляем нужное кол-во цифор 5 в конец строки
		}
	}
	elem.style = "color: #"+color+";"; // Устанавливаем цвет имени
}