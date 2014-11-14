<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>
<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/schedulestalessons/add/'.$id, 'Додати')?>
</div>

<?if($lessons_current_monday->count() > 0):?>
<strong><?=$group_title->title?></strong>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Пара</th>
            <th>Назва предмету</th>
            <th>Викладач</th>
            <th>Аудиторія</th>
            <th>Функції</th>
        </tr>
    </thead>


<? $tr=null; $k=1; $result=null;?>
<?if (($lessons_current_monday->count() != 0)):?>
<tr class="c">
<td colspan="5">Понеділок</td>
</tr>
<? foreach ($lessons_current_monday as $group):?>
<?if ($group->znam_chusel_id == 1) {?>
<?$result=$k%2;?>
<?}
else
{
    $result=$k%2; if ($group->znam_chusel_id == 2) { $k--;};
}?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>

<tr class="<?=$tr?>">
    <?if ($group->znam_chusel_id == 1) {?>
    <td><?=$group->lesson_id?></td>
    <?}
    else
    {?>
       <?if ($group->znam_chusel_id == 2){?>
       <td rowspan="2"><?=$group->lesson_id?></td>
       <?}?> 
    <?}?>
    <td><?=$group->schedule_subject_con->title?></td>
    <td>
    <?=$group->schedule_teacher1_con->title?>
    <? if ($group->teacher2_id!=0){echo ', '.$group->schedule_teacher2_con->title;}?>
    <? if ($group->teacher3_id!=0){echo ', '.$group->schedule_teacher3_con->title;}?>
    <? if ($group->teacher4_id!=0){echo ', '.$group->schedule_teacher4_con->title;}?>
    </td>
    <td>
    <?=$group->schedule_audience1_con->title?>
    <? if ($group->audience2_id!=0){echo ', '.$group->schedule_audience2_con->title;}?>
    </td>
    <td>
    
    <?=HTML::anchor('admin/schedulestalessons/edit/'. $group->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestalessons/delete/'. $group->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
<?endif?>

<? $tr=null; $k=1; $result=null;?>
<?if (($lessons_current_tuesday->count() != 0)):?>
<tr class="c">
<td colspan="5">Вівторок</td>
</tr>
<? foreach ($lessons_current_tuesday as $group):?>
<?if ($group->znam_chusel_id == 1) {?>
<?$result=$k%2;?>
<?}
else
{
    $result=$k%2; if ($group->znam_chusel_id == 2) { $k--;};
}?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>

<tr class="<?=$tr?>">
    <?if ($group->znam_chusel_id == 1) {?>
    <td><?=$group->lesson_id?></td>
    <?}
    else
    {?>
       <?if ($group->znam_chusel_id == 2){?>
       <td rowspan="2"><?=$group->lesson_id?></td>
       <?}?> 
    <?}?>
    <td><?=$group->schedule_subject_con->title?></td>
    <td>
    <?=$group->schedule_teacher1_con->title?>
    <? if ($group->teacher2_id!=0){echo ', '.$group->schedule_teacher2_con->title;}?>
    <? if ($group->teacher3_id!=0){echo ', '.$group->schedule_teacher3_con->title;}?>
    <? if ($group->teacher4_id!=0){echo ', '.$group->schedule_teacher4_con->title;}?>
    </td>
    <td>
    <?=$group->schedule_audience1_con->title?>
    <? if ($group->audience2_id!=0){echo ', '.$group->schedule_audience2_con->title;}?>
    </td>
    <td>
    
    <?=HTML::anchor('admin/schedulestalessons/edit/'. $group->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestalessons/delete/'. $group->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
<?endif?>

<? $tr=null; $k=1; $result=null;?>
<?if (($lessons_current_wednesday->count() != 0)):?>
<tr class="c">
<td colspan="5">Середа</td>
</tr>
<? foreach ($lessons_current_wednesday as $group):?>
<?if ($group->znam_chusel_id == 1) {?>
<?$result=$k%2;?>
<?}
else
{
    $result=$k%2; if ($group->znam_chusel_id == 2) { $k--;};
}?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>

<tr class="<?=$tr?>">
    <?if ($group->znam_chusel_id == 1) {?>
    <td><?=$group->lesson_id?></td>
    <?}
    else
    {?>
       <?if ($group->znam_chusel_id == 2){?>
       <td rowspan="2"><?=$group->lesson_id?></td>
       <?}?> 
    <?}?>
    <td><?=$group->schedule_subject_con->title?></td>
    <td>
    <?=$group->schedule_teacher1_con->title?>
    <? if ($group->teacher2_id!=0){echo ', '.$group->schedule_teacher2_con->title;}?>
    <? if ($group->teacher3_id!=0){echo ', '.$group->schedule_teacher3_con->title;}?>
    <? if ($group->teacher4_id!=0){echo ', '.$group->schedule_teacher4_con->title;}?>
    </td>
    <td>
    <?=$group->schedule_audience1_con->title?>
    <? if ($group->audience2_id!=0){echo ', '.$group->schedule_audience2_con->title;}?>
    </td>
    <td>
    
    <?=HTML::anchor('admin/schedulestalessons/edit/'. $group->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestalessons/delete/'. $group->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
<?endif?>

<? $tr=null; $k=1; $result=null;?>
<?if (($lessons_current_thursday->count() != 0)):?>
<tr class="c">
<td colspan="5">Четвер</td>
</tr>
<? foreach ($lessons_current_thursday as $group):?>
<?if ($group->znam_chusel_id == 1) {?>
<?$result=$k%2;?>
<?}
else
{
    $result=$k%2; if ($group->znam_chusel_id == 2) { $k--;};
}?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>

<tr class="<?=$tr?>">
    <?if ($group->znam_chusel_id == 1) {?>
    <td><?=$group->lesson_id?></td>
    <?}
    else
    {?>
       <?if ($group->znam_chusel_id == 2){?>
       <td rowspan="2"><?=$group->lesson_id?></td>
       <?}?> 
    <?}?>
    <td><?=$group->schedule_subject_con->title?></td>
    <td>
    <?=$group->schedule_teacher1_con->title?>
    <? if ($group->teacher2_id!=0){echo ', '.$group->schedule_teacher2_con->title;}?>
    <? if ($group->teacher3_id!=0){echo ', '.$group->schedule_teacher3_con->title;}?>
    <? if ($group->teacher4_id!=0){echo ', '.$group->schedule_teacher4_con->title;}?>
    </td>
    <td>
    <?=$group->schedule_audience1_con->title?>
    <? if ($group->audience2_id!=0){echo ', '.$group->schedule_audience2_con->title;}?>
    </td>
    <td>
    
    <?=HTML::anchor('admin/schedulestalessons/edit/'. $group->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestalessons/delete/'. $group->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
<?endif?>

<? $tr=null; $k=1; $result=null;?>
<?if (($lessons_current_friday->count() != 0)):?>
<tr class="c">
<td colspan="5">П'ятниця</td>
</tr>
<? foreach ($lessons_current_friday as $group):?>
<?if ($group->znam_chusel_id == 1) {?>
<?$result=$k%2;?>
<?}
else
{
    $result=$k%2; if ($group->znam_chusel_id == 2) { $k--;};
}?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>

<tr class="<?=$tr?>">
    <?if ($group->znam_chusel_id == 1) {?>
    <td><?=$group->lesson_id?></td>
    <?}
    else
    {?>
       <?if ($group->znam_chusel_id == 2){?>
       <td rowspan="2"><?=$group->lesson_id?></td>
       <?}?> 
    <?}?>
    <td><?=$group->schedule_subject_con->title?></td>
    <td>
    <?=$group->schedule_teacher1_con->title?>
    <? if ($group->teacher2_id!=0){echo ', '.$group->schedule_teacher2_con->title;}?>
    <? if ($group->teacher3_id!=0){echo ', '.$group->schedule_teacher3_con->title;}?>
    <? if ($group->teacher4_id!=0){echo ', '.$group->schedule_teacher4_con->title;}?>
    </td>
    <td>
    <?=$group->schedule_audience1_con->title?>
    <? if ($group->audience2_id!=0){echo ', '.$group->schedule_audience2_con->title;}?>
    </td>
    <td>
    
    <?=HTML::anchor('admin/schedulestalessons/edit/'. $group->id, HTML::image('media/img/edit.png'))?>
    
    <?=HTML::anchor('admin/schedulestalessons/delete/'. $group->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>
<? $k++;?>
<? endforeach?>
<?endif?>

</tbody>
</table>
<?else:?>
<p>В даній групі пар немає</p>
<?endif?>