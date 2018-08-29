<?php 

    require_once 'top.php';

    $array = array(
        "SELECT" => "*",
        "FROM" => $moneytablesArray[3]
    );
    $moneyParams = $db->select($array, null); 


?>

<div class="containter">
    <p>
<?php 
         echo 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
        .$form->hidden(array('name'=> 'action','value'=> 'updateConfig'))
        
        .p('UAH:')
        .p($form->text(array('name'=> 'uah','value'=> $moneyParams[0]['moneyUAH'])))
        .p('USD:')
        .p($form->text(array('name'=> 'usd','value'=> $moneyParams[0]['moneyUSD'])))
        .p('uahToUsd:')
        .p($form->text(array('name'=> 'uahtousd','value'=> $moneyParams[0]['uahToUsd'])))
        .p('usdToUah:')
        .p($form->text(array('name'=> 'usdtouah','value'=> $moneyParams[0]['usdToUah'])))
        .p($form->submit(array('name'=> 'submit','value'=> 'Update Money','class'=>'btn btn-primary')))
        
        .$form->formEnd();
?>
    </p>
</div>
