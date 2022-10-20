<?php

declare(strict_types=1);

namespace Comwrap\WebapiAsyncObjectValidation\Magento\Framework\EntityManager;

use Comwrap\WebapiAsyncObjectValidation\Magento\AsynchronousOperations\Model\Bulk;
use Comwrap\WebapiAsyncObjectValidation\Magento\AsynchronousOperations\Model\BulkFactory;
use Comwrap\WebapiAsyncObjectValidation\Magento\AsynchronousOperations\Model\ResourceModel\Bulk as BulkResource;
use Magento\Framework\EntityManager\CallbackHandler;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\OperationPool;
use Magento\Framework\EntityManager\TypeResolver;

class EntityManager extends \Magento\Framework\EntityManager\EntityManager
{
    /** @var BulkResource */
    private $bulkResource;

    /** @var BulkFactory */
    private $bulkFactory;

    /**
     * @param OperationPool $operationPool
     * @param MetadataPool $metadataPool
     * @param TypeResolver $typeResolver
     * @param CallbackHandler $callbackHandler
     * @param BulkResource $bulkResource
     * @param BulkFactory $bulkFactory
     */
    public function __construct(
        OperationPool $operationPool,
        MetadataPool $metadataPool,
        TypeResolver $typeResolver,
        CallbackHandler $callbackHandler,
        BulkResource $bulkResource,
        BulkFactory $bulkFactory
    ) {
        parent::__construct($operationPool, $metadataPool, $typeResolver, $callbackHandler);
        $this->bulkResource = $bulkResource;
        $this->bulkFactory = $bulkFactory;
    }

    /**
     * Implement logic for the Load operation
     *
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function load($entity, $identifier, $arguments = []): object
    {
        $bulk = $this->bulkFactory->create();
        $this->bulkResource->load($bulk, $identifier, 'uuid');
        return $entity->setData($bulk->getData());
    }

    /**
     * Implement logic for the Save operation
     *
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function save($entity, $arguments = []): object
    {
        /** @var Bulk $bulk */
        $bulk = $this->bulkFactory->create(['data' => $entity->getData()]);
        $bulk->setHasDataChanges(true);
        $this->bulkResource->save($bulk);
        return $entity;
    }

    /**
     * Implement logic for the Delete operation
     *
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function delete($entity, $arguments = []): bool
    {
        $bulk = $this->bulkFactory->create();
        $this->bulkResource->load($bulk, $entity->getBulkId(), 'uuid');
        $this->bulkResource->delete($bulk);
        return true;
    }
}