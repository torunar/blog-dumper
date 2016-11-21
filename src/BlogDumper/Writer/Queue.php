<?php

namespace BlogDumper\Writer;


/**
 * Class Queue
 * @package BlogDumper\Writer
 */
class Queue
{
    protected $asynchronous;
    protected $synchronous;

    public function __construct()
    {
        $this->asynchronous = [];
        $this->synchronous = [];
    }

    public function add($action)
    {
        if (is_resource($action) && get_resource_type($action) == 'curl') {
            $this->asynchronous[] = $action;
        } elseif (is_array($action)) {
            $this->synchronous[] = $action;
        }
    }

    public function process($frameSize = 10)
    {
        foreach ($this->synchronous as $sync_task) {
            $func = array_shift($sync_task);
            $args = reset($sync_task);
            call_user_func_array($func, $args);
        }

        $mh = curl_multi_init();

        $start = 0;

        $has_tasks = !empty($this->asynchronous);
        while ($has_tasks) {

            // add frame of handles
            for ($i = $start; $i < $start + $frameSize; $i++) {
                if (isset($this->asynchronous[$i])) {
                    curl_multi_add_handle($mh, $this->asynchronous[$i]);
                } else {
                    $has_tasks = false;
                    break;
                }
            }

            // process frame of handles
            $active = null;
            do {
                curl_multi_exec($mh, $active);
            } while ($active > 0);

            // remove frame of handles
            for ($i = $start; $i < $start + $frameSize; $i++) {
                if (isset($this->asynchronous[$i])) {
                    curl_multi_add_handle($mh, $this->asynchronous[$i]);
                } else {
                    break;
                }
            }

            $start += $frameSize;
        }

        curl_multi_close($mh);
    }

    /**
     * Adds tasks to download content of the post to the queue.
     *
     * @param \BlogDumper\Post\APost    $object Post to download data for
     * @param \BlogDumper\Config\Config $config Application config
     */
    public function populateTasksByPost($object, $config)
    {
        $content = $object->getContent();
        $id = $object->getId();

        foreach($content as $entry) {
            $writerClass = '\\BlogDumper\\Writer\\Content\\' . ucfirst(key($entry));

            if (class_exists($writerClass)) {
                /**
                 * @var \BlogDumper\Writer\Content\AWriter $writerHandler
                 */
                $writerHandler = new $writerClass(reset($entry));
                $writerHandler->setTarget(sprintf(
                    "%s/%s/%s/%s/%s",
                    rtrim($config->get('writePath'), '/'),
                    $object->getDate()->format('Y'),
                    $object->getDate()->format('m'),
                    $object->getDate()->format('d'),
                    $id
                ));

                $this->add($writerHandler->getSynchronous());
                $this->add($writerHandler->getAsynchronous());
            }
        }
    }
}