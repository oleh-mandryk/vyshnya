<?$cl=null?>
<div id="styleone">
<ul>
  <?foreach ($menu as $name => $menu):?>
  <?if(in_array($select, $menu))
{
    $cl='current';
}
else
{
    $cl='null';
}?>
  <li class="<?=$cl?>">
  <?if ($name == 'Вихід'):?>
  <?=Html::anchor(''. $menu[0], $name)?>
  <?else:?>
  <?=Html::anchor('account/'. $menu[0], $name)?>
  <?endif?>
  
  </li>
  
<?endforeach?>
</ul>
</div>