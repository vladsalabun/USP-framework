<div class="container-fluid">
    <div class="container center">
    <h2><?php echo dialogs(100,$language); ?></h2>
    </div>
</div>
<div class="container-fluid">
<p><code>$pluginConfigUrl</code> - посилання на поточний плагін</p>
<p><code>&plugin_config=documentation</code> - так створювати сторінки для плагіна, береться documentation.php з папки view.</p>

<div class="row">
	<div class="col-lg-8">
    <h3>Templatter:</h3>
    <pre>
<?php
    echo Highlight::render(
"
\$table->tableStart(array('th' => array('',''),'class' => 'table table-sm table-mini'));
\$table->tr(array('',''));
\$table->tr(array(2,'')); // розтягнути на дві колонки
\$table->tableEnd();

\$form->formStart();
\$form->hidden(array('name'=> '','value'=> ''));
\$form->text(array('name'=> '','value'=> '','class'=>'txtfield','placeholder' =>''));
\$form->textarea(array('name'=> '','value'=> '','class'=>'txtfield'));
\$form->uploadFile(array('name'=> ''));
\$form->select(array('name'=> '','value'=> array('key'=>'value')));
\$form->datetime(array('name'=> '','value'=> ''))
\$form->submit(array('name'=> '','value'=> '','class'=>'btn'));
\$form->formEnd();

# HTML:
    echo p('text','classes');
    echo modalLink('windowId', 'anchor','className');
    echo modalWindow('windowId','text in modal header','modal body','large','center');


# Розробка плагінів :
    # Для обробки запитів через форми слід чітко вказати 3 поля
        // що це запит до плагіну, до якої папки плагіну і назву дії)
    .\$form->hidden(array('name'=> 'actionTo','value'=> 'plugin'))
    .\$form->hidden(array('name'=> 'pluginFolder','value'=> 'usp_money'))
    .\$form->hidden(array('name'=> 'action','value'=> 'updateConfig'))

"
    );

?>
    </pre>
    <h3>HTML symbols:</h3>
    ← → ⇽ ⇾ ↗ ↺ ↻ ⇄ ⇏ ⇔
    <br>
    <h3>Bootstrap:</h3>
    <b>.container-fluid</b> - контейнер на ширину екрану<br>
    <b>.table-striped table-mini</b> - компктний стиль для таблиць<br>
    <p>Покраска фона:<br>
        <b>.success</b> - зелений<br>
        <b>.danger</b> - червоний<br>
        <b>.info</b> - синій<br>
        <b>.warning</b> - жовтий<br>
        <b>.active</b> - сірий<br>
    </p>
    <p>Покраска тексту:<br>
        <b>.red</b> - зелений<br>
        <b>.green</b> - червоний<br>
    </p>
    <b><?php echo htmlspecialchars('<mark>...</mark>'); ?></b> - <mark>виділення тексту</mark><br>
    <b><?php echo htmlspecialchars('<abbr>...</abbr>'); ?></b> - <abbr title="Cascading stylesheet">CSS</abbr>
    <p><b><?php echo htmlspecialchars('<blockquote>...</blockquote>'); ?></b> - <blockquote>Бог умер.<footer>Ф.Ницше</footer></blockquote></p>
    <p><b><?php echo htmlspecialchars('<code>...</code>'); ?></b> - Код: <code>$array();</code></p>
    <p><b><?php echo htmlspecialchars('<kbd>...</kbd>'); ?></b> - Комбінація клавіш: <kbd>ctrl + alt + L</kbd></p>

    </div>
    <div class="col-lg-4">
        <h3>Query generator:</h3>
    <ol>
<?php
/*
    foreach (configuration::MYSQL_TABLES as $tableName => $columnArray) {

        echo '<li>
        '.$tableName.':
        <a href="" data-toggle="modal" data-target="#select_'.$tableName.'">select</a> :
        <a href="" data-toggle="modal" data-target="#update_'.$tableName.'">update</a> :
        <a href="" data-toggle="modal" data-target="#insert_'.$tableName.'">insert</a>
        </li>';

        $select = renderSelect($tableName,$columnArray);
        $update = renderUpdate($tableName,$columnArray);
        $insert = renderInsert($tableName,$columnArray);

        echo $pure->modalHtml('select_'.$tableName,'<h3>SELECT FROM: '.$tableName.'</h3>',$select);
        echo $pure->modalHtml('update_'.$tableName,'<h3>UPDATE: '.$tableName.'</h3>',$update);
        echo $pure->modalHtml('insert_'.$tableName,'<h3>INSERT INTO: '.$tableName.'</h3>',$insert);

    }
  */
?>
    </ol>
        <h3>Notepad++ shortkeys:</h3>

    F11 - на весь экран<br>
    Ctrl + Q - закомментировать/раскомментировать<br>
    Ctrl + Shift + Q - закомментировать выделенное<br>
    Tab - добавить табуляции выделенного фрагмента<br>
    Shift + Tab - удалить табуляции выделенного фрагмента<br>
    Ctrl + U - строчные<br>
    Ctrl + Shift + U - прописные<br>
    Alt + U - Все с заглавной<br>
    Ctrl + Shift + Up/Down - переместить строку вверх/вниз<br>
        <h4>Суть шрифтів:</h4>
    <ol align="left">
    <li>Щоб на ньому текст був читабельним</li>
    <li>Щоб виділити важливу інформацію</li>
    <li>Щоб оку приємно було читати</li>
    </ol>
    <h4>Суть програми:</h4>
    <ol align="left">
    <li>Щоб однин клік робив одразу декілька рутинних дій, це економить час і творчу енергію</li>
    <li>Щоб швидко переглядати результати верстки. Програма і так працює в браузері, тому додаткових рухів, щоб переключатись не потрібно</li>
    </ol>
    </div>
</div>
</div>
<?php

    /*
    * @param (string) file name or string of PHP code to be highlighted
    * @param (bool) set to true if @param1 is a file
    * @param (bool) allow caching of processed text (currently work for files only)
    */

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
