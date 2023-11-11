<?php

use Timber\Timber;

$context = Timber::context();

Timber::render('pages/single-product.twig', $context);
