<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 29.08.17
 * Time: 12:08
 */

namespace Rusblaze\CoreDomainBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RusblazeCoreDomainExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('repositories.xml');
    }
}