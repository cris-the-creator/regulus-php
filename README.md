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
$regulus = new \Regulus\Regulus();
$regulus->createGroup('row_rules');
$regulus->addRuleTo('row_rules', $disableRow);
```
#### Resolve all rules
```php
$finalResult = $regulus->resolveAll();

if ($finalResult->isFulfilled()) {
    // Do something final
    // ...
} else {
    $failedRules = $finalResult->getFailedRules();
    $failedConditions = $failedRules->getFailedConditions();
    
    // Log or do something else
}
```

#### Resolve a specific rule
```php
$disableRowResult = $regulus->resolveRuleIn('row_rules', DisableRowRule::class);
if ($disableRowResult->isFulfilled()) {
    // Disable the row
    // ...
}
```

#### Resolve specific group
```php
$rowRuleGroupResult = $resolver->resolveGroup('row_rules');
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
class DisableRowRule extends \Regulus\AbstractRule
{
    // Inject all needed conditions for this rule
    public function __construct(private SomeRowCondition $someRowCondition)
    {}

    public function resolve(): RuleResult
    {
        $succeededConditions = [];
        $failedConditions = [];
        
        // Determine if the result is fulfilled
        if(!$this->someRowCondition->isFulfilled()) {
            $isFulfilled = false;
            $failedConditions[] = $this->someRowCondition;
        } else {
            $isFulfilled = true;
            $succeededConditions[] = $this->someRowCondition;
        }

        return $this->createResult(
            $isFulfilled,
            self,
            $succeededConditions,
            $failedConditions
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