# Behat Steps
Collection of Behat steps for Drupal development.

[![CircleCI](https://circleci.com/gh/integratedexperts/behat-steps.svg?style=shield)](https://circleci.com/gh/integratedexperts/behat-steps)
[![Latest Stable Version](https://poser.pugx.org/integratedexperts/behat-steps/v/stable)](https://packagist.org/packages/integratedexperts/behat-steps)
[![Total Downloads](https://poser.pugx.org/integratedexperts/behat-steps/downloads)](https://packagist.org/packages/integratedexperts/behat-steps)
[![License](https://poser.pugx.org/integratedexperts/behat-steps/license)](https://packagist.org/packages/integratedexperts/behat-steps)

# Why traits?
Usually, such packages implement own Drupal driver with several contexts, service containers and a lot of other useful architectural structures.
But for this simple library, using traits helps to lower entry barrier for usage, maintenance and support. 
This package may later be refactored to use proper architecture. 

# Installation
`composer require --dev integratedexperts/behat-steps`

# Usage
In `FeatureContext.php`:

```
<?php

use Drupal\DrupalExtension\Context\DrupalContext;
use IntegratedExperts\BehatSteps\D7\ContentTrait;
use IntegratedExperts\BehatSteps\D7\DomainTrait;
use IntegratedExperts\BehatSteps\D7\EmailTrait;
use IntegratedExperts\BehatSteps\D7\OverrideTrait;
use IntegratedExperts\BehatSteps\D7\ParagraphsTrait;
use IntegratedExperts\BehatSteps\D7\UserTrait;
use IntegratedExperts\BehatSteps\D7\VariableTrait;
use IntegratedExperts\BehatSteps\D7\WatchdogTrait;
use IntegratedExperts\BehatSteps\D8\MediaTrait;
use IntegratedExperts\BehatSteps\DateTrait;
use IntegratedExperts\BehatSteps\Field;
use IntegratedExperts\BehatSteps\FieldTrait;
use IntegratedExperts\BehatSteps\LinkTrait;
use IntegratedExperts\BehatSteps\PathTrait;
use IntegratedExperts\BehatSteps\ResponseTrait;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends DrupalContext {

  use ContentTrait;
  use DomainTrait;
  use EmailTrait;
  use MediaTrait;
  use OverrideTrait;
  use ParagraphsTrait;
  use PathTrait;
  use UserTrait;
  use VariableTrait;
  use WatchdogTrait;
  use DateTrait;
  use FieldTrait;
  use LinkTrait;
  use PathTrait;
  use ResponseTrait;

}
```

## Development

### Local environment setup
1. Make sure that you have `make`, [composer](https://getcomposer.org/), [Docker](https://www.docker.com/) and [Pygmy](https://docs.amazee.io/local_docker_development/pygmy.html) installed.
2. Checkout project repo
3. Set the version of Drupal to run test against in `.env.local` file: `DRUPAL_VERSION = 7`
4. `pygmy up`
5. `make build`

### Behat tests
- Run all tests: `make test-behat`
- Run all scenarios in specific feature file: `make test-behat -- path/to/file`
- Run all scenarios tagged with `@wip` tag: `make test-behat -- --tags=wip`

To debug tests from CLI:
1. SSH into CLI container: `docker-compose -p behatsteps exec cli sh`
2. `./xdebug.sh vendor/bin/behat -p d7 path/to/file`
   
   IMPORTANT: When running tests directly, always specify profile for the 
   version of Drupal your are running:
      ```
      vendor/bin/behat -p d7
      ```      
      or
      ```
      vendor/bin/behat -p d8
      ```
