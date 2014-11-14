<div id="login">
<?if(!$auth->logged_in()):?>
<h2>Авторизація</h2>
<p>Введіть свій логін та пароль для входу на сайт.<a href="/register"> Реєстрація.</a><a href="/restore_password"> Забули пароль?</a></p>
    <form action="/login" method="post">
        <label>Логін<input type="text" name="username" value=""/></label>
        <label>Пароль<input type="password" name="password" value=""/></label>
        <div class="posBlock"><input type="checkbox" name="remember" value="checkbox1" /></div>
        <div class="posBlock">Запам'ятати мене</div>
        <br class="clear"/>
        <input type="submit" name="submit" class="submit" value="Увійти" />
    </form>
<?else:?>
    <h2><?=$user->username?></h2>
    <?if ($auth->logged_in('admin')):?>
        <div class="authA">
            <img src="/media/img/people-icon.png"/>
        </div>
        <div class="authB">
            <?=html::anchor('admin', 'Панель адміністратора')?><br />
            <?=html::anchor('schedulechanges', 'Оновлення змін до розкладу')?><br />
            <?=html::anchor('legaladvice', 'Юридична консультація')?><br />
            <?=html::anchor('account', 'Профіль')?><br />
            <?=html::anchor('logout', 'Вихід')?>
        </div>
        <br class="clear"/>
    <?else:?>
        <?if ($auth->logged_in('miniadmin') || $auth->logged_in('legaladvice')):?>
            <div class="authA">
                <img src="/media/img/people-icon.png"/>
            </div>
            <div class="authB">
                <?if ($auth->logged_in('miniadmin')) {?>
                    <?=html::anchor('schedulechanges', 'Оновлення змін до розкладу')?><br />
                <?} else {?>
                    <?=html::anchor('legaladvice', 'Юридична консультація')?><br />    
                <?}?>
                <?=html::anchor('account', 'Профіль')?><br />
                <?=html::anchor('logout', 'Вихід')?>
            </div>
            <br class="clear"/>
        <?else:?>
        <div class="authA">
            <img src="/media/img/people-icon.png"/>
        </div>
        <div class="authB">
            <?=html::anchor('account', 'Профіль')?><br />
            <?=html::anchor('logout', 'Вихід')?><br />
        </div>
        <br class="clear"/>
        <?endif?>
    <?endif?>
<?endif?>
<br/>
</div>