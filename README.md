# InitPHP Redis Session Handler

This library provides a way to keep your application's sessions on redis, not on the filesystem.

## Requirements

- PHP 7.4 or later
- PHP Redis Extension
- [InitPHP Redis Library](https://github.com/InitPHP/Redis) 

## Installation

```
composer require initphp/redis-session-handler
```

## Usage

```php
require_once "vendor/autoload.php";

$redis = new \InitPHP\Redis\Redis([
    'host'          => '127.0.0.1',
    'password'      => null,
    'port'          => 6379,
    'timeout'       => 0,
    'database'      => 0,
]);

$sessionHandler = new InitPHP\RedisSessionHandler\Handler($redis);
session_set_save_handler($sessionHandler, true);
session_start();

// You can use the $_SESSION global.
```

## Credits

- [Muhammet ŞAFAK](https://www.muhammetsafak.com.tr) <<info@muhammetsafak.com.tr>>

## License

Copyright &copy; 2022 [MIT License](./LICENSE)
