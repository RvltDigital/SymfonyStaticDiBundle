<?php

namespace RvltDigital\StaticDiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class MakeServicesPublicCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->getParameter('rvlt_digital.internal.static_di.services_public')) {
            return;
        }

        foreach ($container->getServiceIds() as $serviceId) {
            $definition = $container->getDefinition($serviceId);
            if (!$definition->isPublic()) {
                $definition->setPublic(true);
            }
        }
    }
}
