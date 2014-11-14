<?$cl=null?>
<ul>
<li><?=Html::anchor('', Html::image('media/img/home.png'))?></li>
<?foreach ($menu as $name => $menu):?>
<?if(in_array($select, $menu))
{
    $cl='active';
}
else
{
    $cl='null';
}?>
<li class="<?=$cl?>">
<?=Html::anchor('admin/'. $menu[0], $name)?>


</li>
<?endforeach?>
</ul>