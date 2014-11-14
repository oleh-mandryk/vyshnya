<div class="gallery" class="clear">
<?$k=1;?>
<table cellpadding="0" cellspacing="0">
<tbody>
<?foreach($photo as $one):?>
<?if ($k==1) {?> <tr>  <?}?>

         
<td><a title="<?=$one->title?>" href="/media/img/photogallery/big/<?=$one->url_img?>" rel="prettyPhoto[gallery2]"><img src="/media/img/photogallery/small/<?=$one->url_img?>" alt="" /></a></td>

<? $k++;?>
<?if ($k==6) {?> </tr>  <? $k=1;}?>
<?endforeach?> 
<?if ($k==1) {?> </tr> <?}?>
</tbody>
</table>
<?=$pagination;?>
</div>  