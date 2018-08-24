<?php 

    // To add a column to an existing table the syntax would be:
    // mysql_query("ALTER TABLE birthdays ADD street CHAR(30)");
    
    // You can also specify where you want to add the field.
    // mysql_query("ALTER TABLE birthdays ADD street CHAR(30) AFTER birthday");
    /*
    mysql_query("ALTER TABLE birthdays
ADD street CHAR(30) AFTER birthday,
Add city CHAR(30) AFTER street,
ADD state CHAR(4) AFTER city,
ADD zipcode CHAR(20) AFTER state,
ADD phone CHAR(20) AFTER zipcode");
*/

/*
Column definitions can be modified using the ALTER method. The following code would change the existing birthday column from 7 to 15 characters.

    mysql_query("ALTER TABLE birthdays CHANGE birthday birthday VARCHAR(15)");
*/

/*
Columns can be removed from an existing table. The next example of code would remove the lastname column.
mysql_query("ALTER TABLE birthdays DROP lastname");
*/

    // TODO: чи видно змінні з одного плагіну в іншому?
    
    require_once 'plugin_database.php';
    
    
    if (isset($_POST['action'])) {
        
        // Дія updateConfig:
        if ($_POST['action'] == 'updateConfig') {
            
            // update in db:
            $array = array(
                "UPDATE" => $moneytablesArray[3],
                "SET" => array(
                    "moneyUAH" => $_POST['uah'],
                    "moneyUSD" => $_POST['usd'],
                    "uahToUsd" => $_POST['uahtousd'],
                    "usdToUah" => $_POST['usdtouah'],
                )
            );
                    
            $db->update($array); 
            
            $link = $pluginConfigUrl."&plugin_config=money_config";
            
            header ("Location: $link");
            exit();
            
        }
    }
    
    
    $moneyCategory = array (
		0 => 'невідомо', 
		1 => 'їжа', 
		2 => 'одяг', 
		3 => 'речі', 
		4 => 'книги', 
		5 => 'транспорт', // бензин, запчастини, маршрутка
		6 => 'догляд', 
		7 => 'бізнес', // будь-які вкладення, навіть оплата хостингу і домену
		8 => 'рахунки', // оренда квартири, світло, газ, інтернет
		9 => 'відклав', // оренда квартири, світло, газ, інтернет
		50 => 'прибуток'
	);
    
    $monthNames = array (
		'01' => 'січ', 
		'02' => 'лют', 
		'03' => 'бер', 
		'04' => 'кві', 
		'05' => 'тра', 
		'06' => 'чер',
		'07' => 'лип', 
		'08' => 'сер', 
		'09' => 'вер', 
		'10' => 'жов', 
		'11' => 'лис', 
		'12' => 'гру'
	);
    
    /*
        $array = array(
            "INSERT INTO" => 'usp_vladMoneyCategory',
            "COLUMNS" => array(
                "categoryID" => $key,
                "categoryName" => $value
            )
        );
        
        $db->insert($array);
*/


