<?php 

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <h2>Зміна пароля:</h2>
            <?php
            echo
             $form->formStart()
            .$form->hidden(array('name'=> 'action','value'=> 'changePassword'))
            .p($form->text(array('name'=> 'oldPassword','value'=> '','class'=>'txtfield','placeholder' =>'old password')))
            .p($form->text(array('name'=> 'newPassword','value'=> '','class'=>'txtfield','placeholder' =>'new password')))
            .p($form->text(array('name'=> 'newPassword2','value'=> '','class'=>'txtfield','placeholder' =>'new passrowd again')))
            .p($form->submit(array('name'=> '','value'=> 'Змінити пароль','class'=>'btn btn-success')))
            .$form->formEnd();
            ?>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
        <h2>Мова:</h2>
            <?php
            echo
             $form->formStart()
            .$form->hidden(array('name'=> 'action','value'=> 'changeLanguage'))
            .p($form->select(array('name'=> 'newPassword2','value'=> $allowedLanguages,'class'=>'txtfield')))
            .p($form->submit(array('name'=> '','value'=> 'Save','class'=>'btn btn-success')))
            .$form->formEnd();
            ?>        
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">3</div>
    </div>
</div>