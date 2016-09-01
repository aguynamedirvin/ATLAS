<?php snippet('header') ?>

    <div class="page">

        <div class="page__content  login">

            <div class="login-form">
                <h1>Register</h1>

                <form class="login" method="post">
                    <div class="forRobots">
                        <label for="subject"><?= l::get('honeypot-label') ?></label>
                        <input type="text" name="subject">
                    </div>

                    <input type="text" id="username" name="username" placeholder="<?= l::get('username') ?>">
                    <input type="text" id="email" name="email" placeholder="<?= l::get('email-address') ?>">
                    <input type="text" id="fullname" name="fullname" placeholder="<?= l::get('full-name') ?>">

                    <label for="country"><?= l::get('country') ?></label>
                    <div class="select">
                        <select name="country" id="country">
                            <?php foreach ($countries as $c): ?>
                                <option value="<?= $c->slug() ?>"><?= $c->title() ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <button type="submit" name="register"><?= l::get('register') ?></button>
                </form>
            </div>


            <div class="login-form">
                <h1>Login</h1>

                <?php if (get('login') === 'failed'): ?>
                    <div class="message  message--warning">
                        <p><?= l::get('notification-login-failed') ?></p>
                    </div>
                <?php endif ?>

                <form action="<?= url('/login') ?>" method="POST" id="login">
                    <input type="hidden" name="redirect" value="<?= $page->uri() ?>">

                    <input type="text" id="email" name="email" placeholder="<?= l::get('email-address') ?>">
                    <input type="password" id="password" name="password" placeholder="password">

                    <button type="submit" name="login"><?= l::get('login') ?></button>

                    <a href="<?= url('account/reset') ?>" title="<?= l::get('forgot-password') ?>"><?= l::get('forgot-password') ?>?</a>
                </form>
            </div>

        </div>
    </div>

    <script>
        // domready (c) Dustin Diaz 2014 - License MIT
        !function(e,t){typeof module!="undefined"?module.exports=t():typeof define=="function"&&typeof define.amd=="object"?define(t):this[e]=t()}("domready",function(){var e=[],t,n=document,r=n.documentElement.doScroll,i="DOMContentLoaded",s=(r?/^loaded|^c/:/^loaded|^i|^c/).test(n.readyState);return s||n.addEventListener(i,t=function(){n.removeEventListener(i,t),s=1;while(t=e.shift())t()}),function(t){s?setTimeout(t,0):e.push(t)}})

        // Add click handlers to the links to make the login form flash
        domready(function() {
            function flashForm(event) {
                var form = document.getElementById('login');
                form.scrollIntoView(true);
                form.style.opacity = 0;
                setTimeout(function(){ form.style.opacity = 1; }, 300);
            }
            var links = document.querySelectorAll('a[href="#user"]');
            for (var i = 0; i < links.length; i++) {
                links[i].addEventListener("mouseup", flashForm, true);
            }
        });
    </script>

<?php snippet('footer') ?>
