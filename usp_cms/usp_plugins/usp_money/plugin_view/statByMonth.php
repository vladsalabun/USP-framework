<?php 
    $q = "LIKE '".$_GET['year'] ."-".$_GET['month'] ."%'";
    $array = array(
        "SELECT" => "*",
        "FROM" => $usp_money->tablesNames[0],
        "WHERE" => "date ".$q." AND moderation = 0",
        "ORDER" => "ID",
        "SORT" => "DESC"
    );
    $moneyByMonth = $db->select($array, null); 
    
?>
<div class="container-fluid delpadding576">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
            <h2 class="margin20">Операції <?php echo $_GET['year'].' '. $monthNames[$_GET['month']].'.';?>:</h2>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                
                foreach ($moneyByMonth as $operationArray) {
                    
                    if ($operationArray['operation'] == 1) {
                        $operation = '<span class="red">-'.$operationArray['money'].' ₴ </span>';
                    } else if ($operationArray['operation'] == 2) {
                        $operation = '<span class="green">+'.$operationArray['money'].' ₴</span>';
                    }
                    
                    echo
                    '<tr>
                      <td>'.$operation.'</d>
                      <td>'.$allCategory[$operationArray['category']].'<br><span class="operation-date">'.$operationArray['date'].'</span></td>
                      <td>'.modalLink('operationModal'.$operationArray['ID'], '<img src="'.$pluginWebURL.'usp_money/plugin_img/edit.png" title="Edit" class="icon20">','className').'</td>
                    </tr>';
                    
                    $operationModalBody =
                     $form->formStart()
                    .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
                    .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
                    .$form->hidden(array('name'=> 'action','value'=> 'editUAHoperation'))  
                    .$form->hidden(array('name'=> 'ID','value'=> $operationArray['ID']))
                    .$form->hidden(array('name'=> 'year','value'=> $_GET['year']))
                    .$form->hidden(array('name'=> 'month','value'=> $_GET['month']))
                   // .p($form->datetime(array('name'=> '','value'=> $operationArray['date'])))
                    .p($form->text(array('name'=> 'money','value'=> $operationArray['money'],'class'=>'txtfield')))
                    .p($form->select(array('name'=> 'category','value'=> $moneyCategory),$operationArray['category']))
                    .p(
                        $form->submit(array('name'=> 'update','value'=> 'update','class'=>'btn')).' '.
                        $form->submit(array('name'=> 'delete','value'=> 'delete','class'=>'btn btn-danger')),
                        'center'
                    )
                    .$form->formEnd();
                    
                    echo modalWindow('operationModal'.$operationArray['ID'],'Edit operation #'.$operationArray['ID'].':',$operationModalBody,'large','center');
                }
                
            ?>
        </tbody>
        </table>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
            <h2 class="margin20"><?php echo $_GET['year'].' '. $monthNames[$_GET['month']].'.';?> в категоріях:</h2>
        <?php 
            $expensies = 0;
            foreach ($yearStat[$_GET['year']][$_GET['month']]['categories'] as $catID => $catValue) {
                if ($catID != 50) {
                    $expensies += $catValue;
                }
            }
            foreach ($yearStat[$_GET['year']][$_GET['month']]['categories'] as $catID => $catValue) {
                          echo '
                             <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>'.$allCategory[$catID].'</span>
                                <span>'.$catValue.' ₴ ('.round(($catValue/$expensies * 100),2).'%)</span>
                              </li>
                            </ul>';
                      }
        ?>
        </div>
    </div>
</div>



