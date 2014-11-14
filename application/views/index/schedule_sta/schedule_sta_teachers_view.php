<div class="scheduleContent">
<form action="schedulestateachers" method="post">
<select class="schedule" onchange="submit();" name="teacher_id">
    <option value="select">Виберіть викладача...</option>
<?  foreach ($teachers_all as $teacher ): ?>
    <option value="<?=$teacher->id?>" <?if ((isset ($_POST['teacher_id']))and($_POST['teacher_id'] == $teacher->id)) {echo 'selected="selected"';}?>><?=$teacher->title?></option>
<?endforeach?>
</select>
</form>

<?if (isset($_POST['teacher_id'])):?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Пара</th>
            <th>Назва предмету</th>
            <th>Група</th>
            <th>Аудиторія</th>
        </tr>
    </thead>
 
<?if (($lessons_current_monday->count() != 0)):?>   
<tr class="c">
<td colspan="5">Понеділок</td>
</tr>
<? foreach ($lessons_current_monday as $teacher):?>
<? if ($teacher->schedule_group->title != null):?>
<?switch ($teacher->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tbody>
<tr class="<?=$tr?>">
    <td><?=$teacher->lesson_id?></td>
    <td><?=$teacher->schedule_subject_con->title?></td>
    <td><?=$teacher->schedule_group->title?></td>
    <td>
        <?=$teacher->schedule_audience1_con->title?>
        <? if ($teacher->audience2_id!=0){echo ', '.$teacher->schedule_audience2_con->title;}?>
    </td>
</tr>
<?endif;?>
<? endforeach?>
<?endif?>

<?if (($lessons_current_tuesday->count() != 0)):?>
<tr class="c">
<td colspan="5">Вівторок</td>
</tr>
<? foreach ($lessons_current_tuesday as $teacher):?>
<? if ($teacher->schedule_group->title != null):?>

<?switch ($teacher->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    <td><?=$teacher->lesson_id?></td>
    <td><?=$teacher->schedule_subject_con->title?></td>
    <td>
        <?=$teacher->schedule_group->title?>
    </td>
    <td>
        <?=$teacher->schedule_audience1_con->title?>
        <? if ($teacher->audience2_id!=0){echo ', '.$teacher->schedule_audience2_con->title;}?>
    </td>
</tr>
<?endif;?>
<? endforeach?>
<?endif?>

<?if (($lessons_current_wednesday->count() != 0)):?>
<tr class="c">
    <td colspan="5">Середа</td>
</tr>
<? foreach ($lessons_current_wednesday as $teacher):?>
<? if ($teacher->schedule_group->title != null):?>
<?switch ($teacher->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    <td><?=$teacher->lesson_id?></td>
    <td><?=$teacher->schedule_subject_con->title?></td>
    <td><?=$teacher->schedule_group->title?></td>
    <td>
        <?=$teacher->schedule_audience1_con->title?>
        <? if ($teacher->audience2_id!=0){echo ', '.$teacher->schedule_audience2_con->title;}?>
    </td>
</tr>
<?endif;?>
<? endforeach?>
<?endif?>

<?if (($lessons_current_thursday->count() != 0)):?>
<tr class="c">
    <td colspan="5">Четвер</td>
</tr>
<? foreach ($lessons_current_thursday as $teacher):?>
<? if ($teacher->schedule_group->title != null):?>
<?switch ($teacher->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    <td><?=$teacher->lesson_id?></td>
    <td><?=$teacher->schedule_subject_con->title?></td>
    <td><?=$teacher->schedule_group->title?></td>
    <td>
        <?=$teacher->schedule_audience1_con->title?>
        <? if ($teacher->audience2_id!=0){echo ', '.$teacher->schedule_audience2_con->title;}?>
    </td>
</tr>
<?endif;?>
<? endforeach?>
<?endif?>

<?if (($lessons_current_friday->count() != 0)):?>
<tr class="c">
<td colspan="5">П'ятниця</td>
</tr>
<? foreach ($lessons_current_friday as $teacher):?>
<? if ($teacher->schedule_group->title != null):?>
<?switch ($teacher->znam_chusel_id) { case 1: $k=1; break; case 2: $k=2; break; case 3: $k=3; break; }?>
<?switch ($k) { case 1: $tr='d'; break; case 2: $tr='e'; break; case 3: $tr='f'; break; }?>

<tr class="<?=$tr?>">
    <td><?=$teacher->lesson_id?></td>
    <td><?=$teacher->schedule_subject_con->title?></td>
    <td><?=$teacher->schedule_group->title?></td>
    <td>
        <?=$teacher->schedule_audience1_con->title?>
        <? if ($teacher->audience2_id!=0){echo ', '.$teacher->schedule_audience2_con->title;}?>
    </td>
</tr>
<?endif;?>
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

<?endif?>
</div>