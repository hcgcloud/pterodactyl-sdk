# Pterodactyl PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Chat on Discord][ico-chat]][link-chat]

[Documentation](https://hcgcloud.github.io/pterodactyl-sdk-docs)

## Important
**As we are upgrading it to support version 0.7.x, some APIs are still not integrated, and we can't guarantee that there are no bugs. Unless you already know the possible consequences, don't use it in production.**

## Quick start

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

Then you can call the apis.

## Usage

Please check the [documentation](https://hcgcloud.github.io/pterodactyl-sdk-docs) for more details.

*As our documentation is not finished yet, you can check out the [legacy readme file](https://github.com/hcgcloud/pterodactyl-sdk/blob/2b1759961a5a92eb95a3c9d3b045bd8410bdd43f/README.md) for all functions available of this SDK.*

## License

`hcgcloud/pterodactyl-sdk` is licensed under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hcgcloud/pterodactyl-sdk.svg
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg
[ico-downloads]: https://img.shields.io/packagist/dt/hcgcloud/pterodactyl-sdk.svg
[ico-chat]: https://img.shields.io/discord/609764930899673092

[link-packagist]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
[link-downloads]: https://packagist.org/packages/hcgcloud/pterodactyl-sdk
[link-chat]: https://discord.gg/5KnNVfv
