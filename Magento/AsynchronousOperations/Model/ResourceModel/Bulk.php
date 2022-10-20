<?php

declare(strict_types=1);

namespace Comwrap\WebapiAsyncObjectValidation\Magento\AsynchronousOperations\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Bulk extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magento_bulk', 'id');
    }
}