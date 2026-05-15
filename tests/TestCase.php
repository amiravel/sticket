<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected string $baseRoute = "";

    public function getBaseRoute(): string {
        return $this->baseRoute;
    }

    public function route(string $route): string {
        return $this->getBaseRoute() . $route;
    }
}
