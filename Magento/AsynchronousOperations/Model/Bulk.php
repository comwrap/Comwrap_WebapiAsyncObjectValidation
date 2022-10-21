<?php

declare(strict_types=1);

namespace Comwrap\WebapiAsyncObjectValidation\Magento\AsynchronousOperations\Model;

use Magento\Framework\Model\AbstractModel;

class Bulk extends AbstractModel
{
    /**
     * Get entity id
     *
     * @return string|int|null
     */
    public function getId(): int|string|null
    {
        return $this->getData('id');
    }

    /**
     * Set id for entity
     *
     * @param $id
     * @return $this
     */
    public function setId($id): Bulk
    {
        return $this->setData('id', $id);
    }

    /**
     * Initialise resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('Magento\AsynchronousOperations\Model\ResourceModel\Bulk');
    }
}