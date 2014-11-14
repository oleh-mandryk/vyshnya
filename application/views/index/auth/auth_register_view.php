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

<?if($errors_cap):?>
<?foreach ($errors_cap as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<div id="indexForms">
<p>Реєстрація тільки для студентів і викладачів Вишнянського коледжу ЛНАУ. Для цього, щоб система Вас зареєструвала необідно ввести коректні дані про себе. Якщо реєстрація пройшла успішно, в найблищий час вам на пошту прийде лист. Після реєстрації Ви отримаєте доступ до закритих матеріалів сайту.</p>
<?=Form::open('register')?>
<table cellpadding="0" cellspacing="0">
<thead>
<tr>
    <th colspan="2">Реєстраційні дані</th>
</tr>
</thead>
<tbody>
    <tr class="a">
        <td><?=Form::label('type_register', 'Тип реєстрації')?>:</td>
        <td>
        <div class="posBlock"><input type="radio" name="type_register" value="1" <?if ((isset ($_POST['type_register']))and($_POST['type_register'] == '1')) {echo 'checked="checked"';}?> /></div>
        <div class="posBlockTwo">Викладач ВКЛНАУ</div>
        <div class="posBlock"><input type="radio" name="type_register" value="2" <?if ((isset ($_POST['type_register']))and($_POST['type_register'] == '2')) {echo 'checked="checked"';}?> /></div>
        <div class="posBlockTwo">Студент ВКЛНАУ</div>
        <div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div>
        </td>
    </tr>
    <tr class="b">
        <td><?=Form::label('username', 'Логін')?>:</td>
        <td><div class="posBlockTwo"><?=Form::input('username', $data['username'])?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('first_name', 'Прізвище')?>:</td>
        <td><div class="posBlockTwo"><?=Form::input('first_name', $data['first_name'])?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('second_name', 'Ім\'я')?>:</td>
        <td><div class="posBlockTwo"><?=Form::input('second_name', $data['second_name'])?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('third_name', 'По батькові')?>:</td>
        <td><div class="posBlockTwo"><?=Form::input('third_name', $data['third_name'])?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('date_birth', 'Дата народження')?>:</td>
        <td>
        <div class="posBlockTwo">
        <select class="indSel" name="day1_id">
            <option value="">Виберіть день</option>
            <option value="01" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '01')) {echo 'selected="selected"';}?>>1</option>
            <option value="02" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '02')) {echo 'selected="selected"';}?>>2</option>
            <option value="03" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '03')) {echo 'selected="selected"';}?>>3</option>
            <option value="04" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '04')) {echo 'selected="selected"';}?>>4</option>
            <option value="05" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '05')) {echo 'selected="selected"';}?>>5</option>
            <option value="06" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '06')) {echo 'selected="selected"';}?>>6</option>
            <option value="07" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '07')) {echo 'selected="selected"';}?>>7</option>
            <option value="08" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '08')) {echo 'selected="selected"';}?>>8</option>
            <option value="09" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '09')) {echo 'selected="selected"';}?>>9</option>
            <option value="10" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '10')) {echo 'selected="selected"';}?>>10</option>
            <option value="11" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '11')) {echo 'selected="selected"';}?>>11</option>
            <option value="12" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '12')) {echo 'selected="selected"';}?>>12</option>
            <option value="13" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '13')) {echo 'selected="selected"';}?>>13</option>
            <option value="14" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '14')) {echo 'selected="selected"';}?>>14</option>
            <option value="15" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '15')) {echo 'selected="selected"';}?>>15</option>
            <option value="16" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '16')) {echo 'selected="selected"';}?>>16</option>
            <option value="17" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '17')) {echo 'selected="selected"';}?>>17</option>
            <option value="18" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '18')) {echo 'selected="selected"';}?>>18</option>
            <option value="19" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '19')) {echo 'selected="selected"';}?>>19</option>
            <option value="20" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '20')) {echo 'selected="selected"';}?>>20</option>
            <option value="21" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '21')) {echo 'selected="selected"';}?>>21</option>
            <option value="22" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '22')) {echo 'selected="selected"';}?>>22</option>
            <option value="23" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '23')) {echo 'selected="selected"';}?>>23</option>
            <option value="24" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '24')) {echo 'selected="selected"';}?>>24</option>
            <option value="25" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '25')) {echo 'selected="selected"';}?>>25</option>
            <option value="26" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '26')) {echo 'selected="selected"';}?>>26</option>
            <option value="27" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '27')) {echo 'selected="selected"';}?>>27</option>
            <option value="28" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '28')) {echo 'selected="selected"';}?>>28</option>
            <option value="29" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '29')) {echo 'selected="selected"';}?>>29</option>
            <option value="30" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '30')) {echo 'selected="selected"';}?>>30</option>
            <option value="31" <?if ((isset ($_POST['day1_id']))and($_POST['day1_id'] == '31')) {echo 'selected="selected"';}?>>31</option>
        </select>
        </div>
        <div class="posBlockTwo">
        <select class="indSel" name="day2_id">
            <option value="">Виберіть місяць</option>
            <option value="01" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '01')) {echo 'selected="selected"';}?>>січень</option>
            <option value="02" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '02')) {echo 'selected="selected"';}?>>лютий</option>
            <option value="03" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '03')) {echo 'selected="selected"';}?>>березень</option>
            <option value="04" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '04')) {echo 'selected="selected"';}?>>квітень</option>
            <option value="05" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '05')) {echo 'selected="selected"';}?>>травань</option>
            <option value="06" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '06')) {echo 'selected="selected"';}?>>червень</option>
            <option value="07" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '07')) {echo 'selected="selected"';}?>>липень</option>
            <option value="08" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '08')) {echo 'selected="selected"';}?>>серпень</option>
            <option value="09" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '09')) {echo 'selected="selected"';}?>>вересень</option>
            <option value="10" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '10')) {echo 'selected="selected"';}?>>жовтень</option>
            <option value="11" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '11')) {echo 'selected="selected"';}?>>листопад</option>
            <option value="12" <?if ((isset ($_POST['day2_id']))and($_POST['day2_id'] == '12')) {echo 'selected="selected"';}?>>грудень</option>
        </select>
        </div>
        <div class="posBlockTwo"><?=Form::input('day3_id', $data['day3_id'], array('class' => 'dateInput'))?></div>
        <div class="posBlock"><img title="Ці поля необхідно заповнити" src="/media/img/icon_required.png"/></div>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('email', 'Email')?>:</td>
        <td><div class="posBlockTwo"><?=Form::input('email', $data['email'])?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('password', 'Пароль')?>:</td>
        <td><div class="posBlockTwo"><?=Form::password('password', $data['password'])?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('password_confirm', 'Підтвердження паролю')?>:</td>
        <td><div class="posBlockTwo"><?=Form::password('password_confirm', $data['password_confirm'])?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="b">
        <td><?=Form::label('captcha', 'Введіть цифри з картинки')?>:</td>
        <td><?=$captcha; ?><div class="posBlockTwo"><?=Form::input('captcha', null, array('class' => 'numeric'))?></div><div class="posBlock"><img title="Це поле необхідно заповнити" src="/media/img/icon_required.png"/></div></td>
    </tr>
    <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зареєструватись', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>