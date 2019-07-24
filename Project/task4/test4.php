<?php
	$host="localhost";
	$user="root";
	$password="111";
	$dbname="test";
	echo 'test';
	$mysqli = new mysqli($host,$user,$password,$dbname);
	if ($mysqli->connect_errno) {
	    echo "Ошибка: Не удалсь создать соединение с базой MySQL и вот почему: <br>";
		echo "Номер_ошибки: " . $mysqli->connect_errno . "<br>";
		echo "Ошибка: " . $mysqli->connect_error . "<br>";
		exit;
	}
	$mysqli->set_charset("cp1251");
	$queryCreateTable = "CREATE TABLE IF NOT EXISTS `bills_ru_events` (`id` INT  NOT NULL AUTO_INCREMENT,`date` DATETIME NOT NULL,`title` VARCHAR(230) NOT NULL,`url` VARCHAR(240) NOT NULL UNIQUE, PRIMARY KEY(`id`)) ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";
	$mysqli->query($queryCreateTable);
	
	include 'html_parse.php';
	$html = file_get_html('https://bills.ru/');
	
	if($html && is_object($html) && isset($html->nodes)){
            foreach ($html->find('table[id=bizon_api_news_list]',0)->find('td[class="news_date"]') as $el) {
                foreach ($el as $date) {
                    $date_db = normal_date($date->innertext);
                    $href = $date->next_sibling()->find('a');
                    $mysqli->query("INSERT INTO `test`.`bills_ru_events` (`date`, `title`, `url`) VALUES ('".date('Y-m-d H:i:s', $date_db)."', '$href->innertext', '$href->href')");
                }
            }
	}
	
	function normal_date($date){
		$monthes = ["янв" => "1", "фев" => "2", "мар" => "3", "апр" => "4", "май" => "5",
		"июн" => "6", "июл" => "7", "авг" => "8", "сен" => "9", "окт" => "10", "ноя" => "11", "дек" => "12"];
		
		$date_elements = explode(' ', $date);
		return mktime(0, 0, 0, $monthes[$date_elements[1]] , $date_elements[0], $date_elements[2]);
	}
?>