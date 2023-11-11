<?php

use Timber\Timber;

$context = Timber::context();

$context['products'] = Timber::get_posts(['post_type' => 'product']);
// dump($context);

Timber::render('pages/front-page.twig', $context);
