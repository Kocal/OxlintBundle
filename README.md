# OxlintBundle

[![.github/workflows/ci.yaml](https://github.com/Kocal/OxlintBundle/actions/workflows/ci.yaml/badge.svg)](https://github.com/Kocal/OxlintBundle/actions/workflows/ci.yaml)
[![Packagist Version](https://img.shields.io/packagist/v/kocal/oxlint-bundle)](https://packagist.org/packages/kocal/oxlint-bundle)

A Symfony Bundle to easily download and use [Oxlint](https://oxc.rs/docs/guide/usage/linter) (from the [Oxc project](https://oxc.rs/)) in your Symfony applications,
to lint your front assets without needing Node.js (ex: when using [Symfony AssetMapper](https://symfony.com/doc/current/frontend/asset_mapper.html)).

> [!TIP]
> If you prefer to use Biome.js instead, check [Kocal/BiomeJsBundle](https://github.com/Kocal/BiomeJsBundle)!

---

## Installation

Install the bundle with Composer:

```shell
composer require kocal/oxlint-bundle --dev
```

If you use [Symfony Flex](https://symfony.com/doc/current/setup/flex.html), everything must be configured automatically.
If that's not the case, please follow the next steps:

<details>
<summary>Manual installation steps</summary>

1. Register the bundle in your `config/bundles.php` file:

```php
return [
    // ...
    Kocal\OxlintBundle\KocalOxlintBundle::class => ['dev' => true],
];
```

2. Create the configuration file `config/packages/kocal_oxlint.yaml`:

```yaml
when@dev:
    kocal_oxlint:
        # The Oxlint binary version to use, that you can find at https://github.com/oxc-project/oxc/tags,
        # it follows the pattern "oxlint_v<binary_version>"
        binary_version: '1.8.0'
```

3. Create the recommended `.oxlintrc.json` file at the root of your project:

```json
{
  "ignorePatterns": [
    "assets/vendor/**",
    "public/assets/**",
    "public/bundles/**",
    "var/**",
    "vendor/**"
  ]
}
```

</details>

## Configuration

The bundle is configured in the `config/packages/kocal_oxlint.yaml` file:

```yaml
when@dev:
    kocal_oxlint:

        # The Oxlint binary version to use, that you can find at https://github.com/oxc-project/oxc/tags,
        # it follows the pattern "oxlint_v<binary_version>"
        binary_version: '1.8.0'
```

## Usage

### `oxlint:download`

Download the Oxlint binary for your configured version and for your platform (Linux, macOS, Windows).

By default, the command will download the binary in the `bin/` directory of your project.

```shell
php bin/console oxlint:download
bin/oxlint --version

# or, with a custom destination directory
php bin/console oxlint:download path/to/bin
path/to/bin/oxlint --version
```

## Inspirations

- https://github.com/SymfonyCasts/tailwind-bundle
- https://github.com/Kocal/BiomeJsBundle
