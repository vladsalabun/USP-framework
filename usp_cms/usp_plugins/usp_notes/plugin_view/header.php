<?php    
    $className = $_GET['name'];
    $usp_notes = new $className;
?>
<nav class="navbar vilet navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&plugin_config=approved">
                    Всі нотатки
                </a>
            </li>
               <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>">
                    На модерації 
                    <?php 
                    
                        
                        if(in_array($_GET['plugin_config'],$notesTypesArray)){
                            $notesType = $_GET['plugin_config'];
                        } else if($_GET['plugin_config'] == '') {
                            $notesType = $notesTypesArray[0];
                        }
                        else {
                            
                        }
                        
                        $notesCount = getNotesCount($notesType);
                        
                        $onModerationCount = getNotesCount('onmoderation');
                        if ($onModerationCount > 0) {
                            echo '[ '.$onModerationCount.' ]';
                        }
                    ?>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&plugin_config=deleted">
                    Відхилені
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&plugin_config=category">
                    Рубрики
                </a>
            </li>
            <li class="nav-item active">
                <?php echo modalLink('addnotes', '+Додати', 'nav-link'); ?>
            </li>

        </ul>
    </div>
</nav>
<div class="container">
<?php 

    if(isset($_GET['plugin_config'])){
        $pluginConfigUrl = $pluginConfigUrl.'&plugin_config='.$notesType;
    } else {
        $pluginConfigUrl = $pluginConfigUrl;
    }

    if($notesCount > 0) {
        echo showPagination($pluginConfigUrl,$_GET['p'],$notesCount,$elementsPerPage); 
    }

?>
</div>
<style>
.vilet {
    
}
.navbar-text {
    color: #FED570 !important;
    margin-right: 20px;
}
.modal-content {
    background: #FAFAFA;
}
.note {
    background: #fff; 
    border-top: 1px solid #f5f5e9;
    padding-top: 20px;
}
.note:hover {

}
.float-left {
    float: left;
}
.noteID {
    color: #CECECD;
    font-size: 14px;
}
.noteText {
    font-size: 17px;
}
.noteDate {
    width: 100%;
    color: #CECECD;
    font-size: 14px;
}
.note-link {
    color: #CECECD;
}
</style>

<?php 

    $notesBody =         
         $form->formStart()
        .$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
        .$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_notes'))
        .$form->hidden(array('name'=> 'action','value'=> 'addNote'))
        .p($form->textarea(array('name'=> 'text','value'=> '','class'=>'big_textarea','placeholder' => 'Wish name')))
        .p($form->submit(array('name'=> 'submit','value'=> 'Додати нотатку','class'=>'btn btn-success')),'center')
        .$form->formEnd();
    echo modalWindow('addnotes','Нова нотатка',$notesBody,1,1);