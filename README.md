## How To Install

`composer require klc/permission`

`php artisan migrate`

`KLC\PermissionTrait` add to user model

## How To Use

### example :

roles table :

| id   | name | slug |
| ---- | ---- | ---- |
| 1    | Test | test |

user_role table :

| user_id | role_id |
| ------- | ------- |
| 1       | 1       |

| id   | name | slug |
| ---- | ---- | ---- |
| 1    | Foo  | foo  |
| 2    | Bar  | bar  |
| 3    | Baz  | baz  |

role_permission table:

| role_id | permission_id |
| ------- | ------------- |
| 1       | 1             |
| 1       | 2             |

code:

```php
        $user = User::where('id', 1)->first();
        dump($user->hasPermission('foo'));
        dump($user->hasPermission('bar'));
        dump($user->hasPermission('baz'));
```

output:

```php
true
true
false
```

