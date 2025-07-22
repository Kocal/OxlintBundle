<?php

declare(strict_types=1);

namespace Kocal\OxlintBundle;

use Kocal\OxlintBundle\DependencyInjection\OxlintExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class KocalOxlintBundle extends Bundle
{
    protected function createContainerExtension(): ?ExtensionInterface
    {
        return new OxlintExtension();
    }
}
