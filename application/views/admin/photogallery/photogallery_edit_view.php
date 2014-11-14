<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>

<div id="adminForms">
<?=Form::open('admin/photogallery/edit/'. $id)?>
<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('date', 'Дата')?>:</td>
        <td><?=Form::input('date', $data['date'], array('class'=>'numeric'))?></td>
    </tr>
    <tr class="a">
    <td><?=Form::label('section_id', 'Категорія')?>:</td>
    <td><?=Form::select('section_id', $menu_photogallery_ad, $data['section_id'])?></td>
    </tr>
    <tr class="b">
    <td><?=Form::label('url_img', 'Зображення')?>:</td>
    <td><?=HTML::image('media/img/photogallery/small/'.$data['url_img'], array('alt' => 'Зображення'))?></td>
    </tr>
     
     <tr class="a">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, (bool) $data['publish_id'], array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="b">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
    
    
</tbody>
</table>
<?=Form::close()?>
</div>