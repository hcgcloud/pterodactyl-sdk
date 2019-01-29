# Pterodactyl PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

## Important
**As we are upgrading it to support version 0.7.x, and haven't finished the upgrade yet. Some features may still not work properly. In addition, functions provided by this sdk may change at any time. Unless you already know the possible consequences, don't use it in production.**

## Install

To install the SDK in your project you need to require the package via [composer](http://getcomposer.org):

```bash
composer require hcgcloud/pterodactyl-sdk
```

Then use Composer's autoload:

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
    "name"=>"API Test",
    "description"=>"API Description",
    "user_id"=>1,
    "location_id"=>1,
    "auto_deploy"=>true,
    "memory"=>64,
    "swap"=>0,
    "disk"=>1024,
    "cpu"=>0,
    "io"=>500,
    "service_id"=>1,
    "option_id"=>1,
    "startup"=>"java -Xms128M -Xmx{{SERVER_MEMORY}}M -jar {{SERVER_JARFILE}}",
    "env_SERVER_JARFILE"=>"server.jar",
    "env_VANILLA_VERSION"=>"latest"
]);
```

These parameters will be used in the POST request sent to Pterodactyl servers, you can find more information about the parameters needed for each action on
[Pterodactyl's official API documentation](https://pterodactyl.readme.io/v0.6/reference).

Notice that this request for example will only start the server creation process, your server might need a few minutes before it completes provisioning, you'll need to check
the Server's `$installed` property to know if it's ready or not yet.

## Managing Users

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
$pterodactyl->serverex($serverExternalId);
$pterodactyl->createServer(array $data);
$pterodactyl->deleteServer($serverId);

// Server access
$pterodactyl->suspendServer($serverId);
$pterodactyl->unsuspendServer($serverId);
```

On a Server instance you may also call:

```php
$server->delete();
$server->suspend();
$server->unsuspend();
```

## Using Servers

```php
$pterodactyl->powerServer($serverUuid, $action); // 'start', 'stop', 'restart', 'kill'
$pterodactyl->commandServer($serverUuid, $command);
```

On a Server instance you may also call:

```php
$server->power($action); // 'start', 'stop', 'restart', 'kill'
$server->command($command);
```

## License

`hcgcloud/pterodactyl-sdk` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hcgcloud/pterodactyl-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/hcgcloud/pterodactyl-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
[link-downloads]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
