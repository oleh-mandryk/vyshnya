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
<?=Form::open('schedulechanges', array('enctype' => 'multipart/form-data'))?>
<table cellpadding="0" cellspacing="0">
<tbody>
    <tr class="a">
    <td><?=Form::label('password_current', 'Файл')?>: <div class="introText">Якщо хочете змінити поточний файл, Вам потрібно вибрати новий файл (*.doc).</div></td>
        
    <td><?=Form::file('url_file', array('id' => 'one'))?></td>
    
    </tr>    
    
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
    </tbody>
</table>
<?=Form::close()?>
</div>