<?php


namespace Battis\Hydratable;

trait Hydratable
{
    /**
     * Convert a possible array `$raw` into an array, on the assumption that it
     * may be some sort of encoded array value stored as a string.
     * @param string|array $raw A raw array or array encoded as a string
     * @param array $decoders Additional decoders to try. Expected format a
     *      callable (as defined by `is_callable`), or an array in which the
     *      first element is a callable and the remaining elements are
     *      additional parameters (after the raw value) to be passed to the
     *      function or method:
     *          `'unserialize'` &rarr; `unserialize($raw)`
     *          `['json_decode', true]` &rarr; `json_decode($raw, true)`
     * @return array Decoded array value of `$raw` or `[]` if `$raw` cannot be decoded
     */
    private function decodeArray($raw, $decoders = []): array
    {
        if (is_array($raw)) {
            return $raw;
        } else {
            $raw = (string)$raw;
            foreach (array_merge(
                         [
                             'unserialize',
                             ['json_decode', true]
                         ],
                         $this->decodeArray($decoders)
                     ) as $decoder) {
                $callable = $decoder;
                $args = [$raw];
                $decoded = null;
                if (is_array($decoder)) {
                    $callable = $decoder[0];
                    $args = array_merge($args, array_slice($decoder, 1));
                }
                if (is_callable($callable)) {
                    $decoded = call_user_func($callable, ...$args);
                }
                if (is_array($decoded)) {
                    return $decoded;
                }
            }
            return [];
        }
    }

    /**
     * Hydrate an array based on a set of proposed values and default
     * values (with optional overrides.
     * @param Array $proposals DRY proposed values
     * @param Array $defaults default values to fill out proposed values
     * @param Array $overrides overrides to force _instead_ of proposals
     *                         (or defaults)
     * @return array hydrated array of values
     */
    protected function hydrate($proposals = [], $defaults = [], $overrides = []): array
    {
        return array_merge(
            $this->decodeArray($defaults),
            $this->decodeArray($proposals),
            $this->decodeArray($overrides)
        );
    }
}
