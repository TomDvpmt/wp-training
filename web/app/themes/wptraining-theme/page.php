<?php

use Timber\Timber;

$context = Timber::context();

dump($context);

Timber::render('pages/page.twig', $context);
