<?php
  require_once 'header.php';
?>
<div class="row margin20">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <h2>Книги:</h2>
<?php
    $linksList = getLinksList();
    $bookCount = count($linksList);
    foreach ($linksList as $key => $value) {
        echo  
        '<ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="operation-date">'.$bookCount.'. <a href="'.$value['url'].'" target="_blank">'.$value['anchor'].'</a></span>
            <span class="operation-date"><span'.$catClass.'>'.modalLink('modal'.$value['ID'],$value['date'],'className').'</span>
          </li>
        </ul>';

        $time = strtotime($value['date']);
        $newformat = date('Y-m-d',$time).'T'.date('H:i',$time);
        
        $modalBody = 
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_links_abyss'))
        .$form->hidden(array('name'=> 'action','value'=> 'edit'))
        .$form->hidden(array('name'=> 'ID','value'=> $value['ID']))
        .p($form->text(array('name'=> 'anchor','value'=> $value['anchor'],'class'=>'txtfield','placeholder' =>'anchor')))
        .p($form->text(array('name'=> 'url','value'=> $value['url'],'class'=>'txtfield','placeholder' =>'url')))
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
      

        </div>
</div>
