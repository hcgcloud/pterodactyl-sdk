# Pterodactyl PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

## Important
**As we are upgrading it to support version 0.7.x, and haven't finished the upgrade yet. Some features may still not work properly. In addition, functions provided by this sdk may change at any time. Unless you already know the possible consequences, don't use it in production.**

### Functions upgraded & tested

- [x] $pterodactyl->servers();
- [x] $pterodactyl->server($serverId);
- [x] $pterodactyl->serverEx($serverExternalId);
- [x] $pterodactyl->createServer(array $data);
- [x] $pterodactyl->deleteServer($serverId);
- [x] $pterodactyl->suspendServer($serverId);
- [x] $pterodactyl->unsuspendServer($serverId);
- [ ] $pterodactyl->powerServer($serverUuid, $action);
- [ ] $pterodactyl->commandServer($serverUuid, $command);
- [x] $server->delete();
- [x] $server->suspend();
- [x] $server->unsuspend();
- [ ] $server->power();
- [ ] $server->command();

## Install

To install the SDK in your project you need to require the package via [composer](http://getcomposer.org):

```bash
composer require hcgcloud/pterodactyl-sdk:dev-master
```

Then use Composer's autoload unless you are using a framework that support composer autoload:

```php
require __DIR__.'/../vendor/autoload.php';
```

And finally create an instance of the SDK:

```php
$pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl(API_KEY_HERE, BASE_URI_HERE);
```

## Usage

Using the pterodactyl instance you may perform multiple actions as well as retrieve the different resources Pterodactyl's API provides:

```php
$servers = $pterodactyl->servers();
```

This will give you an array of servers that you have access to, each server is represented by an instance of `HCGCloud\Pterodactyl\Resources\Server`, this instance has multiple public
properties like `$name`, `$id`, `$owner`, `$memory`, and others.

You may also retrieve a single server using:

```php
$server = $pterodactyl->server(SERVER_ID_HERE);
```

On multiple actions supported by this SDK you may need to pass some parameters, for example when creating a new server:

```php
$server = $pterodactyl->createServer([
    "external_id" => "4",
    "name" => "APITest",
    "user" => 1,
    "egg" => 15,
    "pack" => 0,
    "docker_image" => "hub.tencentyun.com/unihc/pterodactyl_images:vcmp",
    "environment" => [
        //Not confirmed
        [
            "server_id" => "",
            "variable_id" => "",
            "variable_value" => ""
        ]
    ],
    "skip_scripts" => false,
    "limits" => [
        "memory" => 64,
        "swap" => 0,
        "disk" => 64,
        "io" => 500,
        "cpu" => 0
    ],
    "feature_limits" => [
        "databases" => 0,
        "allocations" => 0
    ],
    "startup" => "./mpsvrrel64 -port {{SERVER_PORT}}",
    "description" => "test description",
    "node_id" => 1,
    "nest_id" => 5,
    "allocation" => [
        "default" => "16",
        "additional" => [
            "17",
            "18"
        ]
    ]
]);
```

These parameters will be used in the POST request sent to Pterodactyl servers, you can find more information about the parameters needed in panel source: `app\Http\Requests\Api\Application\Servers\StoreServerRequest.php`

Notice that this request for example will only start the server creation process, your server might need a few minutes before it completes provisioning, you'll need to check
the Server's `$installed` property to know if it's ready or not yet.

## Managing Users(Currently not totally upgraded to support 0.7.x & tested)

```php
$pterodactyl->users();
$pterodactyl->user($userId);
$pterodactyl->userex($userExternalId);
$pterodactyl->createUser(array $data);
$pterodactyl->deleteUser($userId);
```

On a User instance you may also call:

```php
$user->delete();
```

## Managing Servers

```php
$pterodactyl->servers();
$pterodactyl->server($serverId);
$pterodactyl->serverEx($serverExternalId);
$pterodactyl->createServer(array $data);
$pterodactyl->deleteServer($serverId);

// Server access
$pterodactyl->suspendServer($serverId);
$pterodactyl->unsuspendServer($serverId);
$pterodactyl->reinstallServer($serverId);
$pterodactyl->rebuildServer($serverId);

// Server Variable
$pterodactyl->updateServerStartup($serverId, array $data);
```

On a Server instance you may also call:

```php
$server->delete();
$server->suspend();
$server->unsuspend();
$server->reinstall();
$server->rebuild();
```

## License

`hcgcloud/pterodactyl-sdk` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hcgcloud/pterodactyl-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/hcgcloud/pterodactyl-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
[link-downloads]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
