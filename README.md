Заголовок и описание сайта меняются в файлах resources/text/header.txt и mainpage.txt соответственно

Поменять данные на свои в scripts/mysql.php ( 3-я строчка )
	user - имя пользователя
	password - пароль
	dbmane - имя базы данных


Команда для mysql:

CREATE TABLE orders (
	id INT AUTO_INCREMENT PRIMARY KEY,
	sername VARCHAR(80) NOT NULL,
	name VARCHAR(80) NOT NULL,
	patr VARCHAR(80),
	phone VARCHAR(80) NOT NULL,
	email VARCHAR(100),
	address VARCHAR(200) NOT NULL,
	date DATE NOT NULL,
	price FLOAT UNSIGNED NOT NULL,
	shopping_list TEXT NOT NULL
);