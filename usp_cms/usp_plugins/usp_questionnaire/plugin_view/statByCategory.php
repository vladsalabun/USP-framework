<?php 
    $array = array(
        "SELECT" => "*",
        "FROM" => $moneytablesArray[0],
        "WHERE" => "category = ".$_GET['category']." AND moderation = 0",
        "ORDER" => "ID",
        "SORT" => "DESC"
    );
    $moneyCategory = $db->select($array, null); 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h2 class="margin20">Операції по категорії <?php echo $allCategory[$_GET['category']];?>:</h2>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                
                foreach ($moneyCategory as $operationArray) {
                    
                    if ($operationArray['operation'] == 1) {
                        $operation = '<span class="red">-'.$operationArray['money'].' ₴ </span>';
                    } else if ($operationArray['operation'] == 2) {
                        $operation = '<span class="green">+'.$operationArray['money'].' ₴</span>';
                    }
                    
                    echo
                    '<tr>
                      <td>'.$operation.'</d>
                      <td>'.$allCategory[$operationArray['category']].'</td>
                      <td>'.$operationArray['date'].'</td>
                    </tr>';
                    
                }
                
            ?>
        </tbody>
        </table>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        </div>
    </div>
</div>



