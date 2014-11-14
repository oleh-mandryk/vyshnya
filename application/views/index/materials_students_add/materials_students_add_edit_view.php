<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<?if($errors_cap):?>
<?foreach ($errors_cap as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<div id="indexForms">
<p><strong>Загальні вимоги до оформлення матеріалу:</strong></p>
<ol>
<li>
Весь матеріал, що стосується однієї розробки повинен міститись в одному файлі (за виключенням матеріалів, що поділяються на томи).
</li>
<li>
Завантажуваний файл повинен буди в <strong>zip архіві</strong>.
</li>
<li>
Назва завантажуваного файлу повинна складатись з наступних символів: (<strong>a-z,0-9,-,_,.</strong>).
</li>
</ol>
<?=Form::open('materialsstudentsadd/edit/'. $id, array('enctype' => 'multipart/form-data'))?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td>
        <div class="posBlockTwo">
        <?=Form::input('title', $data['title'])?>
        </div>
        <div class="posBlockTwo">
        <?=Form::label('title_number', '№')?>
        </div>
        <div class="posBlockTwo">
        <?if ($data['title_number'] != 0):?>
        <?=Form::input('title_number', $data['title_number'], array('class'=>'date'))?>
        <?else:?>
        <?=Form::input('title_number', null, array('class'=>'date'))?>
        <?endif;?>
        </div>
        </td>
    </tr>
    <tr class="b">
        <td valign="top"><?=Form::label('intro', 'Короткий опис')?>: </td>
        <td><?=Form::textarea('intro', $data['intro'])?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('author', 'Автор')?>:</td>
        <td><?=Form::input('author', $data['author'], array('readonly'=>'readonly'))?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('date', 'Дата')?>:</td>
        <td><?=Form::input('date', $data['date'], array('class'=>'date','readonly'=>'readonly'))?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('menu_id', 'Меню')?>:</td>
        <td>
        <div class="posBlockTwo">
        <select name="menu_id" id="menumain">
            <?  foreach ($menu_materials_students_ad as $menu_materials_students ): ?>
                <option  value="<?=$menu_materials_students->id?>"  <?if ((isset ($data['menu_id']))and($data['menu_id'] == $menu_materials_students->id)) {echo 'selected="selected"';}?> ><?=$menu_materials_students->title.' ('.$menu_materials_students->parent()->title.')'?></option>
            <?endforeach?>
            </select>
        
        </div>
        <div class="posBlock">
        <select name="menu_materials_students_id" id="menupid">
            <?  foreach ($menu_pid_all as $menu_pid ): ?>
                <option class="<?=$menu_pid->parent_id?>" value="<?=$menu_pid->id?>" <?if ($data['menu_materials_students_id'] == $menu_pid->id) {echo 'selected="selected"';}?>> <?=$menu_pid->title?></option>
            <?endforeach?>
        </select>
        </div>
        </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('url_material', 'Файл')?>:</td>
        <td>
        <?=Form::file('url_material', array('id' => 'multi'))?>
        <?=Html::image('media/img/win_rar.png', array('width' => '16'))?>
        <?=Html::anchor('media/files/materials_students/' .$data['url_material'], $data['url_material'])?>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, (bool) $data['publish_id'], array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>