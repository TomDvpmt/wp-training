<?php

use Timber\Timber;

$context = Timber::context();

$context['message'] = "I am a message from php sent to the twig file.";
dump($context);

Timber::render('pages/index.twig', $context);
