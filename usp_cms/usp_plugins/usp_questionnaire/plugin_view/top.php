<?php 
    $array = array(
        "SELECT" => "*",
        "FROM" => $moneytablesArray[3]
    );
    $moneyParams = $db->select($array, null); 
?>
<nav class="navbar vilet navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>">
                    Cash:
                </a>
            </li>
            <div class="navbar-text">
                <?php echo $moneyParams[0]['moneyUAH']; ?> ₴
            </div> 
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&show=usd">
                    Dollars
                </a>
            </li> 
            <div class="navbar-text">
                <?php echo $moneyParams[0]['moneyUSD']; ?> $
            </div>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&show=wishlist">
                    Wishlist
                </a>
            </li> 
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&plugin_config=money_config"><img src="<?php echo $pluginWebURL;?>usp_money/plugin_img/config.png" title="Configuration" class="icon20"> Config money</a>
            </li>             
            <li class="nav-item active">
                <?php echo modalLink('adduah', '+Add UAH', 'nav-link'); ?>
            </li>             

            <li class="nav-item active">
                <?php echo modalLink('addusd', '+Add USD', 'nav-link'); ?>
            </li>           
            <li class="nav-item active">
                <?php echo modalLink('addwish', '+Add wish', 'nav-link'); ?>
            </li>             
        </ul>
    </div>
</nav>
<style>
.vilet {
    background: #56004F !important;
}
.navbar-text {
    color: #FED570 !important;
    margin-right: 20px;
}
.modal-content {
    background: #FAFAFA;
}
</style>
<?php 

    $addUAHbody = 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
        .$form->hidden(array('name'=> 'action','value'=> 'changeUAH'))
        .p($form->text(array('name'=> 'sum','value'=> '0','class'=>'txtfield')))
        .p($form->select(array('name'=> 'category','value'=> $moneyCategory)))
        .p($form->submit(array('name'=> 'submit','value'=> 'Add new UAH','class'=>'btn')),'center')
        .$form->formEnd();

    $addUSDbody = 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
        .$form->hidden(array('name'=> 'action','value'=> 'changeUSD'))
        .p($form->text(array('name'=> 'sum','value'=> '0','class'=>'txtfield')))
        .p($form->select(array('name'=> 'category','value'=> $moneyCategory)))
        .p($form->submit(array('name'=> 'submit','value'=> 'Add new USD','class'=>'btn')),'center')
        .$form->formEnd();
    
    $addWishbody = 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
        .$form->hidden(array('name'=> 'action','value'=> 'addWish'))
        .p($form->text(array('name'=> 'wishName','value'=> '','class'=>'txtfield','placeholder' => 'Wish name')))
        .p($form->text(array('name'=> 'wishPrice','value'=> '0','class'=>'txtfield')))
        .p($form->select(array('name'=> 'category','value'=> $moneyCategory)))
        .p($form->submit(array('name'=> 'submit','value'=> 'Add new wish','class'=>'btn')),'center')
        .$form->formEnd();

        
    echo modalWindow('adduah','changeUAH',$addUAHbody,1,1);
    echo modalWindow('addusd','changeUSD',$addUSDbody,1,1);
    echo modalWindow('addwish','add wish:',$addWishbody,1,1);
?>