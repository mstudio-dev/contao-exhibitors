<?php

declare(strict_types=1);

namespace Mstudio\ContaoExhibitorsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContaoExhibitorsExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container): void
    {
        // Ensure templates are discoverable by Twig regardless of Contao's
        // filesystem loader cache state.
        $container->prependExtensionConfig('twig', [
            'paths' => [\dirname(__DIR__, 2) . '/contao/templates/twig' => null],
        ]);
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config')
        );

        $loader->load('services.yaml');
    }
}
