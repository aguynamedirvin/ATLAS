<!DOCTYPE html>
<html class="no-js" lang="<?= $site->language() ?>">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>ATLAS - Supreme Gym Wear</title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- Stylesheets -->
        <?= css('assets/css/main.css') ?>

    </head>


    <body class="site">


        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <!-- Site header -->
        <header class="site__header">
            <div class="wrap">
                <a class="logo" href="<?= $site->url() ?>">
                    ATLAS
                </a>

                <ul class="icons--social">
                    <li><a href="http://fb.com/atlaswear" target="_blank"><i class="icon icon--facebook">Facebook</i></a></li>
                    <li><a href="http://twitter.com/atlas_wear" target="_blank"><i class="icon icon--twitter">Twitter</i></a></li>
                    <li><a href="http://instagr.am/atlaswear" target="_blank"><i class="icon icon--instagram">Instagram</i></a></li>
                </ul>

                <ul class="user--icons">

                    <li>
                        <a href="<?= url('account') ?>">
                            <i class="icon icon--user">User</i>
                        </a>
                    </li>

                    <li class="nav-cart">
                        <a href="<?= url('shop/cart') ?>" title="<?php l::get('view-cart') ?>">
                            <i class="icon  icon--bag">Cart</i>
                            <span class="items">
                                <?php
                                    $cart = Cart::getCart();
                                    echo $cart->count();
                                ?>
                            </span>
                        </a>
                    </li>
                </ul>

            </div>
        </header>


        <!-- Main content -->
        <main class="wrap">
