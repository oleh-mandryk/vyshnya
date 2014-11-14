<ul>
    <li class="first">Ви знаходитесь</li>
    <li>&#187;</li>
    <li>
    <?echo HTML::anchor('/', 'Головна');?>
    </li>
    <li>&#187;</li>
    <? if (($breadcrumb_it['alias_menu_main'] == 'news')
        or ($breadcrumb_it['alias_menu_main'] == 'poll')
        or ($breadcrumb_it['alias_menu_main'] == 'materialsteachers')
        or ($breadcrumb_it['alias_menu_main'] == 'materialsstudents')
        or ($breadcrumb_it['alias_menu_main'] == 'materialsstudentszaoch')
        or ($breadcrumb_it['alias_menu_main'] == 'materialsstudentsadd')
        or ($breadcrumb_it['alias_menu_main'] == 'materialsstudentszaochadd')
        or ($breadcrumb_it['alias_menu_main'] == 'search')
        or ($breadcrumb_it['alias_menu_main'] == 'photogallery')
        or ($breadcrumb_it['alias_menu_main'] == 'sitemap')
        or ($breadcrumb_it['alias_menu_main'] == 'schedulesta')
        or ($breadcrumb_it['alias_menu_main'] == 'schedulestateachers')
        or ($breadcrumb_it['alias_menu_main'] == 'schedulezaoch')
        or ($breadcrumb_it['alias_menu_main'] == 'schedulezaochteachers')
        or ($breadcrumb_it['alias_menu_main'] == 'schedulechanges')
        or ($breadcrumb_it['alias_menu_main'] == 'legaladvice')
        or ($breadcrumb_it['alias_menu_main'] == 'register')
        or ($breadcrumb_it['alias_menu_main'] == 'login')
        or ($breadcrumb_it['alias_menu_main'] == 'logout')
        or ($breadcrumb_it['alias_menu_main'] == 'restore_password')
        or ($breadcrumb_it['alias_menu_main'] == 'index')
        or ($breadcrumb_it['alias_menu_main'] == 'profile')
        or ($breadcrumb_it['alias_menu_main'] == 'restore_password'))
    {
        if ($breadcrumb_it['sub_menu_main'] != null) {?>
            <li>
    <?echo HTML::anchor($breadcrumb_it['alias_menu_main'], $breadcrumb_it['menu_main']);?>
    </li>
    <li>&#187;</li>
    <li>
      <?echo HTML::anchor('news/show/'.$breadcrumb_it['alias'], $breadcrumb_it['sub_menu_main']);?>
      </li>
        <?}
        else
        {?>
    <li>
    <?echo HTML::anchor($breadcrumb_it['alias_menu_main'], $breadcrumb_it['menu_main']);?>
    </li>
    
    
 <?}
 } else
    {?>
      <? if ($breadcrumb_it['menu_main'] != null){ ?>
      
      <li>
      <?echo HTML::anchor('page/'.$breadcrumb_it['alias_menu_main'], $breadcrumb_it['menu_main']);?>
      </li>
      <li>&#187;</li>
      <?}
      ?>
      
      <li>
      <?echo HTML::anchor('page/'.$breadcrumb_it['alias'], $breadcrumb_it['sub_menu_main']);?>
      </li>
      <?}
      ?>
</ul> 