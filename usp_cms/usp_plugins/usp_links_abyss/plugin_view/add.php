<?php
  require_once 'header.php';
?>
<div class="row margin20">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 center">

<?php
    echo 
     $form->formStart()
    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_links_abyss'))
    .$form->hidden(array('name'=> 'action','value'=> 'addNew'))
    .p($form->text(array('name'=> 'anchor','value'=> '','class'=>'txtfield','placeholder' =>'anchor')))
    .p($form->text(array('name'=> 'url','value'=> '','class'=>'txtfield','placeholder' =>'url')))
    .p($form->submit(array('name'=> '','value'=> 'Додати','class'=>'btn btn-success')))
    .$form->formEnd();

?>
</div>
</div>
