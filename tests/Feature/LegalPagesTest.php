<?php

it('renders the homepage and the legal information pages', function () {
    foreach (['/', '/aviso-legal', '/privacidad', '/cookies', '/condiciones'] as $path) {
        $this->get($path)->assertOk();
    }
});

it('explains the necessary browser storage and provides cookie preferences', function () {
    $this->get('/cookies')
        ->assertOk()
        ->assertSee('sessionStorage')
        ->assertSee('Preferencias de cookies')
        ->assertSee('No se usan cookies de analítica');
});
