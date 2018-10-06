<?php 

    require_once 'top.php';

    $array = array(
        "SELECT" => "*",
        "FROM" => $usp_money->tablesNames[3]
    );
    $moneyParams = $db->select($array, null); 


?>

<div class="container-fluid margin30">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <p>
<?php 
         echo 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
        .$form->hidden(array('name'=> 'action','value'=> 'updateConfig'))
        
        .p('UAH:')
        .p($form->text(array('name'=> 'uah','value'=> $moneyParams[0]['moneyUAH'],'class'=>'txtfield')))
        .p('USD:')
        .p($form->text(array('name'=> 'usd','value'=> $moneyParams[0]['moneyUSD'],'class'=>'txtfield')))
        .p('uahToUsd:')
        .p($form->text(array('name'=> 'uahtousd','value'=> $moneyParams[0]['uahToUsd'],'class'=>'txtfield')))
        .p('usdToUah:')
        .p($form->text(array('name'=> 'usdtouah','value'=> $moneyParams[0]['usdToUah'],'class'=>'txtfield')))
        .p($form->submit(array('name'=> 'submit','value'=> 'Update Money','class'=>'btn btn-primary')))
        
        .$form->formEnd();
?>
    </p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php echo $moneyParams[0]['moneyUSD']; ?>
        </div>
    </div>
</div>

