<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/menumaterialsstudents/edit/'. $id)?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('menu_id', 'Підпункт меню (предмет)')?>:</td>
        <td><?=Form::select('menu_id', $menu_materials_students_ad, $data['menu_id'], array('id'=>'menumain'))?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('small_img_url', 'Міні-іконка')?>:</td>
        <td><?=HTML::image('media/img/small_img_material/'.$data['small_img_url'], array('alt' => 'Міні-іконка'))?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>