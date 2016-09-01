        </main>


        <!-- Site footer -->
        <div class="site__footer">
            <nav class="site__footer-nav">
                <li><a href="<?= url('contact') ?>">Contact</a></li>
                <li><a href="<?= url('shop/cart') ?>">Cart</a></li>

                <?php if ($user = $site->user()): ?>
                    <li><a href="<?= url('account') ?>">Account</a></li>
                    <li><a href="<?= url('logout') ?>">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= url('account') ?>">Register</a></li>
                    <li><a href="<?= url('account') ?>">Login</a></li>
                <?php endif ?>

            </nav>

            <ul class="icons--social">
                <li><a href="http://fb.com/atlaswear" target="_blank"><i class="icon icon--facebook">Facebook</i></a></li>
                <li><a href="http://twitter.com/atlas_wear" target="_blank"><i class="icon icon--twitter">Twitter</i></a></li>
                <li><a href="http://instagr.am/atlaswear" target="_blank"><i class="icon icon--instagram">Instagram</i></a></li>
            </ul>

            <div class="site__info">
                <p>&copy; 2016 ATLAS. All Rights Reserved. Crafted with <span class="heart  animated  infinite  pulse">love</span> by <a href="http://squarepixl.com/">SquarePixl</a>.</p>
            </div>
        </div>


        <!-- JavaScript -->
        <?= js('assets/js/vendor/openshare.min.js') ?>


        <!-- Google Analytics -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-19072260-25','auto');ga('send','pageview');
        </script>

    </body>
</html>
