# Installation

>`composer require topdot/core`

Publish migrations
>`php artisan vendor:publish --provider="Topdot\Core\CoreServiceProvider" --tag="migrations"`

Run migrations
>`php artisan migrate`

Create Default User
>`php artisan make:admin`

Additional Setup
```
Clear App\User Contents and Extend from Topdot\Core\Models\User

```
Permissions And Roles

```
If you are going to create multiuser app you may need roles and permissions module. its already built and added to core module and routes are added add links you your menu and use them. To enable permission check on route use `permission.check` middleware on route or route groups.

```