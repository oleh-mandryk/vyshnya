<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<div id="indexForms">
<p>Забули пароль? Введіть вашу адресу електронної пошти для Вашого облікового запису, на який буде вислана інформація для відновлення пароля.</p>
<?=Form::open('restore_password')?>
<table cellpadding="0" cellspacing="0">
<tbody>
    <tr class="a">
        <td><?=Form::label('email', 'Email')?>:</td>
        <td>
        <div class="posBlockTwo"><?=Form::input('email')?></div>
        <div class="posBlockTwo"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div>
        <div class="posBlockTwo">Наприклад: <em>example@gmail.com</em></div>
        </td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Відправити', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>