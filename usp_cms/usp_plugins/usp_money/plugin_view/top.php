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
                    Money
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>">
                    Dollars
                </a>
            </li> 
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>">
                    Wishlist
                </a>
            </li>            
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&plugin_config=money_config">Config money</a>
            </li>
            <div class="navbar-text">
                <?php echo $moneyParams[0]['moneyUAH']; ?> ₴
            </div>           
            <div class="navbar-text">
                <?php echo $moneyParams[0]['moneyUSD']; ?> $
            </div>
        </ul>
    </div>
</nav>
<style>
.vilet {
    background: #56004F !important;
}
.navbar-text {
    color: #FED570 !important;
    margin-left: 20px;
}

</style>