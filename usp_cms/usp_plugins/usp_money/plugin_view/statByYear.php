   <div class="container-fluid margin30">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h2>По місяцях:</h2>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                
                foreach ($yearStat as $year => $monthArray) {
                    foreach ($monthArray as $month => $monthStat) {
                        if ($month == 'profit' or $month == 'expenses' or $month == 'categories') {
                        } else {
                            echo
                            '<tr>
                              <th scope="row"><a href="">'.$year.' '. $monthNames[$month].'</a></th>
                              <td><span class="green">'.$monthStat['profit'].' ₴</span></td>
                              <td><span class="red">-'.$monthStat['expenses'].' ₴</span></td>
                            </tr>';
                        }
                    }
                }
                
            ?>
        </tbody>
        </table>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h2>По роках:</h2>
            <table class="table table-striped table-mini">
            <tbody>
            <?php
                foreach ($yearStat as $year => $yearArray) {
                    echo
                    '<tr>
                      <th scope="row">'.$year.' рік:</th>
                      <td><span class="green">'.$yearArray['profit'].' ₴</span></td>
                      <td><span class="red">-'.$yearArray['expenses'].' ₴</span></td>
                    </tr>';
                    echo
                    '<tr>
                      <td colspan="3">';
                      foreach ($yearArray['categories'] as $catID => $catValue) {
                          echo '
                             <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>'.$allCategory[$catID].'</span>
                                <span>'.$catValue.' ₴</span>
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



