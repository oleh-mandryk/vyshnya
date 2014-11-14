<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/newsletter')?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td ><?=Form::label('subject', 'Тема листа')?>:</td>
        <td><?=Form::input('subject', $data['subject'])?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('email_from', 'Email з')?>:</td>
        <td><?=Form::input('email_from', $data['email_from'])?></td>
    </tr>
    <tr class="a">
        <td ><?=Form::label('email_quantity', 'Кількість email')?>:</td>
        <td><?=Form::input('email_quantity', $data['email_quantity'])?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('emails_quantity', 'Залишилось email')?>:</td>
        <td><?=$emails_quantity?></td>
    </tr>
    <tr class="a">
        <td ><?=Form::label('type', 'Рубрики email')?>:</td>
        <td>
            <?  foreach ($email_type as $s): ?>
            <label><?=$s->name?></label>
            <input class="widthAuto" type="checkbox" name="type_id[]" value="<?=$s->id?>" />
                
            <?endforeach?>
        </td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('text_massage', 'Шаблон')?>:</td>
        <td><?=Form::textarea('text_massage', $data['text_massage'])?></td>    
    </tr>
    <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Відіслати', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>