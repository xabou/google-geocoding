<?php

namespace Xabou\Geocoding;

class Parameters
{
    /**
     * The street address for geocoding
     *
     * @var string
     */
    public $address;
    /**
     *  Application's API key
     *
     * @var string
     */
    public $key;
    /**
     * The viewport bounding box
     *
     * @var string
     */
    public $bounds;
    /**
     * Results language
     *
     * @var string
     */
    public $language;
    /**
     * Region code
     *
     * @var string
     */
    public $region;
    /**
     * Component filters
     *
     * @var string
     */
    public $components;

    /**
     * Convert the Parameters instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = [];
        foreach (get_object_vars($this) as $attribute => $value) {
            $attributes[$attribute] = $value;
        }

        return $attributes;
    }
}