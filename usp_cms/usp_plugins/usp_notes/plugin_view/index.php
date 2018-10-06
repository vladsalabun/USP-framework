<?php
    require_once 'header.php';
    
    $notes = getNotes($notesType,$_GET['p']);
     
    if(isset($_GET['p'])) {
        $p = $_GET['p'];
    } else {
        $p = 1;
    }
    $item = ($p - 1) * $elementsPerPage + 1;
?>
<div class="container">
<?php   
    foreach ($notes as $key => $value) {
?>
<div class="row margin20 note">
    <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
    <div class="row">
<?php
    
    $tmpUnix = strtotime($value['date']);
    $tmpDate = date('Y/'.$monthNames['m']. ' /d',$tmpUnix);

    // Дата публікації:
    echo p(
        '<span class="noteDate">'
        .modalLink(
            'editNote'.$value['ID'], 
            date('d',$tmpUnix).' '.$monthNames[date('m',$tmpUnix)].' \''.substr(date('Y',$tmpUnix),2), 
            'note-link').'</span>'
         );
    //'<span class="noteID">'.$item.'</span>'
    $item++;
?>
    </div>
    </div>
    <div class="col-sm-6 col-md-7 col-lg-6 col-xl-7">
    <div class="row">
<?php
    echo p('<span class="noteText">'.$value['text'].'</span>');
?>
    </div>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
        
        
<div class="container">
  <div class="d-flex flex-row justify-content-between">
    <div class="block">
<?php

    echo 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_notes'))
        .$form->hidden(array('name'=> 'action','value'=> 'moderate'))
        .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))
        .$form->hidden(array('name'=> 'moderation','value'=> 2))
        .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl))
        .$form->submit(array('name'=> '','value'=> 'Одобрити','class'=>'btn btn-success'))
        .$form->formEnd();
        
?>
    
    </div>
    <div class="block">
<?php 
    echo 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_notes'))
        .$form->hidden(array('name'=> 'action','value'=> 'moderate'))
        .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))        
        .$form->hidden(array('name'=> 'moderation','value'=> 1))
        .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl))
        .$form->submit(array('name'=> '','value'=> 'Відхилити','class'=>'btn btn-danger'))
        .$form->formEnd();   

?>
    </div>
    
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
        .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl))
        .p($form->textarea(array('name'=> 'text','value'=> br2nl($value['text']),'class'=>'big_textarea')))
        .p($form->submit(array('name'=> 'submit','value'=> 'Редагувати нотатку','class'=>'btn btn-success')),'center')
        .$form->formEnd();
        echo modalWindow('editNote'.$value['ID'],'Редагування нотатки:',$notesBody,1,1);
    }
?>
</div>