<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/wingedphrases/add', 'Додати')?>
</div>

<?if($wingedphrases->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Контент</th>
            <th>Автор</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($wingedphrases as $winged):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$winged->id?></td>
    <td><?=HTML::anchor('admin/wingedphrases/edit/'. $winged->id, $winged->content)?></td>
    <td><?=$winged->author?></td>
    <td>
    
    <?=HTML::anchor('admin/wingedphrases/edit/'. $winged->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/wingedphrases/delete/'. $winged->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає крилатих фраз</p>
<?endif?>