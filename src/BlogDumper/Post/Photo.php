<?php

namespace BlogDumper\Post;


/**
 * Class Photo
 * @package BlogDumper\Post
 */
class Photo extends APost
{
    public function getName()
    {
        return sprintf('photo %s', $this->getId());
    }

    public function getContent()
    {
        $content = parent::getContent();

        if ($this->postData->caption) {
            $content[]  = [
                'text' => [$this->postData->caption],
            ];
        }

        $count = 1;
        foreach ($this->postData->photos as $photo) {
            $content[] = [
                'remote' => [$photo->original_size->url, sprintf("%02d%s", $count, $this->getExtension($photo->original_size->url))],
            ];
            if (!empty($photo->caption)) {
                $content[] = [
                    'text' => [$photo->caption, sprintf("%02d.html", $count)]
                ];
            }
            $count++;
        }

        return $content;
    }

    private function getExtension($file)
    {
        if (strrpos($file, '.') !== false) {
            return substr($file, strrpos($file, '.'));
        };

        return '';
    }
}