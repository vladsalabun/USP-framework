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
    <form action="" method="POST">
    <input type="hidden" name="action" value="updateConfig">
        <div class="form-group">
            <label>UAH:</label>
            <input type="text" name="uah" class="form-control" value="<?php echo $moneyParams[0]['moneyUAH']; ?>">
        </div>
        <div class="form-group">
            <label>USD:</label>
            <input type="text" name="usd" class="form-control" value="<?php echo $moneyParams[0]['moneyUSD']; ?>">
        </div> 
        <div class="form-group">
            <label>uahToUsd:</label>
            <input type="text" name="uahtousd" class="form-control" value="<?php echo $moneyParams[0]['uahToUsd']; ?>">
        </div>
        <div class="form-group">
            <label>usdToUah:</label>
            <input type="text" name="usdtouah" class="form-control" value="<?php echo $moneyParams[0]['usdToUah']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </p>
</div>
