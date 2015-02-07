# SIMPLE TRACKER

## Install behat and phpspec via `composer.json`, configure the autoloader and set the bin-dir

Add this to composer.json:
```json
    {
        "require": {
            "php": "~5.5.0"
        },
        "require-dev": {
            "behat/behat": "~3.0",
            "phpspec/phpspec": "~2.1",
            "phpunit/phpunit": "~4.4"
        },
        "autoload": {
            "psr-0": {
                "SimpleTracker": "src"
            }
        },
        "config": {
            "bin-dir": "bin"
        }
    }
```
Run `composer install`

