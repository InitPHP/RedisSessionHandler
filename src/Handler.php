<?php
/**
 * InitPHP/RedisSessionHandler
 *
 * This file is part of InitPHP Redis Session Handler.
 *
 * @author Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright Copyright © 2022 Muhammet ŞAFAK
 * @license ./LICENSE MIT
 * @version 1.0
 * @link https://www.muhammetsafak.com.tr
 */

namespace InitPHP\RedisSessionHandler;

use InitPHP\Redis\Redis;

class Handler implements \SessionHandlerInterface
{

    private Redis $redis;

    private string $prefix = 'sess_';

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        $key = $this->prefix . $id;
        try {
            if($this->redis->has($key)){
                $this->redis->delete($key);
            }
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function gc($max_lifetime)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function open($path, $name)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read($id)
    {
        return (string)$this->redis->get($this->prefix . $id, '');
    }

    /**
     * @inheritDoc
     */
    public function write($id, $data)
    {
        return $this->redis->set($this->prefix . $id, $data) !== FALSE;
    }

}
