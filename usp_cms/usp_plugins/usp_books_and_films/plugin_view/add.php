<?php
  require_once 'header.php';
?>
<div class="row margin20">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 center">

<?php
    echo 
     $form->formStart()
    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_books_and_films'))
    .$form->hidden(array('name'=> 'action','value'=> 'addNew'))
    .p($form->text(array('name'=> 'name','value'=> '','class'=>'txtfield','placeholder' =>'name')))
    .p($form->text(array('name'=> 'author','value'=> '','class'=>'txtfield','placeholder' =>'author')))
    .p($form->text(array('name'=> 'year','value'=> '','class'=>'txtfield','placeholder' =>'year')))
    .p($form->select(array('name'=> 'type','value'=> array(0=>'книга',1=>'фільм'))))
    .p($form->submit(array('name'=> '','value'=> 'Додати','class'=>'btn')))
    .$form->formEnd();

?>
</div>
</div>
