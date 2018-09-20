<nav class="navbar vilet navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>">
                    На модерації 
                    <?php 
                        $onModeration = getNotesCount('onModeration');
                        if ($onModeration > 0) {
                            echo '[ '.getNotesCount('onModeration').' ]';
                        }
                    ?>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&plugin_config=approved">
                    Одобрені
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $pluginConfigUrl; ?>&plugin_config=deleted">
                    Відхилені
                </a>
            </li>
            <li class="nav-item active">
                <?php echo modalLink('addnotes', '+Додати', 'nav-link'); ?>
            </li>

        </ul>
    </div>
</nav>
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
    border-bottom: 1px solid #f5f5e9;
    padding: 20px;
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
    font-size: 26px;
}
.noteDate {
    width: 100%;
    color: #CECECD;
    font-size: 14px;
}
.note-link {
    color: #000;
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