<?php


namespace Tests\Unit\Helpers;


use App\Exceptions\ThrottleException;
use App\Helpers\Throttle;
use Tests\TestCase;

class ThrottleTest extends TestCase
{
    public function testItThrowsExceptionWhenNoAttemptsLeft()
    {
        $this->expectException(ThrottleException::class);

        $throttle = new Throttle('key', 2, 1);

        $throttle->attempt();
        $throttle->attempt();
        $throttle->attempt();
    }
    public function testItDoesNotThrowsAnyExceptionWhenAttemptsLeft()
    {
        $throttle = new Throttle('key', 10, 1);

        $throttle->attempt();
        $throttle->attempt();
        $throttle->attempt();

        $this->assertTrue(true);
    }
}
