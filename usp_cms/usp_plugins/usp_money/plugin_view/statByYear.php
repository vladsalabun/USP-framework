   <div class="container-fluid margin30">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h2>По місяцях:</h2>
            <table class="table">
            <tbody>
            <?php
                
                foreach ($yearStat as $year => $monthArray) {
                    foreach ($monthArray as $month => $monthStat) {
                        if ($month == 'profit' or $month == 'expenses' or $month == 'categories') {
                        } else {
                            echo
                            '<tr>
                              <th scope="row">'.$year.' '. $monthNames[$month].'</th>
                              <td>'.$monthStat['profit'].' ₴</td>
                              <td>'.$monthStat['expenses'].' ₴</td>
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
            <table class="table">
            <tbody>
            <?php
                foreach ($yearStat as $year => $yearArray) {
                    echo
                    '<tr>
                      <th scope="row">'.$year.'</th>
                      <td>'.$yearArray['profit'].' ₴</td>
                      <td>'.$yearArray['expenses'].' ₴</td>
                    </tr>';
                    echo
                    '<tr>
                      <td colspan="3"><h3 class="center">'.$year.' в категоріях:</h3>';
                      foreach ($yearArray['categories'] as $catID => $catValue) {
                          echo '
                             <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                '.$allCategory[$catID].'
                                <span class="badge badge-primary badge-pill">'.$catValue.' ₴</span>
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
            <h2>...</h2>
            <table class="table">
            <tbody>
            <?php
                /*
                foreach ($yearStat as $year => $yearArray) {
                    foreach ($yearArray['categories'] as $year => $yearArray) {
                        echo
                        '<tr>
                          <th scope="row">'.$year.'</th>
                          <td>'.$yearArray['profit'].' ₴</td>
                          <td>'.$yearArray['expenses'].' ₴</td>
                        </tr>';
                    }
                }
                */
            ?>
            </tbody>
            </table>            
        </div>
    </div>
</div>



