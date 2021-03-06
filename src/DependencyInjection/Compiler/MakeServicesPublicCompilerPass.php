<?php

namespace RvltDigital\StaticDiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class MakeServicesPublicCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $publicServices = $container->getParameter('rvlt_digital.internal.static_di.public_services');
        assert(is_array($publicServices));
        foreach ($publicServices as $publicService) {
            try {
                $definition = $container->getDefinition($publicService);
                if (!$definition->isPublic()) {
                    $definition->setPublic(true);
                }
            } catch (ServiceNotFoundException $e) {
                // ignore, continue
            }
        }

        if (!$container->getParameter('rvlt_digital.internal.static_di.all_services_public')) {
            return;
        }

        foreach ($container->getServiceIds() as $serviceId) {
            try {
                $definition = $container->getDefinition($serviceId);
                if (!$definition->isPublic()) {
                    $definition->setPublic(true);
                }
            } catch (ServiceNotFoundException $e) {
                // ignore, continue
            }
        }
    }
}
