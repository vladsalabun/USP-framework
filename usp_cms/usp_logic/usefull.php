<?php
    
    /*
        
        TODO: корисні функції, які використовуються багато разів у різних місцях:
    
    */
    
    function getFilesArray($dir) {
        
        global $usp;
        
        $array = array();
        
        // беру файли з директорії:
        $files = scandir($_SERVER['DOCUMENT_ROOT'].'/'.$usp.'_cms/usp_view/');
        
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
        
        $array = array();
        // беру файли з директорії:
        $files = scandir($_SERVER['DOCUMENT_ROOT'].'/'.$usp.'_cms/usp_plugins');

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
    