<?php

namespace Xabou\Geocoding;

use GuzzleHttp\Client;

class Geocoder
{
    const SUPPORTED_FORMATS = ['json', 'xml'];

    /**
     * Geocoding request parameters
     *
     * @var Parameters
     */
    protected $parameters;
    /**
     * Guzzle HTTP client
     *
     * @var Client
     */
    protected $guzzle;
    /**
     * Geocoding configuration
     *
     * @var null|array
     */
    protected $config;

    public function __construct()
    {
        $this->parameters = new Parameters();
        $this->guzzle = new Client();
        $this->config = config('geocoding');
    }

    /**
     * Set address parameter.
     *
     * @param $address
     * @return $this
     */
    public function address($address)
    {
        $this->parameters->address = $address;

        return $this;
    }

    /**
     * Set language parameter
     *
     * @param $language
     * @return $this
     */
    public function language($language)
    {
        $this->parameters->language = $language;

        return $this;
    }

    /**
     * Set region parameter
     *
     * @param $region
     * @return $this
     */
    public function region($region)
    {
        $this->parameters->region = $region;

        return $this;
    }

    /**
     * Set bounds parameter
     *
     * @param $bounds
     * @return $this
     */
    public function bounds($bounds)
    {
        $this->parameters->bounds = $bounds;

        return $this;
    }

    /**
     * Set components parameter
     *
     * @param $components
     * @return $this
     */
    public function components($components)
    {
        $this->parameters->components = $components;

        return $this;
    }

    /**
     * Set parameters from given array.
     *
     * @param array $parameters
     * @return $this
     */
    public function parameters(array $parameters)
    {
        foreach ($parameters as $parameter => $value) {
            if (property_exists($this->parameters, $parameter)) {
                $this->parameters->{$parameter} = $value;
            }
        }

        return $this;
    }

    /**
     * Use Google API to geocode given parameters.
     *
     * @return array
     */
    public function geocode()
    {
        $this->validateConfig();

        return $this->sendRequest();
    }

    /**
     * Send a request to Google Geocoding API.
     *
     * @return mixed
     */
    protected function sendRequest()
    {
        $parameters = $this->parameters->toArray();
        $parameters['key'] = $this->config['api_key'];

        $response = $this->guzzle->get($this->getRequestUrl(), [
            'query' => $parameters,
        ]);

        return json_decode((string)$response->getBody());
    }

    /**
     * Get URL for Google Geocoding API.
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return $this->config['request_url'] . $this->config['output_format'];
    }

    /**
     * Validate config file for missing/invalid settings.
     *
     * @throws \InvalidArgumentException
     */
    protected function validateConfig()
    {
        $message = null;
        if (empty($this->config['api_key'])) {
            $message = 'Geocoder Config: Api Key is mandatory for using Google API.';
        }
        elseif (empty($this->config['request_url'])) {
            $message = 'Geocoder Config: Request URL is mandatory for using Google API.';
        }
        elseif (empty($this->config['output_format'])) {
            $message = 'Geocoder Config: Output Format is mandatory for using Google API.';
        }
        elseif ( ! in_array($this->config['output_format'], self::SUPPORTED_FORMATS)) {
            $message = 'Geocoder Config: Given Format is not supported.';
        }

        if ($message) {
            throw  new \InvalidArgumentException($message);
        }
    }

}