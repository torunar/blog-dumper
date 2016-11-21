<?php

namespace BlogDumper;

use BlogDumper\Config\Config;
use Tumblr\API\Client;


/**
 * Class BlogDumper
 * @package BlogDumper
 */
class BlogDumper
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Client
     */
    private $client;

    public function __construct(Config $config)
    {
        $this->config = $config;

        $this->client = new Client(
            $config->get('consumerKey'),
            $config->get('consumerSecret')
        );
        $this->client->setToken(
            $config->get('token'),
            $config->get('tokenSecret')
        );
    }

    public function getPosts($blogName = null, $options = [])
    {
        $default_options = [
            'offset' => 0,
            'limit' => $this->config->get('queueSize', 20),
        ];
        $options = array_merge($default_options, $options);

        if (!$blogName) {
            $blogName = $this->config->get('blogName');
        }

        $response = $this->client->getBlogPosts($blogName, $options);

        return [$response->posts, $options];
    }
}