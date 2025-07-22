<?php

declare(strict_types=1);

use Kocal\OxlintBundle\Command\OxlintDownloadCommand;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\abstract_arg;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set('oxlint.command.download', OxlintDownloadCommand::class)
        ->args([
            abstract_arg('Oxlint binary version'),
            service('filesystem'),
        ])
        ->tag('console.command');
};
