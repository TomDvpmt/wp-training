<?php

use Timber\Timber;

$context = Timber::context();

dump($context);

Timber::render('pages/404.twig', $context);
