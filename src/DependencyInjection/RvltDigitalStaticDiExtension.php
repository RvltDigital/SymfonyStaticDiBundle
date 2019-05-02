<?php

namespace RvltDigital\StaticDiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class RvltDigitalStaticDiExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configs = $this->processConfiguration(new Configuration(), $configs);
        $container->setParameter('rvlt_digital.internal.static_di.services_public', $configs['make_services_public'] ?? false);
    }
}
