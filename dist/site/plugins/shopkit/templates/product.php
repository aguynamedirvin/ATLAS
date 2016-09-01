<?php snippet('header') ?>

    <div class="product  single-product">

        <div class="product__images">
            <?php if ( $page->hasImages() ) snippet('slider', ['photos' => $page->images()]) ?>
        </div>


        <div class="product__details">
            <h1 class="product__title"><?= $page->title()->html() ?></h1>

            <div class="product__price">
                <span class="price">$</span>
            </div>

            <div class="product__section">
                <?php if (count($variants)): ?>
                    <form method="post" action="<?= url('shop/cart') ?>">
                        <div class="product__size  select">
                            <select>
                                <?php foreach ($variants as $variant): ?>
                                    <option data-price="<?= $variant->price() ?>" data-variant="<?= str::slug($variant->name()) ?>">
                                        <?= $variant->name() ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="uri" value="<?= $page->uri() ?>">
                        <input type="hidden" name="variant" value="<?= str::slug($variant->name()) ?>">

                        <button type="submit">Add to cart</button>
                    </form>
                <?php endif ?>
            </div>

            <!-- Sharing icons -->
            <div class="product__section">
                <h3>Share with your gym buddies</h3>
                <ul class="icons--social">

                    <!-- Facebook -->
                    <li>
                        <a  data-open-share="facebook"
                            data-open-share-link="<?= $page->url() ?>"
                            data-open-share-picture="<?= $page->image()->url() ?>"
                            data-open-share-caption="<?= $page->title()->html() ?>"
                            data-open-share-description="<?= $page->title()->html() ?>" target="_blank">

                            <i class="icon icon--facebook">Facebook</i>
                        </a>
                    </li>

                    <!-- Twitter -->
                    <li>
                        <a  data-open-share="twitter"
                            data-open-share-url="<?= $page->url() ?>"
                            data-open-share-via="atlas_wear"
                            data-open-share-text="<?= $page->title()->html() ?>"
                            data-open-share-hashtags="atlas, endure" target="_blank">

                            <i class="icon icon--twitter">Twitter</i>
                        </a>
                    </li>

                    <!-- Google Plus -->
                    <li>
                        <a  data-open-share="google"
                            data-open-share-url="<?= $page->url() ?>" target="_blank">

                            <i class="icon icon--google-plus">Google Plus</i>
                        </a>
                    </li>

                    <!-- Pinterest -->
                    <li>
                        <a  data-open-share="pinterest"
                            data-open-share-url="<?= $page->url() ?>"
                            data-open-share-media="<?= $page->image()->url() ?>"
                            data-open-share-description="<?= $page->title()->html() ?>" target="_blank">

                            <i class="icon icon--pinterest">Pinterest</i>
                        </a>
                    </li>
                </ul>
            </div><!-- /. sharing-icons -->

            <?php if ( $page->text()->isNotEmpty() ): ?>
                <div class="product__section">
                    <h3>Info</h3>
                    <div class="product__info">
                        <?= $page->text()->kirbytext()->bidi() ?>
                    </div>
                </div>
            <?php endif ?>

        </div><!-- / .product__details -->
    </div><!-- /.single-product -->


    <script>
        $(document).ready(function() {
            var basePrice = $('.product__size > select option:first-child').data('price');
            var baseVariant = $('.product__size > select option:first-child').data('variant');

            update(basePrice, baseVariant);

            $('.product__size > select').change(function () {
                price = basePrice;
                variant = baseVariant;

                $(".product__size > select option:selected").each(function () {
                    price = parseFloat($(this).data('price'));
                    variant = $(this).data('variant');

                    // Format numbers
                    price = price.toFixed(2);
                });

               	update(price, variant);
            });

            function update(price, variant) {
                $('.product__price > .price').html('$' + price);
                $('input[name="variant"]').val(variant);
                $('input[name="price"]').val(price);
            }
        });
    </script>


<?php snippet('footer') ?>
