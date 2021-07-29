<?php


namespace Battis\Hydratable;


class Hydrate
{
    use Hydratable;
    public function __invoke($proposals = [], $defaults = [], $overrides = []): array
    {
        return $this->hydrate($proposals, $defaults, $overrides);
    }
}