<?php

namespace RvltDigital\StaticDiBundle;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

final class StaticDI
{

    /**
     * @var Container|null
     */
    private static $di = null;

    private function __construct()
    {
    }

    public static function get(...$arguments)
    {
        return self::getInstance()->get(...$arguments);
    }

    public static function getParameter(...$arguments)
    {
        return self::getInstance()->getParameter(...$arguments);
    }

    /**
     * @deprecated
     * @return EntityManager
     */
    public static function gem()
    {
        trigger_error('The gem() method is deprecated, use getEntityManager() instead', E_USER_DEPRECATED);
        return self::getEntityManager();
    }

    /**
     * @return EntityManager
     */
    public static function getEntityManager()
    {
        return self::get('doctrine')->getManager();
    }

    /**
     * @deprecated
     * @param string $className
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public static function ger(string $className)
    {
        trigger_error('The ger() method is deprecated, use getEntityRepository() instead', E_USER_DEPRECATED);
        return self::getEntityRepository($className);
    }

    /**
     * @param string $className
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public static function getEntityRepository(string $className)
    {
        return self::getEntityManager()->getRepository($className);
    }

    /**
     * @return Translator
     */
    public static function getTranslator()
    {
        return self::getInstance()->get('translator');
    }

    /**
     * @return Container
     */
    public static function getInstance()
    {
        self::checkDi();
        return self::$di;
    }

    public static function setContainer(ContainerInterface $container): void
    {
        self::$di = $container;
    }

    public static function getCurrentRequest(): Request
    {
        /** @var RequestStack $requestStack */
        $requestStack = self::get('request_stack');
        return $requestStack->getCurrentRequest();
    }

    private static function checkDi(): void
    {
        if (self::$di === null) {
            throw new \LogicException('The container must be set first');
        }
    }
}
