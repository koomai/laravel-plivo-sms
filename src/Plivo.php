<?php

namespace Koomai\Plivo;

use Plivo\RestAPI as PlivoRestApi;

class Plivo extends PlivoRestApi
{
    /**
     * @var string
     */
    protected $auth_id;

    /**
     * @var string
     */
    protected $auth_token;

    /**
     * @var string
     */
    protected $from;

    /**
     * Create a new Plivo RestAPI instance.
     *
     * @param array $config
     *
     * @return void
     */
    public function __construct(array $config)
    {
        $this->auth_id = $config['auth_id'];
        $this->auth_token = $config['auth_token'];
        $this->from = $config['from_number'];

        parent::__construct($this->auth_id, $this->auth_token);
    }

    /**
     * Number SMS is being sent from.
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }
}
