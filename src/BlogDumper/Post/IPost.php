<?php

namespace BlogDumper\Post;


/**
 * Interface IPost
 * @package BlogDumper\Post
 */
interface IPost
{
    /**
     * IPost constructor.
     *
     * @param mixed $postData Post data from API response
     */
    public function __construct($postData);

    /**
     * Provides unique post ID.
     *
     * @return int Unique post ID
     */
    public function getId();

    /**
     * Provides post name.
     *
     * @return string Object name
     */
    public function getName();

    /**
     * Provides post content (text, images)
     *
     * @return array Post content
     */
    public function getContent();

    /**
     * Provides post tags.
     *
     * @return array<string>
     */
    public function getTags();

    /**
     * Provides GMT date and time of the post.
     *
     * @return \DateTime
     */
    public function getDate();
}