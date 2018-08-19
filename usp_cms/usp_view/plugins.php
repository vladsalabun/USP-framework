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
                   Status:
                </div> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <?php echo $plugin['pluginName']; ?><br>
                    <?php echo $plugin['pluginVersion']; ?>
                </div>  
      
                    <?php //echo $plugin['pluginAuthor']; ?>
                    <?php //echo $plugin['pluginFolder']; ?>

                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <?php echo $plugin['pluginDescription']; ?>
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
                <div class="col-1">
                    <?php 
                        if( readParam($plugin['pluginActivation']) == 'yes') {
                            echo 'yes';
                        } else {
                            echo 'no';
                        }
                    ?>
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <?php echo readParam($plugin['pluginName']); ?><br>
                    <?php echo readParam($plugin['pluginVersion']); ?>
                </div>  
      
                    <?php //echo $plugin['pluginAuthor']; ?>
                    <?php //echo $plugin['pluginFolder']; ?>

                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <?php echo readParam($plugin['pluginDescription']); ?>
                </div>    

        
            </div>         
            </div>         
        </div>         
<?php       
       }
?>
  
</div>
