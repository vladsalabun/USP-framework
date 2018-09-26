<?php

    // TODO: чи видно змінні з одного плагіну в іншому?

    require_once 'plugin_database.php';
    
     $className = basename(pathinfo(__FILE__)['dirname']);
     $tmpObj = new $className;

/*
  Питання можуть бути:
  - обовязкові
  - одаткові
  - уточнюючі

  Чим більше інформації ми витягнемо з клієнта, тим менше проблем і непорозумінь буде при розробці.

  Скіьки часу займає опитування?
  Скільки максимально і мінімально питань треба, щоб клієнт відчув, що ми професіонали?
*/
    function getCorporateBlogPosts($categoryID) {
        global $form;

        return $questionsToCustomer;
    }

  /*
    TODO:
    1) скачати кожен розділ у вигляді книжки для друку, щоб давати працівникам

  */



    // Якщо чітко вказано, що це запит до плагіну:
    if ($_POST['actionTo'] == 'plugin') {

        // якщо чітко вказано, що це запит до цього плагіну:
        if ($_POST['pluginFolder'] == 'usp_corporateBlog') {

            // тільки тоді виконую якусь дію:
            if (isset($_POST['action'])) {

                ##############################################

                // Дія addCategory:
                if ($_POST['action'] == 'addCategory') {

                    addCorporateBlogCategory();
                    $link = $pluginConfigUrl;
                    header ("Location: $link");
                    exit();
                } // <-- Дія addCategory



            } // <-- кінець виконання дій

        } // <-- кінець перевірки папки плагіну

    } // <-- кінець перевірки запиту до плагіну


    function getCorporateBlogCategories() {

       global $db;
       
       $className = basename(pathinfo(__FILE__)['dirname']);
       $tmpObj = new $className;

       $array = array(
           "SELECT" => "*",
           "FROM" => $tmpObj->tablesNames[2],
           "WHERE" => "moderation = 0",
           "ORDER" => "parentCategoryID",
           "SORT" => "DESC"
       );

       return $db->select($array, null);

    }


    function showCategoryTree($oneDimensionalArray) {
        return createMultidimensionalArray($oneDimensionalArray);
    }

    function addCorporateBlogCategory() {

        global $db;
        
        $className = basename(pathinfo(__FILE__)['dirname']);
        $tmpObj = new $className;

        $array = array(
            "INSERT INTO" => $tmpObj->tablesNames[2],
            "COLUMNS" => array(
                "categoryName" => $_POST['categoryName'],
                "categoryURL" =>  $_POST['categoryURL'],
                "parentCategoryID" => $_POST['parentCategoryID'][0],
                "priority" => 0,
            )
        );
        $db->insert($array);

    }
