<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/iwonder/add')?>
<table cellpadding="0" cellspacing="0">
    <tbody>
     <tr class="a">
        <td valign="top"><?=Form::label('content', 'Контент')?>: </td>
        <td><?=Form::textarea('content', $data['content'])?></td>
    </tr>
     <tr class="b">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, true, array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Додати', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>