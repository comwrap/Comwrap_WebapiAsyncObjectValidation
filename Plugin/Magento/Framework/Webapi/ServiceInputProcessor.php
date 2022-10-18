<?php

declare(strict_types=1);

namespace Comwrap\WebapiAsyncObjectValidation\Plugin\Magento\Framework\Webapi;

use Comwrap\WebapiAsyncObjectValidation\Model\Config;
use Magento\Framework\Webapi\ServiceInputProcessor as OriginServiceInputProcessor;

class ServiceInputProcessor
{
    /** @var Config */
    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Return array if array mode is set
     *
     * @param OriginServiceInputProcessor $subject
     * @param \Closure $proceed
     * @param string $serviceClassName
     * @param string $serviceMethodName
     * @param array $inputArray
     * @return array
     */
    public function aroundProcess(
        OriginServiceInputProcessor $subject,
        \Closure $proceed,
        string $serviceClassName,
        string $serviceMethodName,
        array $inputArray
    ): array
    {
        if ($this->config->isPublishingArrayMode()) {
            return [];
        }
        return $proceed($serviceClassName, $serviceMethodName, $inputArray);
    }
}