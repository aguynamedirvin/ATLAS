<?php snippet('header') ?>

    <div class="page">
        <div class="page__title">
            <h1><?= $page->title()->html() ?></h1>
            <p><?= $page->text()->kirbytext()->bidi() ?></p>
        </div>

        <div class="page__content">

            <h2><?= l::get('personal-details') ?></h2>

            <form method="post">

                <input type="hidden" name="txn_id" value="<?= $txn->txn_id() ?>">

                <input required type="text" name="payer_name" value="<?= $payer_name ?>" placeholder="Your name">
                <input required type="email" name="payer_email" value="<?= $payer_email ?>" placeholder="Your email">
                <input required type="text" name="payer_address" placeholder="Your adress. Ex: 12323 Main St. Los Angeles, CA 96001" value="<?= $payer_address ?>">


                <h2><?= l::get('order-details') ?></h2>
                <div class="cart">
                    <div class="cart__items">
                        <?php foreach( $txn->products()->toStructure() as $product ): ?>
                            <li class="product">
                                <div class="product__details">
                                    <h2 class="product__title"><?= $product->name() ?></h2>

                                    <div class="product__price">
                                        <span class="price"><?= formatPrice($product->amount()->value) ?></span>
                                        <span class="qty">(x<?= $product->quantity() ?>)</span>
                                    </div>

                                    <span class="product__option"><?= str::upper($product->variant()) ?></span>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>

                <button type="submit"><?= l::get('confirm-order') ?></button>

            </form>
            
        </div>
    </div>

<?php snippet('footer') ?>
