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
<?=Form::open('admin/menumaterialsteachers/add', array('enctype' => 'multipart/form-data'))?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('menu_id', 'Головне меню')?>:</td>
        <td><?=Form::select('menu_id', $menu_materials_teachers_ad, $data['menu_id'], array('id'=>'menumain'))?></td>
    </tr>
    <tr class="a">
    <td><?=Form::label('small_img_url', 'Міні-іконка')?>:</td>
        
    <td><?=Form::file('small_img_url', array('id' => 'multi'))?></td>
    
    </tr>
    
    <tr class="b">
        <td><?=Form::label('way_id', 'Куди')?>:</td>
        <td>
        <div class="posBlock"><?=Form::radio('way_id', 1, TRUE)?></div>
        <div class="posBlockTwo">На кінець</div>
        <div class="posBlock"><?=Form::radio('way_id', 2)?></div>
        <div class="posBlockTwo">На початок</div>
        <div class="posBlock"><?=Form::radio('way_id', 3)?></div>
        <div class="posBlockTwo">Після</div>
        <div class="posBlock">
        <select name="menu_pid" id="menupid">
            <?  foreach ($menu_pid_all as $menu_pid ): ?>
                <option class="<?=$menu_pid->parent_id?>" value="<?=$menu_pid->id?>" ><?=$menu_pid->title?></option>
            <?endforeach?>
        </select>
        </div>
        </td>
    </tr>
   <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Додати', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>