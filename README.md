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

## Adding a touch of symfony

- Install a clean version of the framework, one folder up `composer create-project symfony/framework-standard-edition ../framework/ "~2.6.4"`
- Copy the web and app folder to your bdd project `cp -R ../framework/app/ . && cp -R ../framework/web .` 
- Delete the AppBundle reference in `app/AppKernel.php`

- Replace your composer.json with the following:

```json
    {
        "require": {
            "php": ">=5.3.3",
            "symfony/symfony": "2.6.*",
            "doctrine/orm": "~2.2,>=2.2.3,<2.5",
            "doctrine/dbal": "<2.5",
            "doctrine/doctrine-bundle": "~1.2",
            "twig/extensions": "~1.0",
            "symfony/assetic-bundle": "~2.3",
            "symfony/swiftmailer-bundle": "~2.3",
            "symfony/monolog-bundle": "~2.4",
            "sensio/distribution-bundle": "~3.0,>=3.0.12",
            "sensio/framework-extra-bundle": "~3.0,>=3.0.2",
            "incenteev/composer-parameter-handler": "~2.0"
        },
        "require-dev": {
            "behat/behat": "~3.0",
            "behat/mink": "~1.6.0",
            "behat/mink-extension": "~2.0.0",
            "behat/symfony2-extension": "~2.0.0",
            "behat/mink-browserkit-driver": "~1.2.0",
            "phpspec/phpspec": "~2.1",
            "phpunit/phpunit": "~4.4",
            "sensio/generator-bundle": "~2.3"
        },
        "autoload": {
            "psr-0": {
                "SimpleTracker": "src"
            }
        },
        "scripts": {
            "post-root-package-install": [
                "SymfonyStandard\\Composer::hookRootPackageInstall"
            ],
            "post-install-cmd": [
                "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::removeSymfonyStandardFiles"
            ],
            "post-update-cmd": [
                "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::removeSymfonyStandardFiles"
            ]
        },
        "config": {
            "bin-dir": "bin"
        },
        "extra": {
            "symfony-app-dir": "app",
            "symfony-web-dir": "web",
            "symfony-assets-install": "relative",
            "incenteev-parameters": {
                "file": "app/config/parameters.yml"
            },
            "branch-alias": {
                "dev-master": "2.6-dev"
            }
        }
    }
```

- Run `composer update` 
- Make a single front-controller by replacing the contents of `web/app.php` with the following:

```php
    <?php
    
    use Symfony\Component\Debug\Debug;
    use Symfony\Component\HttpFoundation\Request;
    
    $loader = require_once __DIR__.'/../app/bootstrap.php.cache';
    
    $env = getenv('SYMFONY_ENV') ?: 'prod';
    $debug = getenv('SYMFONY_DEBUG') === '1';
    
    if ($debug) {
        Debug::enable();
    }
    
    require_once __DIR__.'/../app/AppKernel.php';
    require_once __DIR__.'/../app/AppCache.php';
    
    $kernel = new AppKernel($env, $debug);
    $kernel->loadClassCache();
    $kernel = new AppCache($kernel);
    
    $request = Request::createFromGlobals();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
```

## Add an online simple project manager context

- Replace the contents of `behat.yml with the following:

```json
    default:
        suites:
            simpleProjectManager:
                contexts: [ SimpleProjectManagerContext ]
                filters:  { role: project manager, tags: simple }
    
            projectManager:
                contexts: [ ProjectManagerContext ]
                filters:  { role: project manager, tags: less-simple }
    
            onlineSimpleProjectManager:
                contexts: [ OnlineSimpleProjectManagerContext ]
                filters:  { role: project manager, tags: simple-critical }
    
        extensions:
            Behat\Symfony2Extension: ~
            Behat\MinkExtension:
                default_session: 'symfony2'
                sessions:
                    symfony2: { symfony2: ~ }
```

- Initialize behat `bin/behat --init 
