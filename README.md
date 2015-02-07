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

## Configure a simple project manager context through behat

- Add `behat.yml`
 
```json
    default:
        suites:
            projectManager:
                contexts: [ SimpleProjectManagerContext ]
                filters:  { role: project manager, tags: simple }
```

- Run `bin/behat --init` 
- Add the `simple` tag to the pm edits a project feature

