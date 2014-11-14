<div class="scheduleContent">
<form action="schedulesta" method="post">
<select onchange="submit();" name="group_id">
    <option value="select">Виберіть групу...</option>
<?  foreach ($groups_all as $group ): ?>
    <option value="<?=$group->id?>" <?if ((isset ($_POST['group_id']))and($_POST['group_id'] == $group->id)) {echo 'selected="selected"';}?>><?=$group->title?></option>
<?endforeach?>
</select>
</form>

<?if (isset($_POST['group_id'])):?>

<?if (($lessons_current_monday->count() > 0)and
      ($lessons_current_tuesday->count() > 0)and
      ($lessons_current_wednesday->count() > 0)and
      ($lessons_current_thursday->count() > 0)and
      ($lessons_current_friday->count() > 0)):?>   

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Пара</th>
            <th>Назва предмету</th>
            <th>Викладач</th>
            <th>Аудиторія</th>
        </tr>
    </thead>

<?if (($lessons_current_monday->count() != 0)):?>   
<tr class="c">
<td colspan="5">Понеділок</td>
</tr>
<? foreach ($lessons_current_monday as $group):?>

<?switch ($group->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tbody>
<tr class="<?=$tr?>">
    <td><?=$group->lesson_id?></td>
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
</tr>

<? endforeach?>
<?endif?>

<?if (($lessons_current_tuesday->count() != 0)):?>
<tr class="c">
<td colspan="5">Вівторок</td>
</tr>
<? foreach ($lessons_current_tuesday as $group):?>

<?switch ($group->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    <td><?=$group->lesson_id?></td>
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
</tr>

<? endforeach?>
<?endif?>

<?if (($lessons_current_wednesday->count() != 0)):?>
<tr class="c">
    <td colspan="5">Середа</td>
</tr>
<? foreach ($lessons_current_wednesday as $group):?>

<?switch ($group->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    
    <td><?=$group->lesson_id?></td>
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
</tr>

<? endforeach?>
<?endif?>

<?if (($lessons_current_thursday->count() != 0)):?>
<tr class="c">
    <td colspan="5">Четвер</td>
</tr>
<? foreach ($lessons_current_thursday as $group):?>

<?switch ($group->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    <td><?=$group->lesson_id?></td>
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
</tr>

<? endforeach?>
<?endif?>

<?if (($lessons_current_friday->count() != 0)):?>
<tr class="c">
<td colspan="5">П'ятниця</td>
</tr>
<? foreach ($lessons_current_friday as $group):?>

<?switch ($group->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    <td><?=$group->lesson_id?></td>
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
</tr>

<? endforeach?>
<?endif?>

</tbody>
</table>

<p><strong>Пояснення/структура:</strong></p>
<table cellpadding="0" cellspacing="0">
<tbody>
<tr class="d">
<td>Пара кожного тижня</td>
</tr>
<tr  class="e">
<td>Пара по чисельнику</td>
</tr>
<tr  class="f">
<td>Пара по знаменнику</td>
</tr>
</tbody>
</table>
<?else:?>
<div class="error">В даний період група немає в розкладі занять</div>
<?endif?>
<?endif?>
</div>