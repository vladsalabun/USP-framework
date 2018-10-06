<?php
    require_once 'header.php';
?>  
<div class="container-fluid background4 padding20">
<?php 
    echo 
     $form->formStart()
    .$form->hidden(array('name'=> '','value'=> ''))
    .p($form->text(array('name'=> 'categoryName','value'=> '','class'=>'txtfield','placeholder' =>'Enter new category name')))
    .p($form->submit(array('name'=> 'submit','value'=> 'Додати категорію','class'=>'btn btn-success')))
    .$form->formEnd();
?>
</div>
<div class="container-fluid">
<?php   

    $notesCategories = rubricator::getCategories($usp_notes->tablesNames[1]);
    
    var_dump($notesCategories);