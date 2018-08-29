<?php 

    require_once 'top.php';      

    $array = array(
        "SELECT" => "*",
        "FROM" => $moneytablesArray[0],
        "ORDER" => "ID",
        "SORT" => "DESC"
    );
    $allOperations = $db->select($array); 

    $array = array(
        "SELECT" => "*",
        "FROM" => $moneytablesArray[2],
        "WHERE" => "moderation = 0"
    );
    $allCategoryArray = $db->select($array);
    
    
    
    $allCategory = array();
    
    foreach ($allCategoryArray as $key => $value) {
        $allCategory[$value['categoryID']] = $value['categoryName'];
    }
        
    # Сумарна статистика
    $yearStat = array();

    foreach ($allOperations as $opID => $opreationArray) {
        
        //print_r($opreationArray);
        $dateparts = explode('-',$opreationArray['date']);
        
        // якщо статистика по року ще не була записана в масив, то створюю:
        if(!isset($yearStat[$dateparts[0]])) {
            $yearStat[$dateparts[0]] = array(
                'profit' => 0,
                'expenses' => 0,
                'categories' => $allCategory
            );
            foreach ($yearStat[$dateparts[0]]['categories'] as $catID => $catValue) {
                $yearStat[$dateparts[0]]['categories'][$catID] = 0;
            }
        }
        // якщо вже є цей рік у масиві, то додаю нові значення:
        if($opreationArray['operation'] == 2) {
            $yearStat[$dateparts[0]]['profit'] += $opreationArray['money'];
            $yearStat[$dateparts[0]]['categories'][$opreationArray['category']] += $opreationArray['money'];
        } else if($opreationArray['operation'] == 1) {
            $yearStat[$dateparts[0]]['expenses'] += $opreationArray['money'];
            $yearStat[$dateparts[0]]['categories'][$opreationArray['category']] += $opreationArray['money'];
        }
        
        // якщо статистика по місяцях ще не була записана в масив, то створюю:
        if(!isset($yearStat[$dateparts[0]][$dateparts[1]])) {
            $yearStat[$dateparts[0]][$dateparts[1]] = array(
                'profit' => 0,
                'expenses' => 0,
                'categories' => $allCategory
            );
            foreach ($yearStat[$dateparts[0]][$dateparts[1]]['categories'] as $catID => $catValue) {
                $yearStat[$dateparts[0]][$dateparts[1]]['categories'][$catID] = 0;
            }
        }
        // якщо вже є цей місяць у масиві, то додаю нові значення:
        if($opreationArray['operation'] == 2) {
            $yearStat[$dateparts[0]][$dateparts[1]]['profit'] += $opreationArray['money'];
            $yearStat[$dateparts[0]][$dateparts[1]]['categories'][$opreationArray['category']] += $opreationArray['money'];
        } else if($opreationArray['operation'] == 1) {
            $yearStat[$dateparts[0]][$dateparts[1]]['expenses'] += $opreationArray['money'];
            $yearStat[$dateparts[0]][$dateparts[1]]['categories'][$opreationArray['category']] += $opreationArray['money'];
        }
 
    }
    
    //print_r($yearStat);
    print_r($yearStat[2018]['08']);
    
    
    if(!isset($_GET['month'])) {
        require_once 'statByYear.php';
    }

