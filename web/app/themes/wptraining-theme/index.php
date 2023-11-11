<?php

use Timber\Timber;

$context = Timber::context();

Timber::render('pages/front-page.twig', $context);
