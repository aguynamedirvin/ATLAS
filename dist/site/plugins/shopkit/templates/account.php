<?php snippet('header') ?>

    <div class="page">
        <div class="page__title">
            <h1><?= $page->title()->html() ?></h1>
            <p><?= $page->text()->kirbytext()->bidi() ?></p>
        </div>

        <div class="page__content">

            <?php if ($update_message): ?>
                <div class="message  message--success">
                    <p><?= $update_message ?></p>
                </div>
            <?php endif ?>

            <?php if ($delete_message): ?>
                <div class="message  message--danger">
                    <p><?= $delete_message ?></p>
                </div>
            <?php endif ?>

            <form class="account__details">

                <input disabled type="text" value="<?= $user->username() ?>">
                <input type="text" id="email" name="email" placeholder="<?= l::get('email-address') ?>" value="<?= $user->email() ?>">
                <input type="password" id="password" name="password" placeholder="<?= l::get('password') ?>" value="" aria-describedby="passwordHelp">
                <input type="text" id="fullname" name="fullname" placeholder="<?= l::get('full-name') ?>" value="<?= $user->firstName() ?>">

                <div class="select">
                    <select>
                        <?php foreach ($countries as $c): ?>
                            <option <?= $user->country() === $c->slug() ? 'selected' : '' ?> value="<?= $c->slug() ?>">
                                <?= $c->title() ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <button type="submit" name="update"><?= l::get('update') ?></button>

            </form>

        </div>
    </div>

<?php snippet('footer') ?>
