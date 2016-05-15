<?php

/**
 * AistInsight (http://mateuszsitek.com/projects/aist-insight)
 *
 * @link      http://github.com/ma-si/aist-insight for the canonical source repository
 * @copyright Copyright (c) 2006-2016 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistInsightTest;

use AistInsight\Module;
use PHPUnit_Framework_TestCase;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    /** @var Module */
    private $module;

    /**
     * __NAMESPACE__ of module
     *
     * @var string
     */
    private $namespace;

    public function setUp()
    {
        $this->module = new Module();
        $this->namespace = 'AistInsight';
    }

    public function testGetConfig()
    {
        $config = $this->module->getConfig();

        $expectedConfig = [
            'view_helpers' => [
                'invokables' => [
                    'insight' => $this->namespace . '\View\Helper\Insight',
                ],
            ],
        ];

        $this->assertInternalType('array', $config);
        $this->assertArrayHasKey('view_helpers', $config);
        $this->assertSame($expectedConfig, $config);
        $this->assertSame($config, unserialize(serialize($config)));
    }

    public function testGetAutoloaderConfig()
    {
        $config = $this->module->getAutoloaderConfig();

        $expectedAutoloaderConfig = [
            'Zend\Loader\ClassMapAutoloader' => [
                realpath(__DIR__ . '/../..') . '/autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    $this->namespace => realpath(__DIR__ . '/../..') . '/src/' . $this->namespace,
                ],
            ],
        ];

        $this->assertSame($expectedAutoloaderConfig, $config);
    }
}
