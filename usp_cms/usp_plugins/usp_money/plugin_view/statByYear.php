<?php
    $array = array(
        "SELECT" => "*",
        "FROM" => $usp_money->tablesNames[3]
    );
    $moneyParams = $db->select($array, null); 
    
    
    // знаходжу першу дату в базі:
    $array = array(
        "SELECT" => "MIN(date)",
        "FROM" => $usp_money->tablesNames[0],
    );
    $firstDay = $db->select($array, null); 
    
    // знаходжу різницю у днях:
    $array = array(
        "SELECT" => "DATEDIFF(NOW(), `date`) AS days",
        "FROM" => $usp_money->tablesNames[0],
        "LIMIT" => 1
    );
    $dayDiff = $db->select($array, null);

    // Пройшло днів:
    $days = $dayDiff[0]['days'];
    
    // Розраховую суму зафіксованих витрат за ці дні:
    $expensesSum = 0;
    foreach ($yearStat as $year => $yearArray) {
        $expensesSum += $yearArray['expenses'];
    }
    
    // Середня сума витрат в день:
    $expensesPerDay = floor($expensesSum / $days);
    //
    $dollarsToUAH = $moneyParams[0]['moneyUSD'] * $moneyParams[0]['usdToUah'];
    $daysLiving = floor($dollarsToUAH / $expensesPerDay);
    
    /* Скільки я потратив сьогодні? */
        $array = array(
        "SELECT" => "*",
        "FROM" => $usp_money->tablesNames[0],
        "WHERE" => "DATE(date) > DATE(CAST(NOW() - INTERVAL 1 DAY AS DATE))",
    );
    $spendMoneyLast24hArray = $db->select($array, null); 
    
    function getLast24hSpendings($spendMoneyLast24hArray) {
        
        $spendings = 0;
        
        foreach ($spendMoneyLast24hArray as $key => $value) {
            if($value['operation'] == 1) {

                $spendings += $value['money'];
            }
        }
        
        return $spendings;
    }

    /***********************************************/
    
    /* Скільки я потратив цього місяця? */
        $array = array(
        "SELECT" => "*",
        "FROM" => $usp_money->tablesNames[0],
        "WHERE" => "YEAR(date) = ".date('Y')." AND MONTH(date) = ".date('m'),
    );
    
    $spendMoneyMonthArray = $db->select($array, null);  
    
    $secondPrice = round($expensesPerDay/(24*60*60),7);
?>
<div class="container-fluid margin30 delpadding576">
    <div class="row margin20 delpadding576">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
        Сьогодні можна витратити ще: <span id="iTimer"><?php echo ( $expensesPerDay - getLast24hSpendings($spendMoneyLast24hArray));?></span> ₴<br>
        Цього місяця можна витратити ще: <?php echo (($expensesPerDay * 30) - getLast24hSpendings($spendMoneyMonthArray));?> ₴<br>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
        Вартість секунди: <?php echo $secondPrice; ?> ₴<br>
        Вартість одного дня: <?php echo $expensesPerDay; ?> ₴<br>
        Вартість одного місяця: <?php echo $expensesPerDay * 30; ?> ₴<br>
        Вистачить на: <?php echo $daysLiving; ?> днів (<?php echo round($daysLiving / 365, 2); ?> років)
        </div>
    </div>
<script>

    var iTimer = <?php echo $secondPrice; ?>;
    
    // bad habits
    function increaseTime()
    {
        var t = $("span#iTimer").text();
        var next = parseFloat(t) + iTimer;
        $("span#iTimer").text(next);
    }

    // Запуск функции по таймеру:
    $(document).ready(function(){
        setInterval('increaseTime()',1000);
    });

    // Запуск функции по таймеру:
    $(document).ready(function(){
        show();
        // На рабочем сервере установи интервал 5 секунд: 
        setInterval('show()',1000);
    });
</script>
    <div class="row delpadding576">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
            <h2 class="margin20">По місяцях:</h2>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                foreach ($yearStat as $year => $monthArray) {
                    foreach ($monthArray as $month => $monthStat) {
                        if ($month == 'profit' or $month == 'expenses' or $month == 'categories') {
                        } else {
                            echo
                            '<tr>
                              <td><a href="'.$pluginConfigUrl.'&year='.$year.'&month='.$month.'">'.$year.' '. $monthNames[$month].'</a></td>
                              <td><span class="green">+'.$monthStat['profit'].' ₴</span></td>
                              <td><span class="red">-'.$monthStat['expenses'].' ₴</span></td>
                            </tr>';
                        }
                    }
                }
                
            ?>
        </tbody>
        </table>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 delpadding576">
            <h2 class="margin20">По роках:</h2>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                foreach ($yearStat as $year => $yearArray) {
                    echo
                    '<tr>
                      <td>'.$year.' рік:</td>
                      <td><span class="green">'.$yearArray['profit'].' ₴</span></td>
                      <td><span class="red">-'.$yearArray['expenses'].' ₴</span></td>
                    </tr>';
                    echo
                    '<tr>
                      <td colspan="3">';
                      
                      $currentYearMonth = -1;
                      foreach ($yearArray as $yearArraykey => $yearArraМalue) {
                          if (array_key_exists($yearArraykey,$monthNames)) {
                              $currentYearMonth = $currentYearMonth + 1;
                          }
                      }
                      
                      if($currentYearMonth == 0) {
                          $currentYearMonth = 1;
                      }
                      
                      
                      foreach ($yearArray['categories'] as $catID => $catValue) {
                          
                          if ($catID != 50) {
                              $percent = '('.round(($catValue/$yearArray['expenses'] * 100),2).'%, '.round($catValue/$currentYearMonth,0).' ₴/міс.)';
                              $catClass = ' class="red"';
                              $minus = '-';
                          } else {
                              $percent = '';
                              $catClass = ' class="green"';
                              $minus = '';
                          }
                          
                          echo '
                             <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="operation-date"><a href="'.$pluginConfigUrl.'&category='.$catID.'">'.$allCategory[$catID].'</a></span>
                                <span class="operation-date"><span'.$catClass.'>'.$minus.$catValue.' ₴</span> '.$percent.'</span>
                              </li>
                            </ul>';
                      }
                    echo '
                    </td>
                    </tr>';
                }
            ?>
            </tbody>
            </table>           
        </div>
    </div>
</div>



