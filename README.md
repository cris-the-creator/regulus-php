# regulus-php &middot; ![GitHub Actions](https://github.com/pengboomouch/regulus-php/actions/workflows/php.yml/badge.svg?event=push) [![Version](http://poser.pugx.org/pengboomouch/regulus-php/version)](https://packagist.org/packages/pengboomouch/regulus-php) [![PHP Version Require](http://poser.pugx.org/pengboomouch/regulus-php/require/php)](https://packagist.org/packages/pengboomouch/regulus-php) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/pengboomouch/regulus-php/LICENSE)



Regulus Php Version - Lightweight rule organization

### Install
```
composer require pengboomouch/regulus-php
```


### Example
```php
// Define some rules and conditions
$disableRow = new \DisableRowRule(
    new SomeRowCondition(),
    new SomeSecurityCondition()
);

// Init the outcome and add all rules to it
$outcome = new \Regulus\Outcome();
$outcome->addRule($disableRow);

// Init the resolver and pass him the outcome
$resolver = new \Regulus\Resolver($outcome);

// Resolve the rule
$disableRowResult = $resolver->resolve(DisableRowRule::class);
if ($disableRowResult->isFulfilled()) {
    // Disable the row
    // ...

    // Print / Log the fulfilled conditions
    echo "Disable row caused by:";
    foreach ($disableRowResult->getConditions()  as $condition) {
        echo $condition . '\n';
    }
}
```

### Create conditions
```php
class SomeRowCondition implements \Regulus\Condition
{
    // Inject all repositories or services you need
    public function __construct(private SomeService $someService)
    {}
    
    public function isFulfilled(): bool
    {
        // Determine if the condition is fulfilled
        // ...
        
        return true;
    }
}
```

### Create rules
```php
class DisableRowRule implements \Regulus\Rule
{
    // Inject all needed conditions for this rule
    public function __construct(private SomeRowCondition $someRowCondition)
    {}

    public function getRuleResult(): ?\Regulus\RuleResult
    {
        // Determine if the result is fulfilled ...
        if($this->someRowCondition->isFulfilled()) {
            return new \Regulus\RuleResult(
                self::class,
                [$this->someRowCondition::class]
            );
        }

        // ... or not
        return new \Regulus\RuleResult(
            self::class,
            []
        );
    }
}
```