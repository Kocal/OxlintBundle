<?php

declare(strict_types=1);

namespace Kocal\OxlintBundle;

/**
 * @internal
 */
final class OxlintBinary
{
    public static function getBinaryName(): string
    {
        $os = strtolower(\PHP_OS);
        $machine = strtolower(php_uname('m'));

        return match (true) {
            str_contains($os, 'darwin') => match ($machine) {
                'arm64' => 'oxlint-darwin-arm64',
                'x86_64' => 'oxlint-darwin-x64',
                default => throw new \Exception(sprintf('No matching machine found for Darwin platform (Machine: %s).', $machine)),
            },
            str_contains($os, 'linux') => match ($machine) {
                'arm64', 'aarch64' => self::isMusl() ? 'oxlint-linux-arm64-musl' : 'oxlint-linux-arm64-gnu',
                'x86_64' => self::isMusl() ? 'oxlint-linux-x64-musl' : 'oxlint-linux-x64-gnu',
                default => throw new \Exception(sprintf('No matching machine found for Linux platform (Machine: %s).', $machine)),
            },
            str_contains($os, 'win') => match ($machine) {
                'arm64' => 'oxlint-win32-arm64.exe',
                'x86_64', 'amd64' => 'oxlint-win32-x64.exe',
                default => throw new \Exception(sprintf('No matching machine found for Windows platform (Machine: %s).', $machine)),
            },
            default => throw new \Exception(sprintf('Unknown platform or architecture (OS: %s, Machine: %s).', $os, $machine)),
        };
    }

    /**
     * Whether the current PHP environment is using musl libc.
     * This is used to determine the correct Oxlint binary to download.
     */
    private static function isMusl(): bool
    {
        static $isMusl = null;

        if (is_bool($isMusl)) {
            return $isMusl;
        }

        if (!\function_exists('phpinfo')) {
            return $isMusl = false;
        }

        ob_start();
        phpinfo(\INFO_GENERAL);

        return $isMusl = 1 === preg_match('/--build=.*?-linux-musl/', ob_get_clean() ?: '');
    }
}
