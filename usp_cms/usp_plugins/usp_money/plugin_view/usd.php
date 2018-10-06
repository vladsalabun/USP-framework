<?php 
    $array = array(
        "SELECT" => "*",
        "FROM" => $usp_money->tablesNames[1],
        "WHERE" => "moderation = 0",
        "ORDER" => "ID",
        "SORT" => "DESC"
    );
    $moneyUSD = $db->select($array, null); 
    
    $dollars = 0;
    $dollarsExp = 0;
?>
<div class="container-fluid delpadding576">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
            <h2 class="margin20">Операції по USD:</h2>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                
                foreach ($moneyUSD as $usdArray) {
                    
                    if ($usdArray['operation'] == 1) {
                        $operation = '<span class="red">-'.$usdArray['money'].' ₴ </span>';
                        $dollarsExp += $usdArray['money'];
                    } else if ($usdArray['operation'] == 2) {
                        $operation = '<span class="green">+'.$usdArray['money'].' ₴</span>';
                        $dollars += $usdArray['money'];
                    }
                    
                    echo
                    '<tr>
                      <td>'.$operation.'</d>
                      <td>'.$allCategory[$usdArray['category']].'<br><span class="operation-date">'.$usdArray['date'].'</span></td>
                      <td>'.modalLink('operationModal'.$usdArray['ID'], '<img src="'.$pluginWebURL.'usp_money/plugin_img/edit.png" title="Edit" class="icon20">','className').'</td>
                    </tr>';
                    
                    $operationModalBody =
                     $form->formStart()
                    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
                    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
                    .$form->hidden(array('name'=> 'action','value'=> 'editUSDoperation'))  
                    .$form->hidden(array('name'=> 'ID','value'=> $usdArray['ID']))
                    .$form->hidden(array('name'=> 'year','value'=> $_GET['year']))
                    .$form->hidden(array('name'=> 'month','value'=> $_GET['month']))
                   // .p($form->datetime(array('name'=> '','value'=> $usdArray['date'])))
                    .p($form->text(array('name'=> 'money','value'=> $usdArray['money'],'class'=>'txtfield')))
                    .p($form->select(array('name'=> 'category','value'=> $moneyCategory),$usdArray['category']))
                    .p(
                        $form->submit(array('name'=> 'update','value'=> 'update','class'=>'btn')).' '.
                        $form->submit(array('name'=> 'delete','value'=> 'delete','class'=>'btn btn-danger')),
                        'center'
                    )
                    .$form->formEnd();
                    
                    echo modalWindow('operationModal'.$usdArray['ID'],'Edit operation #'.$usdArray['ID'].':',$operationModalBody,'large','center');
                    
                }
            ?>
        </tbody>
        </table>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
        <h2 class="margin20">Операції по USD:</h2>
        <?php echo '+'.$dollars; ?> $<br>
        <?php echo '-'.$dollarsExp; ?> $
        </div>
    </div>
</div>



