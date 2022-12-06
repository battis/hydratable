<?php

namespace Battis\Hydratable\Tests\Fixtures\HydratableTest;

use Battis\Hydratable\Hydratable;

class A {
    use Hydratable;

    public function fixtureHydrate($proposals, $defaults = [], $overrides = [])
    {
        return $this->hydrate($proposals, $defaults, $overrides);
    }

    public function fixtureDecodeArray($raw, array $decoders = [])
    {
        return $this->decodeArray($raw, $decoders);
    }
}
