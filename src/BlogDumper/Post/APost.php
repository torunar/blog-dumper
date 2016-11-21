<?php

namespace BlogDumper\Post;


/**
 * Class APost
 * @package BlogDumper\Post
 */
class APost implements IPost
{
    /**
     * @var array $postData Post data from API response
     */
    protected $postData;

    /**
     * @var \DateTime $date Post creation date
     */
    protected $date;

    /**
     * @inheritdoc
     */
    public function __construct($postData)
    {
        $this->postData = $postData;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->postData->id;
    }

    /**
     * @inheritdoc
     */
    public function getTags()
    {
        return $this->postData->tags;
    }

    /**
     * @inheritdoc
     */
    public function getDate()
    {
        if (!$this->date) {
            $this->date = new \DateTime($this->postData->date);
        }

        return $this->date;
    }
}