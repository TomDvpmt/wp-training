<?php

use Timber\Timber;

$context = Timber::context();

dump($context);

Timber::render('pages/product.twig', $context);
