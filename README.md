# regulus-php &middot; [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/facebook/react/blob/main/LICENSE)
Regulus Php Version

Todo:
1. Install with composer
2. guide


## Setup conditions and rules
```php
$criticalCondition = new CiritcalCondition();
$dangerousCondition = new DangerousCondition();

$importantRule = new Rule(
    'critical_rule', 
    [$criticalCondition, $dangerousCondition]
);

// Add more Rules and Conditions
// ...

$outcome = new Outcome();
$outcome->addRule($importantRule);
```

## Resolve rules based on outcome
```php

```
