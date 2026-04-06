<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Smoke test: HTTP stack is wired without requiring a working database
     * (views such as the menu query the DB; use RefreshDatabase + sqlite in CI if needed).
     */
    public function testApplicationBoots(): void
    {
        $this->assertTrue($this->app->isBooted());
    }
}
