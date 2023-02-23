# regulus-php &middot; ![GitHub Actions](https://github.com/pengboomouch/regulus-php/actions/workflows/php.yml/badge.svg?event=push) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/pengboomouch/regulus-php/LICENSE)

Regulus Php Version - Lightweight rule organization.

### Install
```
composer require pengboomouch/regulus-php
```
- [Example](#example)
    - [Resolve a specific rule](#resolve-a-specific-rule)
    - [Resolve all rule](#resolve-all-rules)
    - [Resolve a group](#resolve-specific-group)
- [Create conditions](#create-conditions)
- [Create rules](#create-rules)
- [Logs](#logs)

### Example
```php
// Define some rules and conditions
$disableRow = new \DisableRowRule(
    new SomeRowCondition(),
    new SomeSecurityCondition()
);

// Init a group and add all rules to it
$ruleGroup = new \Regulus\RuleGroup('Row_Rules');
$ruleGroup->add($disableRow);

// Init the resolver and pass him a rule or a group
$resolver = new \Regulus\Resolver($ruleGroup);
```
#### Resolve all rules
```php
$finalResult = $resolver->resolveAll();
if ($finalResult->isFulfilled()) {
    // Do something final
    // ...
}
```

#### Resolve a specific rule
```php
$disableRowResult = $resolver->resolve(DisableRowRule::class);
if ($disableRowResult->isFulfilled()) {
    // Disable the row
    // ...
}
```

#### Resolve specific group
```php
$rowRuleGroupResult = $resolver->resolveGroup('Row_Rules');
if ($rowRuleGroupResult->isFulfilled()) {
    // Do something to the rows
    // ...
}
```

### Create conditions
Define acceptance conditions to be fulfilled.
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
A rule can have multiple conditions. You can decide for yourself when to return a fail or success result.
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
### Logs
You can track all conditions for debugging.

```php
    $allConditions = $disableRowResult->getAllConditions();
    
    $fulfilledConditions = $disableRowResult->getFulfilledConditions();
    
    $failedConditions = $disableRowResult->getFailedConditions();
```