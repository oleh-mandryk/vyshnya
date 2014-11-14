<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($poll_questions->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Запитання</th>
            <th>Функції</th>
        </tr>
    </thead>
<? foreach ($poll_questions as $poll):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>
<tbody>
<tr class="<?=$tr?>">
    <td><?=$poll->id?></td>
    <td><?=HTML::anchor('admin/pollquestions/edit/'. $poll->id, $poll->value)?></td>
    <td>
    
    <?=HTML::anchor('admin/pollquestions/edit/'. $poll->id, HTML::image('media/img/edit.png'))?>
    
    
    </td>
</tr>
<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?else:?>
<p>Немає запитання</p>
<?endif?>