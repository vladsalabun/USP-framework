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

    ********************************************************** */

    function renderCategoryTreeHTML($tree, $linkParamArray,$selectCatArray) {

        $string = '<ul>';
        foreach($tree as $root => $branch) {
            $string .= '<li><a href="'.$linkParamArray['url'].'&category='.$root.'" title="'.$selectCatArray[$root].'" class="'.$linkParamArray['class'].'">'.$selectCatArray[$root].'</a>';
            if (is_array($branch)) {
                $string .= renderCategoryTreeHTML($branch, $linkParamArray,$selectCatArray);
            }
            $string .= '</li>';
        }
        $string .= '</ul>';

        return $string;
    }
