<?php snippet('header') ?>

        <div class="page">
            <div class="page__title">
                <h1><?= $page->title()->html() ?></h1>
                <p><?= $page->text()->kirbytext()->bidi() ?></p>
            </div>

            <div class="page__content">

                <?php if($reset_message): ?>
                    <div class="message  message--warning">
                        <p><?= $reset_message ?></p>
                    </div>
                <?php endif ?>

                <form class="login" method="post">
                    <div class="forRobots">
                        <label for="subject"><?= l::get('honeypot-label') ?></label>
                        <input type="text" name="subject">
                    </div>

                    <input type="text" id="email" name="email" placeholder="<?= l::get('email-address') ?>">

                    <button type="submit" name="reset"><?= l::get('reset-submit') ?></button>
                    
                </form>

            </div>
        </div>

<?php snippet('footer') ?>
