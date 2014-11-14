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
<?=Form::open('admin/presentation/edit/'. $id, array('enctype' => 'multipart/form-data'))?>
<table cellpadding="0" cellspacing="0">
    <tbody>
     <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="b">
        <td valign="top"><?=Form::label('content', 'Контент')?>: </td>
        <td>
            <?=Form::textarea('content', $data['content'], array('id'=>'editor1'))?>
            <script type="text/javascript">
	           CKEDITOR.replace( 'editor1' );
            </script>
        </td>
    </tr>
    <tr class="a">
        <td><?=Form::label('page_id', 'Сторінка')?>:</td>
        <td><?=Form::select('page_id', $pages, $data['page_id'])?></td>
    </tr>
    <tr class="b">
    <td><?=Form::label('img_url', 'Зображення')?>:</td>
    <td>
    <?=Form::file('img_url', array('id' => 'multi'))?>
    <?=HTML::image('media/img/presentation/'.$data['img_url'], array('alt' => 'Зображення'))?>
    </td>
    
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