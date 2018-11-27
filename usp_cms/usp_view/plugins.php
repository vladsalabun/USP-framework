<div class="container">

<?php
        foreach ($pluginsArray as $pluginId => $plugin) {
?>
<div class="row margin10 padding10 background4">
    <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2">

        <?php
            echo 
                modalLink('windowId'.$pluginId,$plugin['pluginName'])
                .'<br><font color="#445566">'
                .$plugin['pluginFolder']
                .'</font><br>'
                .$plugin['pluginVersion'];
            
            if($plugin['pluginMenu'] == 'yes') { $tmpPluginMenu = 1;} else { $tmpPluginMenu = 0;}
            if($plugin['pluginSubMenu'] == 'yes') {$tmpPluginSubMenu = 1;} else { $tmpPluginSubMenu = 0;}
            if($plugin['pluginFooterMenu'] == 'yes') {$tmpPluginFooterMenu = 1;} else { $tmpPluginFooterMenu = 0;}
            
            $pluginShowConfig = array(
                'pluginMenu' => $tmpPluginMenu,
                'pluginSubMenu' => $tmpPluginSubMenu,
                'pluginFooterMenu' => $tmpPluginFooterMenu
            );
                        
            $pluginModalBody = 
             '<div class="row background4">
             <div class="container">
             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
             '
            .$form->formStart()
            .$form->hidden(array('name'=> 'action','value'=> 'changePluginConfig'))
            .$form->hidden(array('name'=> 'pluginFolder','value'=> $plugin['pluginFolder']))
            .p($form->checkbox(array('name'=> $plugin['pluginFolder'],'value'=> array($pluginShowConfig))))
            .p($form->text(array('name'=> 'pluginTitle','value'=> $plugin['pluginTitle'])))
            .p($form->submit(array('name'=> '','value'=> 'Зберегти','class'=>'btn btn-success')))
            .$form->formEnd().
            '</div>
            </div>
            </div>'
            ;
            
            echo modalWindow('windowId'.$pluginId,'Налаштування плагіну <b>'.$plugin['pluginName'].'</b>:',$pluginModalBody,'large','center');
        
        ?>
    </div>  
    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <?php echo $plugin['pluginDescription']; ?>   
    </div>    
    <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2 center padding10">
        <?php 
            if(isset($pluginStatus['activated'][$plugin['pluginFolder']])) {
                   echo                         
                 $form->formStart()
                .$form->hidden(array('name'=> 'action','value'=> 'pluginPlugger'))
                .$form->hidden(array('name'=> 'turn','value'=> 'off'))
                .$form->hidden(array('name'=> 'pluginFolder','value'=> $plugin['pluginFolder']))
                .$form->submit(array('name'=> '','value'=> 'Активен','class'=>'btn btn-success'))
                .$form->formEnd();
            } else if (isset($pluginStatus['deactivated'][$plugin['pluginFolder']])) {
                   echo                         
                 $form->formStart()
                .$form->hidden(array('name'=> 'action','value'=> 'pluginPlugger'))
                .$form->hidden(array('name'=> 'turn','value'=> 'on'))
                .$form->hidden(array('name'=> 'pluginFolder','value'=> $plugin['pluginFolder']))
                .$form->submit(array('name'=> '','value'=> 'Отключен','class'=>'btn btn-danger'))
                .$form->formEnd();
            } else {
                echo 'other';
            }
        ?> 
    </div> 
</div>                                 
<?php       
       }
?>
</div>
