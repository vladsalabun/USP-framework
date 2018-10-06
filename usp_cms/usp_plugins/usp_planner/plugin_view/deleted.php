<?php
  require_once 'header.php';
  
?>

<?php
    $notes = getNotes('Deleted');
    foreach ($notes as $key => $value) {
?>
<div class="row margin20 note">
    <div class="col-sm-12 col-md-12 col-lg-1  col-xl-1">
<?php
    echo '<p><span class="noteID">'.$value['ID'].'</span></p>';
?>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
<?php
    echo '<p><span class="noteText">'.modalLink('editNote'.$value['ID'], $value['text'], 'note-link').'</span></p>';
    echo '<p><span class="noteDate margin30">'.$value['date'].'</span></p>';
?>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
        <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-6 col-xl-6 margin10">
<?php

    echo 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_notes'))
        .$form->hidden(array('name'=> 'action','value'=> 'moderate'))
        .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))
        .$form->hidden(array('name'=> 'moderation','value'=> 2))
        .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl.'&plugin_config=deleted'))
        .$form->submit(array('name'=> '','value'=> 'Одобрити','class'=>'btn btn-success'))
        .$form->formEnd();
        
?>    
            </div>
            <div class="col-sm-3 col-md-3 col-lg-4 col-xl-4 margin10">
<?php 
    echo 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_notes'))
        .$form->hidden(array('name'=> 'action','value'=> 'moderate'))
        .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))        
        .$form->hidden(array('name'=> 'moderation','value'=> 0))
        .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl.'&plugin_config=deleted'))
        .$form->submit(array('name'=> '','value'=> 'На модерацію','class'=>'btn'))
        .$form->formEnd();   

?>            
            </div>
        </div>
    </div>
</div>
<?php
        $notesBody =         
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_notes'))
        .$form->hidden(array('name'=> 'action','value'=> 'editNote'))
        .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))
        .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl.'&plugin_config=deleted'))
        .p($form->textarea(array('name'=> 'text','value'=> $value['text'],'class'=>'big_textarea','placeholder' => 'Wish name')))
        .p($form->submit(array('name'=> 'submit','value'=> 'Редагувати нотатку','class'=>'btn btn-success')),'center')
        .$form->formEnd();
        echo modalWindow('editNote'.$value['ID'],'Редагування нотатки:',$notesBody,1,1);
    }
?>
