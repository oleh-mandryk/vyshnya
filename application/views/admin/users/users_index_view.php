<? if (isset($info_ok)) {?>
<div class="not_error"><?=$info_ok?></div>
<?}?>

<?if($users->count() > 0):?>
<? $tr=null; $k=1; $result=null;?>

<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Логін</th>
            <th>E-mail</th>
            <th>Прізвище</th>
            <th>Ім'я</th>
            <th>По батькові</th>
            <th>Ролі</th>
            <th>Дата реєстрації</th>
            <th>Функції</th>
        </tr>
    </thead>
<tbody>
<? foreach ($users as $user):?>
<?$result=$k%2;?>
<?if ($result===0) { $tr='a';} else { $tr='b'; }?>

<?if ($user->publish_id == 0) { $col = 'no_active';} else {$col = null;}?>

<tr class="<?=$tr?> <?=$col?>">
    <td><?=$user->id?></td>
    <td><?=HTML::anchor('admin/users/edit/'. $user->id, $user->username)?></td>
    <td><?=$user->email?></td>
    <td><?=$user->first_name?></td>
    <td><?=$user->second_name?></td>
    <td><?=$user->third_name?></td>
    <td>
        <?foreach($user->roles->find_all() as $role):?>
            <?=$role->description?><br/>
        <?endforeach?>
    </td>
    <td><?=$user->date?></td>
    <td>
        <?=HTML::anchor('admin/users/edit/'. $user->id, HTML::image('media/img/edit.png'))?>
        <?=HTML::anchor('admin/users/delete/'. $user->id, HTML::image('media/img/delete.png'))?>
    </td>
</tr>

<? $k++;?>
<? endforeach?>
</tbody>
</table>
<?=$pagination;?>
<?else:?>
<p>Немає користувачів</p>
<?endif?>