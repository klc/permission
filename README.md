## How To Install

`composer require klc/permission`

`php artisan migrate`

`KLC\PermissionTrait` add to user model

## How To Use

### example :

roles table :

| id  | name   | slug   |
|-----|--------|--------|
| 1   | Admin  | admin  |
| 2   | Client | client |

user_role table :

| user_id | role_id |
| ------- |---------|
| 1       | 1       |
| 1       | 2       |

| id  | name  | slug  |
|-----|-------|-------|
| 1   | Foo   | foo   |
| 2   | Bar   | bar   |
| 3   | Baz   | baz   |
| 4   | Other | other |

role_permission table:

| role_id | permission_id |
|---------|---------------|
| 1       | 1             |
| 1       | 2             |
| 2       | 4             |
permission check:

```php
        $user = User::where('id', 1)->first();
        dump($user->hasPermission('foo'));
        dump($user->hasPermission('bar'));
        dump($user->hasPermission('baz'));
        dump($user->hasPermission('other'));
```

output:

```php
true
true
false
true
```

role check:
```php
        $user = User::where('id', 1)->first();
        dump($user->hasRole('admin'));
        dump($user->hasRole('client'));
        dump($user->hasRole('foo'));
```

output:

```php
true
true
false
```