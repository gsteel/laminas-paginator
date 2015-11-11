<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Paginator\Adapter\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class DbTableGatewayFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return DbTableGateway
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName(
            $options[0],
            isset($options[1]) ? $options[1] : null,
            isset($options[2]) ? $options[2] : null,
            isset($options[3]) ? $options[3] : null,
            isset($options[4]) ? $options[4] : null
        );
    }
}
