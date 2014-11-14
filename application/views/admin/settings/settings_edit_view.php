<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/settings/edit/' . $id)?>
<table cellpadding="0" cellspacing="0">
<tbody>
    <tr class="a">
        <td ><?=Form::label('value', 'Значення')?>:</td>
        <td><?=Form::input('value', $data['value'])?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?>
<?=Form::submit('submit1', 'Email', array('class' => 'submit'))?>
</td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>