# Pterodactyl PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Chat on Gitter][ico-chat]][link-chat]
![Coverage][ico-coverage]

## Important
**As we are upgrading it to support version 0.7.x, some APIs are still not integrated, and we can't guarantee that there are no bugs. You can see a list that what we completed and planned below. Unless you already know the possible consequences, don't use it in production.**

## ToDo List
The following ticked items are upgraded & tested.
### Server
All done, you can see available functions below.

### User
All done, you can see available functions below.

### Node
- [x] $pterodactyl->nodes();
- [ ] $pterodactyl->node($nodeId);
- [ ] $pterodactyl->createNode(array $data);
- [ ] $pterodactyl->updateNode($nodeId, array $data);
- [ ] $pterodactyl->deleteNode($nodeId);

#### Node Instance
- [ ] $node->update(array $data);
- [ ] $node->delete();

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
$egg = $pterodactyl->egg($nest_id, $egg_id);
$server = $pterodactyl->createServer([
    "external_id" => $external_id,
    "name" => $name,
    "user" => $user_id,
    "egg" => $egg_id,
    "pack" => 0,
    "docker_image" => $egg->dockerImage,
    "skip_scripts" => false,
    "environment" => [],
    "limits" => [
        "memory" => $memory,
        "swap" => $swap,
        "disk" => $disk,
        "io" => $io,
        "cpu" => $cpu
    ],
    "feature_limits" => [
        "databases" => $databases,
        "allocations" => $allocations
    ],
    "startup" => $egg->startup,
    "description" => "",
    "deploy" => [
        "locations" => [$location_id],
        "dedicated_ip" => false,
        "port_range" => []
    ],
    "start_on_completion" => true
]);
```

These parameters will be used in the POST request sent to Pterodactyl servers, you can find more information about the parameters needed in panel source: [app\Http\Requests\Api\Application\Servers\StoreServerRequest.php](https://github.com/pterodactyl/panel/blob/develop/app/Http/Requests/Api/Application/Servers/StoreServerRequest.php)

Notice that this request for example will only start the server creation process, your server might need a few minutes before it completes provisioning, you'll need to check
the Server's `$installed` property to know if it's ready or not yet.

Or use the following code to create a new user:
```php
$user = $pterodactyl->createUser([
    "external_id" => "2", //Optional
    "email" => 'test@test.com',
    "username" => 'TestUser',
    "first_name" => 'Test',
    "last_name" => 'User',
    "language" => 'en',
    "password" => '123456'
]);
```

## Managing Users

```php
$pterodactyl->users();
$pterodactyl->user($userId);
$pterodactyl->userEx($userExternalId);
$pterodactyl->createUser(array $data);
$pterodactyl->updateUser($userId, array $data);
$pterodactyl->deleteUser($userId);
```

On a User instance you may also call:

```php
$user->update(array $data);
$user->delete();
```

## Managing Servers

```php
//Works with Application API
$pterodactyl->servers();
$pterodactyl->server($serverId);
$pterodactyl->serverEx($serverExternalId);
$pterodactyl->createServer(array $data);
$pterodactyl->deleteServer($serverId);
$pterodactyl->forceDeleteServer($serverId);
$pterodactyl->suspendServer($serverId);
$pterodactyl->unsuspendServer($serverId);
$pterodactyl->reinstallServer($serverId);
$pterodactyl->rebuildServer($serverId);
$pterodactyl->updateServerDetails($serverId, array $data);
$pterodactyl->updateServerBuild($serverId, array $data);
$pterodactyl->updateServerStartup($serverId, array $data);

//Works with Account API
//Please note that the following $serverIdentifier is not same as $serverId, it is a short version of server UUID.
$pterodactyl->listServers();
$pterodactyl->getServer($serverIdentifier);
$pterodactyl->powerServer($serverIdentifier, $action); //'start', 'stop', 'restart', 'kill'
$pterodactyl->commandServer($serverIdentifier, $command);

```

On a Server instance you may also call:

```php
//Works with Application API
$server->delete();
$server->forceDelete();
$server->suspend();
$server->unsuspend();
$server->reinstall();
$server->rebuild();
$server->updateDetails(array $data);
$server->updateBuild(array $data);
$server->updateStartup(array $data);

//Works with Account API
$server->power($action); //'start', 'stop', 'restart', 'kill
$server->command($command);
```

## Managing Nests

```php
$pterodactyl->nests();
$pterodactyl->nest($nestId);
```

## Managing Eggs

```php
$pterodactyl->eggs($nestId);
$pterodactyl->egg($nestId, $eggId);
```

## License

`hcgcloud/pterodactyl-sdk` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hcgcloud/pterodactyl-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/hcgcloud/pterodactyl-sdk.svg?style=flat-square
[ico-coverage]: https://api.codacy.com/project/badge/Grade/aae8d10d1da04cbda8723e56bbfd71dd
[ico-chat]: https://img.shields.io/gitter/room/hcgcloud/pterodactyl-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
[link-downloads]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
[link-chat]: https://gitter.im/pterodactyl-sdk/community?utm_source=share-link&utm_medium=link&utm_campaign=share-link
