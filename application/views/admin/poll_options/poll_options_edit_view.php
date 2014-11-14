<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/polloptions/edit/' . $id)?>
<table cellpadding="0" cellspacing="0">
<tbody>
    <tr class="a">
        <td ><?=Form::label('value', 'Відповідь')?>:</td>
        <td><?=Form::input('value', $data['value'])?></td>
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