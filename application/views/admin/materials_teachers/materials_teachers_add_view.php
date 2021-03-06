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

<div id="adminForms">
<?=Form::open('admin/materialsteachers/add', array('enctype' => 'multipart/form-data'))?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="b">
        <td valign="top"><?=Form::label('intro', 'Короткий опис')?>: </td>
        <td><?=Form::textarea('intro', $data['intro'])?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('author', 'Автор')?>:</td>
        <td><?=Form::input('author', $data['author'])?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('date', 'Дата')?>:</td>
        <td><?=Form::input('date', $date['date'] = date ("Y-m-d") ,array('class'=>'numeric'))?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('menu_id', 'Меню')?>:</td>
        <td>
        <div class="posBlockTwo">
        <?=Form::select('menu_id', $menu_materials_teachers_ad, $data['menu_id'], array('id'=>'menumain'))?>
        </div>
        <div class="posBlockTwo">
        <select name="menu_materials_teachers_id" id="menupid">
            <?  foreach ($menu_pid_all as $menu_pid ): ?>
                <option class="<?=$menu_pid->parent_id?>" value="<?=$menu_pid->id?>" ><?=$menu_pid->title?></option>
            <?endforeach?>
        </select>
        </div>
        </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('url_material', 'Файл')?>:</td>
        <td>
        <?=Form::file('url_material', array('id' => 'multi'))?>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, true, array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Додати', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>