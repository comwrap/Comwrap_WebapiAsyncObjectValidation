<?php

declare(strict_types=1);

namespace Comwrap\WebapiAsyncObjectValidation\Plugin\Magento\Framework\MessageQueue;

use Comwrap\WebapiAsyncObjectValidation\Model\Config;
use Magento\Framework\MessageQueue\MessageValidator as OriginMessageValidator;

class MessageValidator
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
     * Skip validation if array mode is set
     *
     * @param OriginMessageValidator $subject
     * @param \Closure $proceed
     * @param mixed ...$args
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundValidate(OriginMessageValidator $subject, \Closure $proceed, ...$args): void
    {
        if ($this->config->isPublishingArrayMode()) {
            return;
        }
        $proceed(...$args);
    }
}