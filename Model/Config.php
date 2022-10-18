<?php

declare(strict_types=1);

namespace Comwrap\WebapiAsyncObjectValidation\Model;

use Magento\Framework\App\Request\Http as HttpRequest;

class Config
{
    public const BULK_PROCESSOR_PATH_REGEXP = "/\/async\/bulk(\\/V.+)/";
    public const ARRAY_MODE_HEADER_KEY = 'disable-object-validation';

    /** @var HttpRequest */
    private HttpRequest $request;

    /** @var null|bool */
    private ?bool $isArrayMode = null;

    /**
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Check if is bulk api request and header is set
     *
     * @return bool
     */
    public function isPublishingArrayMode(): bool
    {
        if ($this->isArrayMode === null) {
            $this->isArrayMode =
                $this->isBulkApiRequest() && $this->request->getHeader(self::ARRAY_MODE_HEADER_KEY);
        }
        return $this->isArrayMode;
    }

    /**
     * Check if current request is bulk
     *
     * @return bool
     */
    public function isBulkApiRequest(): bool
    {
        if (preg_match(self::BULK_PROCESSOR_PATH_REGEXP, $this->request->getPathInfo()) === 1) {
            return true;
        }
        return false;
    }
}