# regulus-php
Regulus Php Version

Todo:
1. Install with composer
2. guide


## Setup conditions and rules
```
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
```

```