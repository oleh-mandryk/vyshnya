<?if($errors):?>
<?foreach ($errors as $error):?>
<div class="error"><?=$error?></div>
<?endforeach?>
<?endif?>
<div id="adminForms">
<?=Form::open('admin/news/edit/'. $id)?>
<table cellpadding="0" cellspacing="0">
    <tbody>
     <tr class="a">
        <td ><?=Form::label('description', 'Опис')?>:</td>
        <td><?=Form::input('description', $data['description'])?></td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('keywords', 'Ключові слова')?>:</td>
        <td><?=Form::input('keywords', $data['keywords'])?></td>
    </tr>
    <tr class="a">
        <td><?=Form::label('title', 'Назва')?>:</td>
        <td><?=Form::input('title', $data['title'])?></td>
    </tr>
    <tr class="b">
        <td valign="top"><?=Form::label('intro', 'Короткий опис')?>: </td>
        <td>
            <?=Form::textarea('intro', $data['intro'], array('id'=>'editor1'))?>
            <script type="text/javascript">
	           CKEDITOR.replace( 'editor1' );
            </script>
        </td>
    </tr>
   
    <tr class="a">
        <td valign="top"><?=Form::label('content', 'Контент')?>: </td>
        <td>
            <?=Form::textarea('content', $data['content'], array('id'=>'editor2'))?>
            <script type="text/javascript">
	           CKEDITOR.replace( 'editor2' );
            </script>
        </td>
    </tr>
    <tr class="b">
        <td ><?=Form::label('date', 'Дата')?>:</td>
        <td><?=Form::input('date', $data['date'], array('class'=>'numeric'))?></td>
    </tr>
     <tr class="a">
    <td><?=Form::label('small_img_url', 'Міні-іконка')?>:</td>
    <td><?=HTML::image('media/img/small_img_material/'.$data['small_img_url'], array('alt' => 'Міні-іконка'))?></td>
    
    </tr>
     
    <tr class="b">
        <td><?=Form::label('publish_id', 'Публікація')?>:</td>
        <td><?=Form::checkbox('publish_id', 1, (bool) $data['publish_id'], array('class' => 'widthAuto'))?></td>
    </tr>
    <tr class="a">
        <td colspan="2" align="center"><?=Form::submit('submit', 'Зберегти', array('class' => 'submit'))?></td>
    </tr>
    
    
</tbody>
</table>
<?=Form::close()?>
</div>