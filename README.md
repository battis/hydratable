# Hydratable

Hydrate serialized objects with defaults and overrides

This is meant to make it easier to take [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) arguments and hydrate them based on preset defaults.

## Install

```bash
composer require battis/hydratable
```

## Use

This can either be added as a trait to a class or as an invokable class.

```php
use Battis\Hydratable\Hydratable;

class MyObject
{
    use Hydratable;

    private static $DEFAULTS = [
      'foo' => 'bar',
      'argle' => 'bargle'
    ]

    private $options;

    public function __construct(array $params = [])
    {
        $this->options = $this->hydrate($params, self::$DEFAULTS);
    }
}
```

One could then instantiate an instance of `MyObject`:

```php
$o = new MyObject(['baz' => 123, 'argle' = 'BaRgLe']);

/*
$o->options = [
    'foo' => 'bar',
    'baz' => 123,
    'argle' => 'BaRgLe'
]
*/
```

Alternatively, we could simply instantiate `Hydrate` and use it as a one-off:

```php
$hydrate = new Battis\Hydratable\Hydrate();
$options = $hydrate($params, $defaults);
```
