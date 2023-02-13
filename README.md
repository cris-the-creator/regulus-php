# regulus-php
Regulus Php Version

Todo:
1. Install with composer
2. guide


## Setup conditions and rules
```php
$criticalCondition = new CiritcalCondition();
$dangerousCondition = new DangerousCondition();

$importantRule = new ImportantRule();
$importantRule->setConditions([$criticalCondition, $dangerousCondition]);

// Add more Rules and Conditions
// ...

$outcome = new Outcome();
$outcome->addRule($importantRule);

$resolver = new Resolver();
$resolver->resolve();
```

## Resolve rules based on outcome
```php

```