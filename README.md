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

## Leverage behat to start your code

- Append snippets `bin/behat features/pm_edits_project.feature:7 --append-snippets`
- Run behat `bin/behat features/pm_edits_project.feature:7` and implement the first pending definition
- Run behat again and see the scenario fail

## Leverage phpspec to build your domain

- Run phpspec `bin/phpspec run` and see you have no specs or examples yet
- Describe the project class under the right namespace `bin/phpspec describe SimpleTracker/Project/Project` 
- Run phpspec and choose yes when it asks to add the project class
- Add a `let` method to your spec to construct a project through a given constructor and arguments
- Run phpspec and choose yes when it asks to add the constructor to your project class

## Use the initialized domain concepts in your behat context

- Use the project class in your behat context
- Run behat with `bin/behat features/pm_edits_project.feature:7` and see the first step pass
- Start by implementing the next pending definition and combine behat and phpspec to build your domain by repeating the steps

## Leverage phpunit to test the `then` in your scenario

- Use the assertion framework `use PHPUnit_Framework_Assert as Assert;`
- Define the step by adding assertions
- Make the step pass by again leveraging behat and phpspec