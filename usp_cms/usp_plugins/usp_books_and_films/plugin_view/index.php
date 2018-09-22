<?php
  require_once 'header.php';
?>
<div class="row margin20">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <h2>Книги:</h2>
<?php
    $bookList = getBooksList(0);
    $bookCount = count($bookList);
    foreach ($bookList as $key => $value) {
        echo  
        '<ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="operation-date">'.$bookCount.'.'.modalLink('modal'.$value['ID'], $value['author'].' «'.$value['name'].'»','className').'</span>
            <span class="operation-date"><span'.$catClass.'>'.$value['date'].'</span>
          </li>
        </ul>';

        $time = strtotime($value['date']);
        $newformat = date('Y-m-d',$time).'T'.date('H:i',$time);
        
        $modalBody = 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_books_and_films'))
        .$form->hidden(array('name'=> 'action','value'=> 'edit'))
        .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))
        .p($form->text(array('name'=> 'author','value'=> $value['author'],'class'=>'txtfield','placeholder' =>'author')))
        .p($form->text(array('name'=> 'name','value'=> $value['name'],'class'=>'txtfield','placeholder' =>'name')))
        .p($form->datetime(array('name'=> 'date','value'=> $newformat)))
        .p($form->submit(array('name'=> '','value'=> 'Зберегти','class'=>'btn btn-success')).' '.
           $form->submit(array('name'=> 'delete','value'=> 'Видалити','class'=>'btn btn-danger')))
        .$form->formEnd();
        
        echo modalWindow('modal'.$value['ID'],'Редагування:',$modalBody,'large','center');
        $bookCount = $bookCount - 1;
    }
?>

        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <h2>Фільми:</h2>
<?php
    $filmList = getBooksList(1);
    $filmCount = count($filmList);
    foreach ($filmList as $key => $value) {
        echo  
        '<ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="operation-date">'.$filmCount.'.'.modalLink('modal'.$value['ID'], $value['name'].' ('.$value['year'].')','className').'</span>
            <span class="operation-date"><span'.$catClass.'>'.$value['date'].'</span>
          </li>
        </ul>';
        
        $time = strtotime($value['date']);
        $newformat = date('Y-m-d',$time).'T'.date('H:i',$time);
        
        $modalBody = 
             $form->formStart()
            .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
            .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_books_and_films'))
            .$form->hidden(array('name'=> 'action','value'=> 'edit'))
            .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))
            .p($form->text(array('name'=> 'name','value'=> $value['name'],'class'=>'txtfield','placeholder' =>'name')))
            .p($form->text(array('name'=> 'year','value'=> $value['year'],'class'=>'txtfield','placeholder' =>'year')))
            .p($form->datetime(array('name'=> 'date','value'=> $newformat)))
            .p($form->submit(array('name'=> 'save','value'=> 'Зберегти','class'=>'btn btn-success')).' '.
               $form->submit(array('name'=> 'delete','value'=> 'Видалити','class'=>'btn btn-danger')))
            .$form->formEnd();
        
        echo modalWindow('modal'.$value['ID'],'Редагування:',$modalBody,'large','center');
        $filmCount = $filmCount - 1;
    }
?>

        </div>
</div>
