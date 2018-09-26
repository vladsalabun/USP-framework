<?php
  require_once 'header.php';




?>
<div class="row margin20">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<ol>
<?php
        
foreach ($tmpObj->tables as $tableName => $columnArray) {

    echo '<li>
    '.$tableName.':
    <a href="" data-toggle="modal" data-target="#select_'.$tableName.'">select</a> :
    <a href="" data-toggle="modal" data-target="#update_'.$tableName.'">update</a> :
    <a href="" data-toggle="modal" data-target="#insert_'.$tableName.'">insert</a>
    </li>';

    $select = renderSelect($tableName,$columnArray);
    $update = renderUpdate($tableName,$columnArray);
    $insert = renderInsert($tableName,$columnArray);

    echo modalWindow('select_'.$tableName,'<h3>SELECT FROM: '.$tableName.'</h3>',$select,1,1);
    echo modalWindow('update_'.$tableName,'<h3>UPDATE: '.$tableName.'</h3>',$update,1,1);
    echo modalWindow('insert_'.$tableName,'<h3>INSERT INTO: '.$tableName.'</h3>',$insert,1,1);

}

?>
</ol>

    </div>
</div>
<?php

     ###
     function renderSelect($tableName,$columnArray) {

return '<pre align="left">'.
Highlight::render(
'public function '.$tableName.'()
{
 $array = array(
     "SELECT" => "*",
     "FROM" => "'.$tableName.'",
     "WHERE" => "ID = 1",
     //"fetch" => 1,
     //"ORDER" => "ID",
     //"SORT" => "DESC",
 );
 return $this->model->select($array, null);

 // '.$tableName.' fields:
 // '.implode(array_keys($columnArray),', ').'
}', false, true). '</pre>';

     }

     ###
     function renderUpdate($tableName,$columnArray) {

     foreach($columnArray as $column => $param) {
         $set[] = '"'.$column.'" => $_POST[\''.$column.'\']';
     }

return '<pre align="left">'.
Highlight::render(
'public function '.$tableName.'()
{
 $array = array(
     "UPDATE" => \''.$tableName.'\',
     "SET" => array(
         '.implode($set,',
         ').'
     ),
     "WHERE" => array(
         "ID" => $_POST[\'ID\']
     ),
     // "MANUAL_WHERE" => ""
 );

 $this->model->update($array);
 // page to redirect:
 $this->go->go(\''.$tableName.'\');

 // '.$tableName.' fields:
 // '.implode(array_keys($columnArray),', ').'
}', false, true). '</pre>';

     }

     ###
     function renderInsert($tableName,$columnArray)
     {

     foreach($columnArray as $column => $param) {
         $set[] = '"'.$column.'" => $_POST[\''.$column.'\']';
     }

return '<pre align="left">'.
Highlight::render(
'public function '.$tableName.'()
{
 $array = array(
     "INSERT INTO" => \''.$tableName.'\',
     "COLUMNS" => array(
         '.implode($set,',
         ').'
     )
 );
 $this->model->insert($array);
 $this->go->go(\''.$tableName.'\');
}
 // '.$tableName.' fields:
 // '.implode(array_keys($columnArray),', ').'
 ', false, true). '</pre>';
}

?>
