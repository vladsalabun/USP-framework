<?php 

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
        <h2>Изменение пароля:</h2>
            <?php
            echo
             $form->formStart()
            .$form->hidden(array('name'=> 'action','value'=> 'changePassword'))
            .p($form->text(array('name'=> 'oldPassword','value'=> '','class'=>'txtfield','placeholder' =>'введите текущий пароль')))
            .p($form->text(array('name'=> 'newPassword','value'=> '','class'=>'txtfield','placeholder' =>'введите новый пароль')))
            .p($form->text(array('name'=> 'newPassword2','value'=> '','class'=>'txtfield','placeholder' =>'повторите новый пароль')))
            .p($form->submit(array('name'=> '','value'=> 'Сохранить пароль','class'=>'btn btn-success')))
            .$form->formEnd();
            ?>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4"></div>
    </div>
</div>