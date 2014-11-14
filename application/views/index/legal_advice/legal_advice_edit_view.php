<br />
<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="indexForms">
<?=Form::open('legaladvice/edit/' . $id)?>
<table cellpadding="0" cellspacing="0">
<tbody>
    <tr class="a">
        <td >Прізвище</td>
        <td><strong><?=$data['first_name']?></strong></td>
    </tr>
    <tr class="b">
        <td >Ім'я</td>
        <td><strong><?=$data['last_name']?></strong></td>
    </tr>
    <tr class="a">
        <td >По батькові</td>
        <td><strong><?=$data['middle_name']?></strong></td>
    </tr>
    <tr class="b">
        <td >Email</td>
        <td><strong><?=$data['email']?></strong></td>
    </tr>
    <tr class="a">
        <td >Рік народження</td>
        <td><strong><?=$data['birthday_date']?></strong></td>
    </tr>
    <tr class="b">
        <td >Місце проживання</td>
        <td><strong><?=$data['address']?></strong></td>
    </tr>
    <tr class="a">
        <td >Контактний телефон</td>
        <td><strong><?=$data['phone']?></strong></td>
    </tr>
    <tr class="b">
        <td >Запитання</td>
        <td><strong><?=$data['question']?></strong></td>
    </tr>
    <tr class="a">
        <td >Дата</td>
        <td><strong><?=$data['date']?></strong></td>
    </tr>
    <tr class="b">
        <td valign="top"><?=Form::label('answer', 'Відповідь')?>: </td>
        <td>
            <?=Form::textarea('answer', $data['answer'], array('id'=>'editor1'))?>
            <script type="text/javascript">
	           CKEDITOR.replace( 'editor1' );
            </script>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('status', 'Публікація')?>:</td>
        <td><?=Form::checkbox('status', 1, (bool) $data['status'], array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>