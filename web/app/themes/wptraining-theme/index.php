<?php

use Timber\Timber;

$context = Timber::context();

dump($context);

Timber::render('pages/front-page.twig', $context);
