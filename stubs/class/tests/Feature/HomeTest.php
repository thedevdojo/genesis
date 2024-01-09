<?php

test('basic test', function () {
    $this->get('/')->assertSuccessful();
});
