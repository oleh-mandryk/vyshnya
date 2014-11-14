<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/menumain/edit/'. $id)?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    
    <tr class="b">
        <td><?=Form::label('page_id', 'Сторінка')?>:</td>
        <td><?=Form::select('page_id', $pages, $data['page_id'])?></td>
    </tr>
    
    <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
    
    
</tbody>
</table>
<?=Form::close()?>
</div>