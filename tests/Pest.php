<?php

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

uses(TestCase::class)->in('Feature');

beforeEach(function () {
    Artisan::call('migrate');
});
