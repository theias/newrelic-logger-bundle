<?php

declare(strict_types=1);

namespace Tests\IAS\NewRelicLoggerBundle\DependencyInjection;

use IAS\NewRelicLoggerBundle\DependencyInjection\IASNewRelicLoggerExtension;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class IASNewRelicLoggerExtensionTest extends TestCase
{
    private $container;
    private const MINIMAL_CONFIG = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->container = new ContainerBuilder();
        $this->container->registerExtension(new IASNewRelicLoggerExtension());
    }

    protected function tearDown(): void
    {
        $this->container = null;
    }

    public function test_the_service_exists(): void
    {
        $this->load(['level' => Logger::DEBUG]);
        self::assertTrue($this->container->has('ias_new_relic_logger.handler'));
    }

    public function test_the_container_compiles(): void
    {
        $this->load(['level' => Logger::DEBUG]);
        $this->container->compile();
        self::assertTrue($this->container->isCompiled());
    }

    public function test_illegal_config_value(): void
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->load(['foo' => 'bar']);
    }

    public function test_illegal_config_type(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->load(['level' => []]);
    }

    private function load(array $configurationValues = []): void
    {
        $configs = [self::MINIMAL_CONFIG, $configurationValues];

        foreach ($this->container->getExtensions() as $extension) {
            if ($extension instanceof PrependExtensionInterface) {
                $extension->prepend($this->container);
            }

            $extension->load($configs, $this->container);
        }
    }
}
