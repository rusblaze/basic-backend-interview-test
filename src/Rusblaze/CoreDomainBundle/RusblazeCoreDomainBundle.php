<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 28.08.17
 * Time: 16:35
 */

namespace Rusblaze\CoreDomainBundle;

use Rusblaze\CoreDomainBundle\DependencyInjection\RusblazeCoreDomainExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RusblazeCoreDomainBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new RusblazeCoreDomainExtension();
    }
}