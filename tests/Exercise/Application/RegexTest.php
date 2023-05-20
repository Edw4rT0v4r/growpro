<?php

namespace Growpro\Tests\Exercise\Application;

use Growpro\Exercise\Application\Regex;
use Growpro\Tests\Base;

class RegexTest extends Base
{
    private Regex $regex;

    protected function setUp(): void
    {
        parent::setUp();

        $this->regex = new Regex();
    }

    public function testGetIdentificationsByText(): void
    {
        $actual = 'Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)';
        $expect = [1071, 1061];

        $actual2 = 'Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061) y luego a @[Juan](user-gpe-1090)';
        $expect2 = [1071, 1061, 1090];

        $this->assertSame($expect, $this->regex->getIdentificationsByText($actual));
        $this->assertSame($expect2, $this->regex->getIdentificationsByText($actual2));
    }

    public function testTransformText(): void
    {
        $actual = 'Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)';
        $expect = 'Hola @Franklin avisa a @Ludmina';

        $actual2 = 'Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061) y luego a @[Juan](user-gpe-1090)';
        $expect2 = 'Hola @Franklin avisa a @Ludmina y luego a @Juan';

        $this->assertSame($expect, $this->regex->transformText($actual));
        $this->assertSame($expect2, $this->regex->transformText($actual2));
    }
}
