<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<?if($errors_cap):?>
<?foreach ($errors_cap as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<div id="adminForms">
<?=Form::open('admin/photogallery/add', array('enctype' => 'multipart/form-data'))?>
<table cellpadding="0" cellspacing="0">
    <tbody>
     <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('date', 'Дата')?>:</td>
        <td><?=Form::input('date', $date['date'] = date ("Y-m-d") ,array('class'=>'numeric'))?></td>
    </tr>
    <tr class="a">
    <td><?=Form::label('section_id', 'Категорія')?>:</td>
    <td><?=Form::select('section_id', $menu_photogallery_ad, $data['section_id'])?></td>
    </tr>
    <tr class="b">
    <td><?=Form::label('url_img', 'Зображення')?>:</td>
        
    <td><?=Form::file('url_img', array('id' => 'multi'))?></td>
    
    </tr>    
    <tr class="a">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, true, array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Додати', array('class' => 'submit'))?></td>
    </tr>
</tbody>
</table>
<?=Form::close()?>
</div>