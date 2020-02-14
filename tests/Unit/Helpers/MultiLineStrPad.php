<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;

class MultiLineStrPad extends TestCase
{
    public function testItCorrectlyAddsStringPads()
    {
        $multiLineStrPad = new \App\Helpers\MultiLineStrPad;
        $this->assertSame("  a\n  b", $multiLineStrPad->strPad("a\nb", 2));
    }
}
