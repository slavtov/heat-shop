<?php

namespace app\core;

class Cache
{
    static function set($key, $data, $second = 3600)
    {
        if ($second) {
            $content['data']	 = $data;
            $content['end_time'] = time() + $second;
            
            if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
                return true;
            }
        }

        return false;
    }

    static function get($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';

        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));

            if (time() <= $content['end_time']) return $content['data'];

            unlink($file);
        }

        return false;
    }

    static function delete($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';

        if (file_exists($file)) unlink($file);
    }
}
