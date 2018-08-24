<div class="container-fluid">
<?php 
 /*   
    $pluginNameCall = $_GET['name'];
    $pathToPluginView = $_SERVER['DOCUMENT_ROOT'].'/'.$usp.'_cms/usp_plugins/'.$pluginNameCall.'/plugin_view/';
    
    $pluginConfigUrl = $webSiteUrl.$usp.'_cms/?page=plugin&name='.$pluginNameCall;
 */   
    // Перевіряю чи створена папка view в плагіні:
    if(is_dir($pathToPluginView)) {
    
        function getPluginFilesArray($pathToPluginView) {
        
            global $usp;
            
            $array = array();
            
            // беру файли з директорії:
            $files = scandir($pathToPluginView);
            
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
        
        // Дізнатись, які є файли у папці view
        $pagesArray = getPluginFilesArray($pathToPluginView);
        
        // TODO:
        if (isset($_GET['plugin_config'])) {
            
            if ($_GET['plugin_config'] == '') {
                
                // якщо пусто, то йдем на головну:
                require $pathToPluginView.'index.php';
                
            } else {

                // Дізнаюсь, чи запитувана сторінка є у масиві:
                if (in_array($_GET['plugin_config'].'.php',$pagesArray)) {
                    
                    require $pathToPluginView.$_GET['plugin_config'].'.php';
                    
                } else {
                    
                    // якщо немає, то 404
                    echo dialogs(40002,$language);
                } 
                
            }            
        } else {
            
            // якщо ні, то йдем на головну:
            if (file_exists($pathToPluginView.'index.php')) {
                
                require $pathToPluginView.'index.php';
                
            } else {
                
                echo dialogs(40001,$language);
                
            }
  
        }
        
    } else {
        
        echo dialogs(40000,$language);
        
    }
    
?>
</div>
