<?php
    require_once 'header.php';
    
    // Запит категорій плагіну:
    $notesCategories = rubricator::getCategories($usp_notes->tablesNames[1]);
    
    // Формую з категорій список:
    $categorySelection['name'] = 'parentCategory';
    $categorySelection['value'][0] = 'Немає';
    
    foreach ($notesCategories as $notesCategoriesID => $value) {
        // масив назв категорій:
        $categorySelection['value'][$value['ID']] = $value['name'];
    }
    
    if (isset($_GET['edit_category'])) {
        
    } else {}
    
?>
<div class="container-fluid padding20">
    <h2>Редактор рубрики:</h2>
</div>
<div class="container-fluid background4 padding20">

<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
<?php
    // Форма для додавання нових категорій:
    echo 
     $form->formStart()
    .$form->hidden(array('name'=> 'action','value'=> 'addNewCategory'))
    .$form->hidden(array('name'=> 'url','value'=> $pluginConfigUrl.'category'))
    .$form->hidden(array('name'=> 'tableName','value'=> $usp_notes->tablesNames[1]))
    .p($form->text(array('name'=> 'categoryName','value'=> '','class'=>'txtfield','placeholder' =>'Enter new category name')))
    .p($form->text(array('name'=> 'description','value'=> '','class'=>'txtfield','placeholder' =>'Enter description')))
    .p('Позиція: '.$form->select(array('name'=> 'position','value' => array('1'=>'1','2'=>'2','3'=>'3'))))
    .p('Надрубрика: '.$form->select($categorySelection))
    .p($form->submit(array('name'=> 'submit','value'=> 'Додати категорію','class'=>'btn btn-success')))
    .$form->formEnd();
?>
</div>
</div>
<div class="container-fluid padding20">

<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">


</div>
</div>