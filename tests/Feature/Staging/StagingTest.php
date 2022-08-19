<?php

use function Pest\Laravel\get;

beforeEach(function () {
    app()['env'] = 'staging';
});

it('has a staging banner in a staging environment', function() {
    get('/')->assertSee('staging-banner');
});
