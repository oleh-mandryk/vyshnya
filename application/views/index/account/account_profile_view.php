<br />
<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($errors):?>
<?foreach ($errors as $error):?>
<? if (is_array($error)){ ?>
<?foreach ($error as $item):?>
<div class="error"><?=$item?></div>
<?endforeach?>
<?} else {?>
<div class="error"><?=$error?></div>
<?}?>
<?endforeach?>
<?endif?>

<div id="indexForms">
<?=Form::open('account/profile')?>
<table cellpadding="0" cellspacing="0">
<thead>
<tr>
<th colspan="2">Реєстраційні дані</th>
</tr>
</thead>
<tbody>
    <tr class="a">
        <td><?=Form::label('username', 'Логін')?>:</td>
        <td><strong><?=Form::label('second_name', $user->username)?></strong></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('password_current', 'Поточний пароль')?>: <div class="introText">Ви повинні вказати ваш поточний пароль, якщо хочете його змінити</div></td>
        <td>
            <div class="posBlockTwo"><?=Form::password('password_current')?></div>
            <div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('password', 'Новий пароль')?>: <div class="introText">Вказуйте пароль тільки якщо ви хочете його поміняти</div></td>
        <td>
            <div class="posBlockTwo"><?=Form::password('password')?></div>
            <div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div>
        </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('password_confirm', 'Підтвердження паролю')?>: <div class="introText">Підтверджувати пароль потрібно в тому випадку, якщо ви змінили його вище</div></td>
        <td>
            <div class="posBlockTwo"><?=Form::password('password_confirm')?></div>
            <div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('first_name', 'Прізвище')?>:</td>
        <td>
            <div class="posBlockTwo"><?=Form::input('first_name', $user->first_name)?></div>
            <div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div>
        </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('second_name', 'Ім\'я')?>:</td>
        <td><?=Form::label('second_name', $user->second_name)?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('third_name', 'По батькові')?>:</td>
        <td><?=Form::label('third_name', $user->third_name)?></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('date_birth', 'Дата народження')?>:</td>
        <td><?=$user->day1_id.'-'.$user->day2_id.'-'.$user->day3_id?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('email', 'Email')?>:</td>
        <td>
            <div class="posBlockTwo"><?=Form::input('email', $user->email)?></div>
            <div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div>
        </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('date', 'Дата реєстрації')?>:</td>
        <td><?=Form::label('date', $user->date)?></td>
    </tr>
    <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
    </tbody>
</table>
<?=Form::close()?>
</div>