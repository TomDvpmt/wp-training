<?php

use Timber\Timber;

$context = Timber::context();

Timber::render('pages/404.twig', $context);
