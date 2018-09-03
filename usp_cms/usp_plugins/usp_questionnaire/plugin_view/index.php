<?php
  require_once 'header.php';
?>
<div class="row margin20">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">

<?php

    $questionsArray = getQuestionsToCustomer('ukraine');

    $questionsID = 0;
    $questionsArray[$questionsID];

    echo '<p>Питання '.$questionsID.' з '.count($questionsArray).'</p>';
    echo '<h2>'.$questionsArray[$questionsID]['question'].'</h2>';
    echo '<h3>'.$questionsArray[$questionsID]['hint'].'</h3>';
    foreach ($questionsArray[$questionsID]['form'] as $formValue) {
      echo '<p>'.$formValue.'</p>';
    }
/*
    echo '<ol>';
    foreach ($questionsArray as $questionID => $questionArray) {
        echo '<li>'.$questionArray['question'].'</li>';
    }
    echo '</ol>';
*/
?>


</div>
</div>
