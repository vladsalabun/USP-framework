<?php 
    $array = array(
        "SELECT" => "*",
        "FROM" => $tmpObj->tablesNames[4],
        "WHERE" => "done = 0",
        "ORDER" => "ID",
        "SORT" => "DESC"
    );
    $wishlist = $db->select($array, null); 

    $array = array(
        "SELECT" => "*",
        "FROM" => $tmpObj->tablesNames[4],
        "WHERE" => "done = 1",
        "ORDER" => "ID",
        "SORT" => "DESC"
    );
    $donelist = $db->select($array, null);  

    $wishSum = 0;
    $doneSum = 0;
    foreach ($wishlist as $wishlistArray) {
        $wishSum += $wishlistArray['wishPrice'];
    }
    foreach ($donelist as $wishlistArray) {
        $doneSum += $wishlistArray['wishPrice'];
    }
?>
<div class="container-fluid delpadding576">
    <div class="row margin20 delpadding576">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
            <h2 class="margin20">Список бажань:</h2>
            <p>Загальна сума: <?php echo $wishSum; ?> ₴</p>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                
                foreach ($wishlist as $wishlistArray) {
                    
                    
                    echo
                    '<tr>
                      <td width="70px">'.$wishlistArray['wishPrice'].' ₴</d>
                      <td>'.$wishlistArray['wishName'].'<br><span class="operation-date">'.$allCategory[$wishlistArray['wishCategory']].'</span></td>
                      <td>'.modalLink('operationModal'.$wishlistArray['ID'], '<img src="'.$pluginWebURL.'usp_money/plugin_img/edit.png" title="Edit" class="icon20">','className').'</td>
                    </tr>';
                    
                    $operationModalBody =
                     $form->formStart()
                    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
                    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
                    .$form->hidden(array('name'=> 'action','value'=> 'editWish'))  
                    .$form->hidden(array('name'=> 'ID','value'=> $wishlistArray['ID']))
                    .p($form->text(array('name'=> 'wishPrice','value'=> $wishlistArray['wishPrice'],'class'=>'txtfield')))
                    .p($form->text(array('name'=> 'wishName','value'=> $wishlistArray['wishName'],'class'=>'txtfield')))
                    .p($form->select(array('name'=> 'category','value'=> $moneyCategory),$wishlistArray['wishCategory']))
                    .p($form->select(array('name'=> 'done','value'=> array(0 => 'active',1 => 'done')),$wishlistArray['done']))
                    .p(
                        $form->submit(array('name'=> 'update','value'=> 'update','class'=>'btn')).' '.
                        $form->submit(array('name'=> 'delete','value'=> 'delete','class'=>'btn btn-danger')),
                        'center'
                    )
                    .$form->formEnd();
                    
                    echo modalWindow('operationModal'.$wishlistArray['ID'],'Edit operation #'.$wishlistArray['ID'].':',$operationModalBody,'large','center');
                    
                }
                
            ?>
        </tbody>
        </table>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
        <h2 class="margin20">Здійснені:</h2>
        <p>Загальна сума: <?php echo $doneSum; ?> ₴</p>
        <table class="table table-striped table-mini">
            <tbody>
         <?php
                
                foreach ($donelist as $wishlistArray) {
                    
                    
                    echo
                    '<tr>
                      <td width="70px">'.$wishlistArray['wishPrice'].' ₴</d>
                      <td>'.$wishlistArray['wishName'].'<br><span class="operation-date">'.$allCategory[$wishlistArray['wishCategory']].'</span></td>
                      <td>'.modalLink('operationModal'.$wishlistArray['ID'], '<img src="'.$pluginWebURL.'usp_money/plugin_img/edit.png" title="Edit" class="icon20">','className').'</td>
                    </tr>';
                    
                    $operationModalBody =
                     $form->formStart()
                    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
                    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
                    .$form->hidden(array('name'=> 'action','value'=> 'editWish'))  
                    .$form->hidden(array('name'=> 'ID','value'=> $wishlistArray['ID']))
                    .p($form->text(array('name'=> 'wishPrice','value'=> $wishlistArray['wishPrice'],'class'=>'txtfield')))
                    .p($form->text(array('name'=> 'wishName','value'=> $wishlistArray['wishName'],'class'=>'txtfield')))
                    .p($form->select(array('name'=> 'category','value'=> $moneyCategory),$wishlistArray['wishCategory']))
                    .p($form->select(array('name'=> 'done','value'=> array(0 => 'active',1 => 'done')),$wishlistArray['done']))
                    .p(
                        $form->submit(array('name'=> 'update','value'=> 'update','class'=>'btn')).' '.
                        $form->submit(array('name'=> 'delete','value'=> 'delete','class'=>'btn btn-danger')),
                        'center'
                    )
                    .$form->formEnd();
                    
                    echo modalWindow('operationModal'.$wishlistArray['ID'],'Edit operation #'.$wishlistArray['ID'].':',$operationModalBody,'large','center');
                    
                }
                
            ?>
            </tbody>
        </table>
        </div>
    </div>
</div>



