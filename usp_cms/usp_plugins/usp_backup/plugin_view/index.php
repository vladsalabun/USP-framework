<?php
  require_once 'header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
        <p>
<?php
    echo 
     $form->formStart()
    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_backup'))
    .$form->hidden(array('name'=> 'action','value'=> 'createBackup'))
    .$form->submit(array('name'=> 'createBackup','value'=> 'Створити бекап','class'=>'btn btn-success'))
    .$form->formEnd();
?>
        </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
        <h3>Список бекапів:</h3>
        <p>
<?php
    
    // Дивлюсь файли у папці:
    $backupArray = scandir('./usp_plugins/usp_backup/plugin_uploads/', 1);
    //var_dump($backupArray);
    
    foreach ($backupArray as $backupID => $backupName) {
        if($backupName != '.' and $backupName != '..') {
            echo '<p>Завантажити: <a href="'.$webSiteUrl.$usp.'_cms/usp_plugins/usp_backup/plugin_uploads/'.$backupName.'">'.$backupName.'</a> [ '.modalLink('windowId'.$backupID, 'видалити backup','red').' ]</p>';
            
            $backupModalBody = 
             '<p>'.$backupName.'</p>'
            .$form->formStart()
            .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
            .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_backup'))
            .$form->hidden(array('name'=> 'action','value'=> 'deleteBackup'))
            .$form->hidden(array('name'=> 'fileName','value'=> $backupName))
            .$form->submit(array('name'=> 'deleteBackup','value'=> 'Видалити бекап','class'=>'btn btn-danger'))
            .$form->formEnd();
            
            ;
            
            echo modalWindow('windowId'.$backupID,'Видалення бекапу:',$backupModalBody,'large','center');
        }
    }
  
?>
        </p>
        </div>
    </div>
</div>



