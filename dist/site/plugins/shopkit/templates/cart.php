<?php snippet('header') ?>

    <div class="page">

        <h1 class="page__title"><?= $page->title()->html() ?></h1>

        <?php if ($cart->count() === 0): ?>
            <div class="cart  cart--empty">

                <p class="cart--empty__msg">Your bag is empty. Fill it up with some gym <a href="<?= url('shop') ?>">gear</a>!</p>

                <a class="btn" href="<?= url('shop') ?>">Shop gear</a>

            </div><!-- /.cart -->
        <?php else: ?>
            <div grid class="cart">

                <div col="7" class="cart-left">
                    <div class="cart__items">
                        <?php foreach($items as $i => $item): ?>
                            <li class="product">

                                <a href="<?= url($item->uri) ?>">
                                    <?php if ($item->imgSrc): ?>
                                        <img class="product__thumb" src="<?= $item->imgSrc ?>" title="<?= $item->name ?>" />
                                    <?php endif ?>
                                </a>

                                <div class="product__details">
                                    <h2 class="product__title">
                                        <a href="<?= url($item->uri) ?>"><?= $item->name ?></a>
                                    </h2>

                                    <div class="product__price">
                                        <span class="price"><?= $item->priceText ?></span>
                                    </div>

                                    <span class="product__variant"><?= str::upper($item->variant) ?></span>

                                    <div class="product__quantity">
                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="remove">
                                            <input type="hidden" name="id" value="<?= $item->id ?>">

                                            <button class="btn-test  icon  icon--<?= e($item->quantity === 1, 'remove', 'minus') ?>">Minus</button>
                                        </form>

                                        <span id="qty"><?= $item->quantity ?></span>

                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="add">
                                            <input type="hidden" name="id" value="<?= $item->id ?>">

                                            <button class="btn-test  icon  icon--add">Add</button>
                                        </form>
                                    </div>
                                </div>


                            </li>
                        <?php endforeach ?>
                    </div><!-- / Cart items -->


                    <!-- Set discount code -->
                    <?php if (page('shop')->discount_codes()->toStructure()->count() > 0):  ?>
                            <?php if ($discount): ?>
                                <div class="grid  grid--gutters">
                                    <div class="grid-cell">
                                        <input type="text" disabled value="<?= $discount['code'] ?>">
                                    </div>
                                    <div class="grid-cell">
                                        <form method="post">
                                            <input type="hidden" name="dc" value="">
                                            <button type="submit">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            <?php else: ?>
                                <form method="post">
                                    <div grid>
                                        <div col="7">
                                            <input style="width: 100%" type="text" name="dc" placeholder="Discount code">
                                        </div>

                                        <div col="8">
                                            <button type="submit"><?= l::get('code-apply') ?></button>
                                        </div>
                                    </div>
                                </form>
                            <?php endif ?>
                    <?php endif ?>



                    <!-- Set country -->
                    <form id="setCountry" action="" method="POST">
                        <div class="select">
                            <select name="country" onChange="document.forms['setCountry'].submit();">
                                <?php foreach ($countries as $c): ?>
                                    <option <?= ecco(s::get('country') === $c->uid(), 'selected') ?> value="<?= $c->countrycode() ?>">
                                        <?= $c->title() ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <button type="submit"><?= l::get('update-country') ?></button>
                    </form>


                    <!-- Set shipping -->
                    <form id="setShipping" action="" method="POST">
                        <div class="select">
                            <select name="shipping" onChange="document.forms['setShipping'].submit();">
                                <?php if (count($shipping_rates) > 0): ?>
                                    <?php foreach ($shipping_rates as $rate): ?>
                                        <option value="<?= str::slug($rate['title']) ?>" <?= e($shipping['title'] === $rate['title'],'selected') ?>>
                                            <?= $rate['title'] ?> (<?= formatPrice($rate['rate']) ?>)
                                        </option>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <!-- If no shipping rates are set, show free shipping -->
                                    <option value="free-shipping"><?= l::get('free-shipping') ?></option>
                                <?php endif ?>
                            </select>
                        </div>

                        <button type="submit"><?= l::get('update-shipping') ?></button>
                    </form>
                </div><!-- / Cart left -->



                <div col="4" style="margin-left: auto" class="cart__info">
                    <ul class="details">
                        <li>Merchandise <span><?= formatPrice($cart->getAmount()) ?></span></li>
                        <li>Shipping <span><?= formatPrice($shipping['rate']) ?></span></li>

                        <?php if ($discount): ?>
                        <li>Discount <span><?= '&ndash; ' . formatPrice($discount['amount']) ?></span></li>
                        <?php endif ?>

                        <li>Total <span><?= formatPrice($total) ?></span></li>
                    </ul>


                    <!-- Gateway payment buttons -->
                    <?php foreach($gateways as $gateway): ?>
                        <?php if ($gateway == 'paylater' && !$cart->canPayLater()) continue ?>

                        <?php $g = $kirby->get('option', 'gateway-' . $gateway) ?>
                        <form method="POST" action="<?= url('shop/cart/process') ?>">

                            <input type="hidden" name="gateway" value="<?= $gateway ?>">

                            <?php if ($giftCertificate): ?>
                                <input type="hidden" name="giftCertificateAmount" value="<?= $giftCertificate['amount'] ?>">
                                <input type="hidden" name="giftCertificateRemaining" value="<?= $giftCertificate['remaining'] ?>">
                            <?php endif ?>

                            <div class="forRobots">
                                <label for="subject"><?= l::get('honeypot-label') ?></label>
                                <input type="text" name="subject">
                            </div>

                            <?php if ($gateway == 'paypalexpress'): ?>
                                <button type="submit" class="paypal-checkout">
                                    <img src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-rect-paypalcheckout-60px.png" />
                                </button>
                            <?php else: ?>
                                <button type="submit" class="btn  btn--inverse">
                                    <?= $gateway != 'paylater' ? '<span>' . l::get('pay-now') . '</span>' : '' ?>
                                </button>

                                <p class="secure-payment"><span class="icon  icon--secure">Secure payment</span> Payments securely processed by <a href="https://stripe.com/">Stripe</a>.</p>

                            <?php endif ?>
                        </form>
                    <?php endforeach ?>

                </div>

            </div><!-- /.cart -->

        </div><!-- /.page -->

        <script>
            // Hide setCountry and setShipping submit buttons
            document.querySelector('#setCountry button').style.display = 'none';
            document.querySelector('#setShipping button').style.display = 'none';
        </script>
    <?php endif ?>

<?php snippet('footer') ?>
