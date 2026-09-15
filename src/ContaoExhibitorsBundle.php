<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle;

use Mstudio\ContaoExhibitorsBundle\DependencyInjection\Compiler\AddTemplatePathPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoExhibitorsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $container->addCompilerPass(new AddTemplatePathPass());
    }
}

