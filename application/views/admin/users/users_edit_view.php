<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/users/edit/' . $user->id)?>
<table cellpadding="0" cellspacing="0">
<tbody>
    <tr class="a">
        <td><?=Form::label('username', 'Логін')?>:</td>
        <td><?=Form::label('username', $user->username)?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('email', 'E-mail')?>:</td>
        <td><?=Form::label('email', $user->email)?></td>
    </tr>
    <tr class="a">
        <td ><?=Form::label('first_name', 'Прізвище')?>:</td>
        <td><?=Form::input('first_name', $user->first_name)?></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('second_name', 'Ім\'я')?>:</td>
        <td><?=Form::input('second_name', $user->second_name)?></td>
    </tr>
    <tr class="a">
        <td ><?=Form::label('third_name', 'По батькові')?>:</td>
        <td><?=Form::input('third_name', $user->third_name)?></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('date_birth', 'Дата народження')?>:</td>
        <td>
        <?=$user->day1_id.'-'.$user->day2_id.'-'.$user->day3_id?>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, (bool) $user->publish_id, array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>