<?php 
    
    require_once 'plugin_database.php';

    $className = basename(pathinfo(__FILE__)['dirname']);
    $tmpObj = new $className; 
    
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
    
    
    
    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {
        
        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == basename(pathinfo(__FILE__)['dirname'])) {
            
            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {
                
                ##############################################
                
                // Дія updateConfig:
                if ($_POST['action'] == 'updateConfig') {
                    
                    // update in db:
                    $array = array(
                        "UPDATE" => $tmpObj->tablesNames[3],
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
                    
                } // <-- Дія updateConfig
                
                ##############################################
                
                // Дія changeUAH: 
                else if ($_POST['action'] == 'changeUAH') {
                    
                    // Дізнаюсь параметри готівки:
                    $array = array(
                        "SELECT" => "*",
                        "FROM" => $tmpObj->tablesNames[3]
                    );
                    $moneyParams = $db->select($array, null); 
                    
                    // якщо це прибуток:
                    if ($_POST['category'][0] == 50) {
                        $operationType = 2;
                    } else {
                        // якщо видатки:
                        $operationType = 1;
                    }
                    
                    // Вставляю в базу нову витратну операцію:
                    $array = array(
                        "INSERT INTO" => $tmpObj->tablesNames[0],
                        "COLUMNS" => array(
                            "money" => $_POST['sum'],
                            "operation" => $operationType,
                            "category" => $_POST['category'][0],
                            "date" => date('Y-m-d H:i:s'),
                        )
                    );
                    $db->insert($array);
                    
                    // Витрати:
                    if ($operationType == 1) {

                        // Оновляю готівку у базі даних:
                        $newMoney = $moneyParams[0]['moneyUAH'] - $_POST['sum'];
                        
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[3],
                            "SET" => array(
                                "moneyUAH" => $newMoney,
                            )
                        );
                                
                        $db->update($array); 
                        
                        
               
                    } else if ($operationType == 2) {
                        // прибуток:

                        // Оновляю готівку у базі даних:
                        $newMoney = $moneyParams[0]['moneyUAH'] + $_POST['sum'];
                        
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[3],
                            "SET" => array(
                                "moneyUAH" => $newMoney,
                            )
                        );
                                
                        $db->update($array); 

                    }
                    
                    // Редірект на список операцій в цьому місяці:
                    $link = $pluginConfigUrl."&year=".date('Y')."&month=".date('m');
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія changeUAH: 
                
                ##############################################
                
                // Дія changeUSD: 
                else if ($_POST['action'] == 'changeUSD') {
                    
                    // Дізнаюсь параметри готівки:
                    $array = array(
                        "SELECT" => "*",
                        "FROM" => $tmpObj->tablesNames[3]
                    );
                    $moneyParams = $db->select($array, null); 
                    
                    // якщо це прибуток:
                    if ($_POST['category'][0] == 50) {
                        $operationType = 2;
                    } else {
                        // якщо видатки:
                        $operationType = 1;
                    }
                    
                    // Вставляю в базу нову витратну операцію:
                    $array = array(
                        "INSERT INTO" => $tmpObj->tablesNames[1],
                        "COLUMNS" => array(
                            "money" => $_POST['sum'],
                            "operation" => $operationType,
                            "category" => $_POST['category'][0],
                            "date" => date('Y-m-d H:i:s'),
                        )
                    );
                    $db->insert($array);
                    
                    // Витрати:
                    if ($operationType == 1) {

                        // Оновляю USD у базі даних:
                        $newMoney = $moneyParams[0]['moneyUSD'] - $_POST['sum'];
                        
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[3],
                            "SET" => array(
                                "moneyUSD" => $newMoney,
                            )
                        );
                                
                        $db->update($array); 
                        
                        
               
                    } else if ($operationType == 2) {
                        // прибуток:

                        // Оновляю USD у базі даних:
                        $newMoney = $moneyParams[0]['moneyUSD'] + $_POST['sum'];
                        
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[3],
                            "SET" => array(
                                "moneyUSD" => $newMoney,
                            )
                        );
                                
                        $db->update($array); 

                    }
                    
                    // Редірект на список операцій в цьому місяці:
                    $link = $pluginConfigUrl."&show=usd";
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія changeUSD: 
                
                ##############################################
                
                // Дія editUAHoperation: 
                else if ($_POST['action'] == 'editUAHoperation') {
                    // оновляю операцію:
                    if (isset($_POST['update'])) {
                        
                        // якщо це прибуток:
                        if ($_POST['category'][0] == 50) {
                            $operationType = 2;
                        } else {
                            // якщо видатки:
                            $operationType = 1;
                        }
                        
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[0],
                            "SET" => array(
                                "money" => $_POST['money'],
                                "category" => $_POST['category'][0],
                                "operation" => $operationType,
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            )
                        );
                        
                        $db->update($array); 
                        
                    } else if (isset($_POST['delete'])) {
                        // видаляю операцію:
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[0],
                            "SET" => array(
                                "moderation" => 1,
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            )
                        );
                        
                        $db->update($array); 
                    }
                    
                    // Редірект на список операцій в цьому місяці:
                    $link = $pluginConfigUrl."&year=".$_POST['year']."&month=".$_POST['month'];
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія editUAHoperation: 

                ##############################################
                
                // Дія editUSDoperation: 
                else if ($_POST['action'] == 'editUSDoperation') {
                    // оновляю операцію:
                    if (isset($_POST['update'])) {
                        
                        // якщо це прибуток:
                        if ($_POST['category'][0] == 50) {
                            $operationType = 2;
                        } else {
                            // якщо видатки:
                            $operationType = 1;
                        }
                        
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[1],
                            "SET" => array(
                                "money" => $_POST['money'],
                                "category" => $_POST['category'][0],
                                "operation" => $operationType,
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            )
                        );
                        
                        $db->update($array); 
                        
                    } else if (isset($_POST['delete'])) {
                        // видаляю операцію:
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[1],
                            "SET" => array(
                                "moderation" => 1,
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            )
                        );
                        
                        $db->update($array); 
                    }
                    
                    // Редірект:
                    $link = $pluginConfigUrl."&show=usd";
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія editUSDoperation: 
                
                ##############################################
                
                // Дія editWish: 
                else if ($_POST['action'] == 'editWish') {
                    // оновляю операцію:
                    if (isset($_POST['update'])) {
                        // оновляю інформацію про бажання:
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[4],
                            "SET" => array(
                                "wishName" => $_POST['wishName'],
                                "wishCategory" => $_POST['category'][0],
                                "wishPrice" => $_POST['wishPrice'],
                                "done" => $_POST['done'][0],
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            )
                        );
                        
                        $db->update($array); 
                        
                    } else if (isset($_POST['delete'])) {
                        // видаляю операцію:
                        $array = array(
                            "UPDATE" => $tmpObj->tablesNames[4],
                            "SET" => array(
                                "done" => 2,
                            ),
                            "WHERE" => array(
                                "ID" => $_POST['ID']
                            )
                        );
                        
                        $db->update($array); 
                    }
                    
                    // Редірект:
                    $link = $pluginConfigUrl."&show=wishlist";
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія editWish:
                
                ##############################################
                
                // Дія eaddWish: 
                else if ($_POST['action'] == 'addWish') {
 
                    // Вставляю в базу нове бажання:
                    $array = array(
                        "INSERT INTO" => $tmpObj->tablesNames[4],
                        "COLUMNS" => array(
                            "wishName" => $_POST['wishName'],
                            "wishCategory" => $_POST['category'][0],
                            "wishPrice" => $_POST['wishPrice'],
                        )
                    );
                    $db->insert($array);
                    
                    // Редірект:
                    $link = $pluginConfigUrl."&show=wishlist";
                    header ("Location: $link");
                    exit();
                    
                } // <-- Дія addWish:
                
                
            } // <-- кінець виконання дій
        } // <-- кінець перевірки папки плагіну
    } // <-- кінець перевірки запиту до плагіну
    
    