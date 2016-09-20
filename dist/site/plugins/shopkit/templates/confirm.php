<?php snippet('header') ?>

    <div class="page">

        <h1 class="page__title">Confirm your order</h1>

        <div grid class="page__content">
            <div col="7">
                <h4>Shipping Info</h4>
                <form method="post">
                    <input type="hidden" name="txn_id" value="<?= $txn->txn_id() ?>">

                    <input required type="text" name="payer_name" value="<?= $payer_name ?>" placeholder="Your name">
                    <input required type="email" name="payer_email" value="<?= $payer_email ?>" placeholder="Your email">

                    <!-- Address auto-complete -->
                    <input type="text" name="payer_address" required onFocus="geolocate()" placeholder="Enter your adress" value="<?= $payer_address ?>" id="autocomplete" />

                    <div class="forRobots">
                        <input type="text" name="street_number" id="street_number" />
                        <input type="text" name="street_adress" id="route" />
                    </div>

                    <input type="text" disabled placeholder="Street" id="fullAddr" />

                    <div grid>
                        <input col="9" type="text" disabled name="city" placeholder="City" id="locality" />
                        <input col="4" type="text" disabled name="state" placeholder="State" id="administrative_area_level_1" />
                        <input col="3" type="text" disabled name="zip" placeholder="Postal Code" id="postal_code" />
                    </div>

                    <input type="text" disabled placeholder="Country" id="country" disabled />

                    <button class="btn  btn--inverse" type="submit"><?= l::get('confirm-order') ?></button>
                </form>
            </div>

            <div col="5">
                <h4>Order details</h4>
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

                                    <span class="product__variant"><?= str::upper($product->variant()) ?></span>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.page -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtl-ZOv90uffys3Mf8acCAUTh9cxuA6CE&libraries=places&callback=initAutocomplete"
    async defer></script>
    <script>
        /**
         * Auto-fill users address
         */

        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */
                (document.getElementById('autocomplete')), {
                types: ['geocode']
            });

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        // [START region_fillform]
        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            var fullAddress =[];
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }

                if (addressType == "street_number") {
                    fullAddress[0] = val;
                } else if (addressType == "route") {
                    fullAddress[1] = val;
                }
            }

            document.getElementById('fullAddr').value = fullAddress.join(" ");

            if (document.getElementById('fullAddr').value !== "") {
                document.getElementById('fullAddr').disabled = false;
            }
        }
        // [END region_fillform]

        // [START region_geolocation]
        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
        // [END region_geolocation]
        google.maps.event.addDomListener(window, 'load', initAutocomplete)
    </script>

<?php snippet('footer') ?>
