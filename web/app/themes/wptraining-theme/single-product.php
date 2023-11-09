<?php

use Timber\Timber;

$context = Timber::context();

dump($context);

Timber::render('pages/single-product.twig', $context);
