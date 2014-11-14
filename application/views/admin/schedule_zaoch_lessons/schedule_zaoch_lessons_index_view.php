<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>
<div class="add">
<?=HTML::image('media/img/add.png')?>
<?=HTML::anchor('admin/schedulezaochlessons/add/'.$id, 'Додати')?>
</div>

<?if($lessons_current->count() > 0):?>
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
<tbody>
<?$tr=null; $iter=0; $k=1; $result=null;?>
<?foreach ($lessons_current as $group):?>
    <?$result=$k%2;
    if ($result===0) { $tr='a';} else { $tr='b'; }
        if ($k != 1) {
            if ($date_cut != $group->date_id) {
                $iter=0;
            }
        }
        if ($iter == 0) {?>
            <tr class="c">
                <td colspan="5"><?=$group->date_id.' '?>(<?=$group->day_id?>)</td>
                <?$iter=1; $date_cut = $group->date_id;?>
            </tr>
    <?}?>
    <tr class="<?=$tr?>">
        <td><?=$group->lesson_id?></td>
        <td><?=$group->schedule_subject_con->title?>
         <? if ($group->subject_type_id!=0){echo '<em>('.$group->schedule_subject_type_con->title.')</em>';}?>
        </td>
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
            <?=HTML::anchor('admin/schedulezaochlessons/edit/'. $group->id, HTML::image('media/img/edit.png'))?>
            <?=HTML::anchor('admin/schedulezaochlessons/delete/'. $group->id, HTML::image('media/img/delete.png'))?>
        </td>
    </tr> 
 <?$k++;?>
<?endforeach?>

</tbody>
</table>
<?else:?>
<p>В даній групі пар немає</p>
<?endif?>