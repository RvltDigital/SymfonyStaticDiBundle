<?php

namespace RvltDigital\StaticDiBundle;

use RvltDigital\StaticDiBundle\DependencyInjection\Compiler\MakeServicesPublicCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RvltDigitalStaticDiBundle extends Bundle
{
    public function boot()
    {
        StaticDI::setContainer($this->container);
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(
            new MakeServicesPublicCompilerPass(),
            PassConfig::TYPE_BEFORE_REMOVING,
            -1000
        );
    }
}
