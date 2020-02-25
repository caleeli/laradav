<?php

namespace Tests\Unit;

use App\Menu;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * Hello test
 */
class HelloTest extends TestCase
{
    /**
     * Get the menu list for the user.
     *
     * @return void
     */
    public function testGetMenuesForUser()
    {
        Artisan::call('inspire');
        $this->assertTrue(true);
    }
}
