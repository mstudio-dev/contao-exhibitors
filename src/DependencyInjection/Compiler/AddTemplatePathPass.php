<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AddTemplatePathPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('contao.twig.filesystem_loader')) {
            return;
        }

        $path = \dirname(__DIR__, 3) . '/contao/templates';

        if (!is_dir($path)) {
            return;
        }

        $container
            ->getDefinition('contao.twig.filesystem_loader')
            ->addMethodCall('addPath', [$path, 'Contao_ContaoExhibitorsBundle']);
    }
}
