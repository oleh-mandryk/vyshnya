<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/menuphotogallery/edit/' . $id)?>
<table cellpadding="0" cellspacing="0">
<tbody>
    <tr class="a">
        <td ><?=Form::label('alias', 'Аліас')?>:</td>
        <td><?=Form::input('alias', $data['alias'])?></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="a">
        <td valign="top"><?=Form::label('intro', 'Короткий опис')?>: </td>
        <td><?=Form::textarea('intro', $data['intro'])?></td>
    </tr>
     <tr class="b">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, (bool) $data['publish_id'], array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>