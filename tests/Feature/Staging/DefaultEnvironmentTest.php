<?php

use function Pest\Laravel\get;

beforeEach(function () {
    app()['env'] = 'prod';
});

it('ensures the staging banner is disabled in production', function() {
    app()['env'] = 'prod';
    get('/')->assertDontSee('staging-banner');
});

