<br />
<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($legaladvice->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>ПІП</th>
            <th>Рік народження</th>
            <th>Email</th>
            <th>Дата</th>
            <th>Відповідь</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($legaladvice as $one):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$one->id?></td>
    <td><?=HTML::anchor('legaladvice/edit/'. $one->id, $one->first_name.' '.$one->last_name.' '.$one->middle_name)?></td>
    <td><?=$one->birthday_date?></td>
    <td><?=$one->email?></td>
    <td><?=$one->date?></td>
    <td><? if (!empty($one->answer)) {echo '<div class = \'greenText\'>так</div>';} else {echo '<div class = \'redText\'>ні</div>';}?></td>
    <td>
    
    <?=HTML::anchor('legaladvice/edit/'. $one->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('legaladvice/delete/'. $one->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Запитань немає</p>
<?endif?>