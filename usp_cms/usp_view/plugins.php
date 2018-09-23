<div class="container-fluid">
    <div class="container center">
    <h2><?php echo dialogs(100,$language); ?></h2>
    </div>
</div>
<div class="container-fluid">
        <div class="row">
            <div class="container-fluid border-bottom">
            <div class="row padding10">
                <div class="col-1">
                   <p class="fontB">Статус:</p>
                </div> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                   <p class="fontB">Назва:</p>
                </div>  
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                   <p class="fontB">Опис:</p> 
                </div>    

        
            </div>         
            </div>         
        </div>

<?php
        foreach ($pluginsArray as $id => $plugin) {
?>
        <div class="row">
            <div class="container-fluid border-bottom">
            <div class="row padding10">
                <div class="col-2">
                    <?php 
                        if(isset($pluginStatus['activated'][$plugin['pluginFolder']])) {
                               echo                         
                             $form->formStart()
                            .$form->hidden(array('name'=> 'action','value'=> 'pluginPlugger'))
                            .$form->hidden(array('name'=> 'turn','value'=> 'off'))
                            .$form->hidden(array('name'=> 'pluginFolder','value'=> $plugin['pluginFolder']))
                            .$form->submit(array('name'=> '','value'=> 'Активний','class'=>'btn btn-success'))
                            .$form->formEnd();
                        } else if (isset($pluginStatus['deactivated'][$plugin['pluginFolder']])) {
                               echo                         
                             $form->formStart()
                            .$form->hidden(array('name'=> 'action','value'=> 'pluginPlugger'))
                            .$form->hidden(array('name'=> 'turn','value'=> 'on'))
                            .$form->hidden(array('name'=> 'pluginFolder','value'=> $plugin['pluginFolder']))
                            .$form->submit(array('name'=> '','value'=> 'Відключений','class'=>'btn btn-danger'))
                            .$form->formEnd();
                        } else {
                            echo 'other';
                        }
                    ?>
                </div> 
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                    <?php echo $plugin['pluginName']; ?><br>
                    <?php echo $plugin['pluginVersion']; ?>
                </div>  
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <?php echo $plugin['pluginDescription'].'<br><font color="#ececec">'.$plugin['pluginFolder'].'</font>'; ?>
                </div>    

        
            </div>         
            </div>         
        </div>         
<?php       
       }
?>
  
</div>
