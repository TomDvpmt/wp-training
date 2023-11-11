<?php

use Timber\Timber;

$context = Timber::context();

Timber::render('pages/page.twig', $context);
