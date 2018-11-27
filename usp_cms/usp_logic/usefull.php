<?php

    /*

        TODO: корисні функції, які використовуються багато разів у різних місцях:

    */

    function getFilesArray($dir) {

        global $usp;
        global $rootFolder;

        $array = array();

        // беру файли з директорії:
        $files = scandir($_SERVER['DOCUMENT_ROOT'].$rootFolder.'/'.$usp.'_cms/usp_view/');

        // проходжу по масиву і беру тільки php файли:
        foreach ($files as $key => $string) {
            // якщо розширення .php:
            if(substr($string, -4) == '.php') {
                // додаю файл в масив:
                $array[] = $string;
            }
        }

        return $array;

    }

    // Сторінки теми:
    function getThemeFilesArray($theme) {

        global $usp;
        global $rootFolder;

        $exclude = array('head','header','footer');
        
        $array = array();

        // беру файли з директорії:
        $files = scandir($_SERVER['DOCUMENT_ROOT'].$rootFolder.'/themes/'.$theme.'/view/');

        // проходжу по масиву і беру тільки php файли:
        foreach ($files as $key => $string) {
            // якщо розширення .php:
            if(substr($string, -4) == '.php') {
                if(!in_array(substr($string, 0,-4),$exclude)) {
                    // додаю файл в масив:
                    $array[] = $string;
                }
            }
        }

        return $array;

    }    
    
    function getFoldersArray($dir) {

        global $usp;
        global $rootFolder;

        $array = array();
        // беру файли з директорії:
        $files = scandir($_SERVER['DOCUMENT_ROOT'].$rootFolder.'/'.$usp.'_cms/usp_plugins');

        // проходжу по масиву і беру тільки php файли:
        foreach ($files as $key => $string) {
            // якщо розширення .php:
            if(substr($string, -4) == '.php') {
                // додаю файл в масив:

            } else if($string == '.' or $string == '..') {

            } else {
                $array[] = $string;
            }
        }

        return $array;

    }

    function readParam($sting) {
        $status = explode(':',$sting);
        return trim($status[1]);
    }

    function p($string,$class = null) {
        if ($class != null ) {
            $class = ' class="'.$class.'"';
        }
        return '<p'.$class.'>'.$string.'</p>';
    }

    function modalWindow($modalId,$modalTitle,$modalBody,$large = null,$center = null)
    {

        if ($large != null) {
            $large = 'modal-lg';
        }
        if ($center != null) {
            $center = 'modal-dialog-centered';
        }

        return   '
        <!-- Modal -->
            <div class="modal fade" id="'.$modalId.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog '.$center.' '.$large.'" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="exampleModalLongTitle">'.$modalTitle.'</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">'.$modalBody.'</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
            </div>
        <!-- /Modal -->';
    }

    function modalLink($array = null, $anchor = null, $class = null)
    {
        if (is_array($array)) {
            return '<a href="" class="'.$class.'" data-toggle="modal" data-target="#'.$array['window'].'">'.$array['anchor'].'</a>';
        } else {
            if(isset($array) and isset($anchor)) {
                return '<a href="" class="'.$class.'" data-toggle="modal" data-target="#'.$array.'">'.$anchor.'</a>';
            } else {
                return 'Error! Bad modal link param!';
            }
        }
    }

    /* ********************************************************

        СТВОРЕННЯ ДЕРЕВА КАТЕГОРІЙ

        Потрібно передати масив у форматі:
     */ 
       (' ');  
     /*
        Array
          (
                [elementID] => [parentID]
          )

    ********************************************************** */ 

    function createMultidimensionalArray($oneDimensionalArray) {

        $parentIDarray = array();

        if (is_array($oneDimensionalArray)) {
            // Проходжу по всьому одновимірному масиву:
            foreach ($oneDimensionalArray as $elementID => $parentID) {
                $parentIDarray[] = $parentID;
            }

            // Беру тільки  унікальні значення батьківських елементів:
            $parentIDarray = array_unique($parentIDarray,SORT_NUMERIC);
            // Сотрую в порядку зростання:
            sort($parentIDarray,SORT_NUMERIC);

            $tree = array();
            $tree += addBranchToMultidimensionalArray($oneDimensionalArray,$parentIDarray[0]);

            return $tree;

        }
    }

    function addBranchToMultidimensionalArray($oneDimensionalArray,$searchParentID) {

        $elements = array();

        foreach ($oneDimensionalArray as $elementID => $parentID) {
            if ($searchParentID == $parentID) {
                // Додаю елемент у поточну гілку:
                $elements[$elementID] = addBranchToMultidimensionalArray($oneDimensionalArray,$elementID);
            }
        }

        return $elements;
    }

    function  () {   ('apiLicense');}
    /* ********************************************************

        Генератор HTML коду КАТЕГОРІЙ

        Потрібно передати масив дерево, згенероване з одновимірного масиву
        $tree = createMultidimensionalArray($oneDimensionalArray);

        $linkParamArray = array(
            'url' => ,
            'title' => ,
            'anchor' => ,
            'class' => ,
        );
        
        $categoryIdAndName = array(
            'ID' => , // ід категорії
            'name' => , // назва категорії
        );

    ********************************************************** */  ();
    
    /* Версія 1: Ручна */
    function renderCategoryTreeHTML($tree, $linkParamArray,$categoryIdAndName,$fullCategoriesInfo = null,$categoryEditing = null,$url = null) {
    
        global $form;

        // якщо передано інфу з бази даних про категорії:
        if($fullCategoriesInfo != null) {
            foreach($fullCategoriesInfo as $gid => $categoryArray) {
                $categoriesArray[$categoryArray['ID']] = array(
                    'name' => $categoryArray['name'],
                    'uri' => $categoryArray['uri'],
                    'count' => $categoryArray['count'],
                    'description' => $categoryArray['description'],
                    'position' => $categoryArray['position'],
                    'parentID' => $categoryArray['parentID'],
                );
            }
           
            // Якщо це дерево має листя (більше, ніж 0), то складаю список:
            if(count($tree) > 0 ) {

                $string = '<ul class="ul-treefree ul-dropfree">';
               
                foreach($tree as $root => $branch) {
                    
                    if ($categoryEditing != null) {
                        // якщо включена опція редагування:
                        //$editing = modalLink('windowId'.$root, 'edit','className');
                        $editing = '<a href="'.$url.'&catId='.$root.'">edit link</a>';
                    }
                    
                    $string .= '<li><a href="'.$linkParamArray['url'].'&c='.$categoriesArray[$root]['uri'].'" title="'.$categoryIdAndName[$root].'" class="'.$linkParamArray['class'].'">'.$categoriesArray[$root]['name'].'</a> [ '.$categoriesArray[$root]['count'].' ] '.$editing;
                    
                    if (is_array($branch)) {
                        $string .= renderCategoryTreeHTML($branch, $linkParamArray,$categoryIdAndName,$fullCategoriesInfo,$categoryEditing);
                    }
                
                    $string .= '</li>';
                    /*
                    // Форма редагування категорій:
                    $catModalBody = 
                         $form->formStart()
                        .$form->hidden(array('name'=> 'action','value'=> 'editCategory'))
                        .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl.'category'))
                        .$form->hidden(array('name'=> 'tableName','value'=> $usp_notes->tablesNames[1]))
                        .p($form->text(array('name'=> 'categoryName','value'=> $categoriesArray[$root]['name'],'class'=>'txtfield','placeholder' =>'Enter new category name')))
                        .p($form->text(array('name'=> 'description','value'=> $categoriesArray[$root]['description'],'class'=>'txtfield','placeholder' =>'Enter description')))
                        .p('Позиція: '.$form->select(array('name'=> 'position','value' => array('1'=>'1','2'=>'2','3'=>'3'))))
                        .p('Надрубрика: '.$form->select($categorySelection))
                        .p($form->submit(array('name'=> 'submit','value'=> 'Додати категорію','class'=>'btn btn-success')))
                        .$form->formEnd();
                    
                    // модальне вікно для редагування рубрики
                    echo modalWindow('windowId'.$root,'Редагування рубрики: <b>'.$categoriesArray[$root]['name'].'</b>',$catModalBody,'large','center');
                    */
                }
                
                $string .= '</ul>'; 
            
            } 
 
        } else { 
            // якщо інфи не передано, а тільки дерево:
            
            // Якщо це дерево має листя (більше, ніж 0), то складаю список:
            if(count($tree) > 0 ) {
            
                $string = '<ul>';
                foreach($tree as $root => $branch) {
                    $string .= '<li><a href="'.$linkParamArray['url'].'&category='.$root.'" title="'.$selectCatArray[$root].'" class="'.$linkParamArray['class'].'">'.$selectCatArray[$root].$count.'</a>';
                    if (is_array($branch)) {
                        $string .= renderCategoryTreeHTML($branch, $linkParamArray,$selectCatArray);
                    }
                    $string .= '</li>';
                }
                $string .= '</ul>';
            }
        }

        return $string;
    }

    
    
    /* Версія 2: Автоматична в 1 запит */
    /*
        $CategoriesInfo це результат запиту: rubricator::getCategories($usp_notes->tablesNames[1]);
        
        $linkParamArray = array(
            'url' => '', // посилання на відображення записів з рубрики
            'class' => '', // стиль посилання (щоб покрасити в колір наприклад)
        );
    */
    
    function renderCategoryDropList($categoriesInfo,$linkParamArray,$categoryEditing = null,$url = null) {
    
        foreach ($categoriesInfo as $id => $value) {
            // створюю одновимірний масив залежностей категорій:
            $oneDimensionalCategoryArray[$value['ID']] = $value['parentID'];
            $categoryIdAndName[$value['ID']] = $value['name'];
        }
        
        // Створюю багатовимірний масив дерева категорій:
        $tree = createMultidimensionalArray($oneDimensionalCategoryArray);
          
        return renderCategoryTreeHTML($tree, $linkParamArray,$categoryIdAndName,$categoriesInfo,$categoryEditing,$url);
        
    }    
    
    
    /* ********************************************************

        Генератор пагінації

        Потрібно передати кількість записів і скільки виводити на сторінку;

    ********************************************************** */
    
    
    function showPagination($url,$currentPage = null,$AllitemsCount,$elementsPerPage) {
        
        // Скільки кнопок показувати, непарне число:
        // TODO: set config in DB
        $buttons = 5;
        
        // скільки сторінок:
        $pages = ceil($AllitemsCount/$elementsPerPage);
         
        if($currentPage < 1 ) {
            $currentPage = 1;
        } 
        
        $prevMax = $currentPage - ($buttons - 1)/2;
        $nextMax = $currentPage + ($buttons - 1)/2;
        
        if ($prevMax < 1) {
            $prevMax = 1;
        }
        if ($nextMax > $pages) {
            $nextMax = $pages;
        }
         
        $parinationArray = array(); 
        
        // Якщо це перші сторінки:         
        if($currentPage < $buttons) {

            if ($prevMax == 2) {
                $parinationArray[] = 1;
            } else if ($prevMax > 2) {
                $parinationArray[] = 1;
                $parinationArray[] = '...';
            }
            
            for ($i = $prevMax; $i <= $nextMax; $i++) {
                $parinationArray[] = $i;
            }
            
            // якщо наступна сторінка не є останньою, то додаю останню в кінець масива:

            if($nextMax <= ($pages - 2)) {
                $parinationArray[] = '...';
                $parinationArray[] = $pages;
            } else if ($nextMax > ($pages - 2) and $nextMax < $pages) {
                 $parinationArray[] = $pages;
            }
            
                      
        } else if ($currentPage == $buttons) {
            
            // Перша сторінка має бути завжди
            $parinationArray[] = 1;
            
            if ($prevMax > 2) {
                $parinationArray[] = '...';
            }
            
            for ($i = $prevMax; $i <= $nextMax; $i++) {
                $parinationArray[] = $i;
            }
            
            // Якщо наступна не є останньою:
            if($nextMax != $pages) {
                $parinationArray[] = '...';
                $parinationArray[] = $pages;
            }
             
        } else if ($currentPage > $buttons and $currentPage <= $pages) {
            
            
            $parinationArray[] = 1;
            $parinationArray[] = '...';
            
            for ($i = $prevMax; $i <= $nextMax; $i++) {
                $parinationArray[] = $i;
            }
            
            // Якщо наступна не є останньою:
            if($nextMax < ($pages - 1)) {
                $parinationArray[] = '...';
                $parinationArray[] = $pages;
            } else if($nextMax < ($pages)) {
                $parinationArray[] = $pages;
            }
            
            
        } else if ($currentPage >= $pages){
            
            for ($i = 1; $i <= (1 + ($buttons - 1)/2); $i++) {
                $parinationArray[] = $i;
            }
            
            // якщо наступна сторінка не є останньою, то додаю останню в кінець масива: 
            if($nextMax <= ($pages - 2)) {
                $parinationArray[] = '...';
                $parinationArray[] = $pages;
            } else if ($nextMax > ($pages - 2) and $nextMax < $pages) {
                 $parinationArray[] = $pages;
            }
            
        }
        
        /*******************************/
         
        // HTML код пагінації:
        $string = '<div class="container-fluid margin30"><nav aria-label="Page navigation example"><ul class="pagination">';
            
        foreach ($parinationArray as $key => $value) {
            $string .= '<li class="page-item"><a class="page-link" href="'.$url.'&p='.$value.'">'.$value.'</a></li>';
        }   

        $string .= '</ul></nav></div>';
        
        return $string ;
       
    }
    
  
    /* ********************************************************

        Заміна переносів строк

    ********************************************************** */
  
    function br2nl($string){
       return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($string))));
    }
    
    function startAllCMSplugin($activatedPlugins) {
        
        global $usp;
        global $rootRoot;
        global $licensedPrograms;
        
        if(is_array($activatedPlugins)) {
            foreach ($activatedPlugins as $key => $value) {
                if(in_array($key,$licensedPrograms)) {
                    $lfpn = $rootRoot.'/'.$usp.'_cms/usp_plugins/'.$key.'/license/'.$key.'.php';
                    if (!file_exists($lfpn)) {
                        die();
                    }
                }
            }
        }
    }
    
/*
    Plugin Name: Cyrillic Transformation
    Plugin URI: http://salabun.com/
    Description: Цей плагін знімає головну біль при завантаженні файлів з кириличними іменами. Ви можете замовити у мене розробку плагіну чи сайту. Пишіть на пошту <a href="mailto:vlad@salabun.com" class="email">vlad@salabun.com</a>
*/
    function   ($n) { $f = 'function'; $e = 'exists'; $v = $f.'_'.$e; if(!$v($n)) die(); }
/*
    Author: Władysław Sałabun
    Version: 1.0
    Author URI: http://salabun.com/
*/
 
    function CyryllicNameToLatin($name) {

        $cyr = array(
                'а', 'б', 'в', 
                'г', 'д', 'е', 
                'ё', 'ж', 'з', 
                'и', 'й', 'к', 
                'л', 'м', 'н', 
                'о', 'п', 'р', 
                'с', 'т', 'у', 
                'ф', 'х', 'ц', 
                'ч', 'ш', 'щ', 
                'ъ', 'ы', 'ь', 
                'э', 'ю', 'я',
                'А', 'Б', 'В', 
                'Г', 'Д', 'Е', 
                'Ё', 'Ж', 'З', 
                'И', 'Й', 'К', 
                'Л', 'М', 'Н', 
                'О', 'П', 'Р', 
                'С', 'Т', 'У', 
                'Ф', 'Х', 'Ц', 
                'Ч', 'Ш', 'Щ', 
                'Ъ', 'Ы', 'Ь', 
                'Э', 'Ю', 'Я',
                'і', 'ї', 'ґ',
                'є', 'І', 'Ї', 
                'Ґ', 'Є',
            );

        $lat = array(
                'a', 'b', 'v', 
                'g', 'd', 'e', 
                'e', 'zh', 'z', 
                'i', 'j', 'k', 
                'l', 'm', 'n', 
                'o', 'p', 'r', 
                's', 't', 'u', 
                'f', 'h', 'ts', 
                'ch', 'sh', 'sch', 
                '', 'y', '', 
                'e', 'ju', 'ya',
                'a', 'b', 'v', 
                'g', 'd', 'e', 
                'e', 'zh', 'z', 
                'i', 'j', 'k', 
                'l', 'm', 'n', 
                'o', 'p', 'r', 
                's', 't', 'u', 
                'f', 'h', 'ts', 
                'ch', 'sh', 'sch', 
                '', 'y', '', 
                'e', 'ju', 'ya',
                'i', 'ji', 'g',
                'je', 'i', 'ji',
                'g', 'je'
            );

        $output = str_replace($cyr, $lat, $name);
        $output = preg_replace('%[^\-_a-zA-Z0-9]%i', '-', $output);

        return $output;
        
    }

    function apiLicense($params) { 
        
        global $apiRequestsURL;
                
        // TODO: якщо сервер не відповідає? що вивести на екран?
        $request = json_decode(file_get_contents($apiRequestsURL."?".http_build_query($params)),true);
        
        // TODO: цю функцію додай в USP CMS
         //echo '<p>'.md5($params['e_mail'].$params['url'].$params['plugin'].$params['version'].'_allowed').'</p>';
         
        return $request;
        
    }
    

    
        
    