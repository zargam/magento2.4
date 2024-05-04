<?php declare(strict_types=1);
namespace Zargam\ChangeOrderStatusColor\Ui\DataProvider;
use Zargam\ChangeOrderStatusColor\Model\ResourceModel\OrderBgColor\Collection;
use Zargam\ChangeOrderStatusColor\Model\ResourceModel\OrderBgColor\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class OrderBgColor extends AbstractDataProvider
{
    /** @var Collection $collection */
    protected $collection;

    /** @var array */
    private array $loadedData;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        if (!isset($this->loadedData)) {
            $this->loadedData = [];
            foreach ($this->collection->getItems() as $item) {
                $this->loadedData[$item->getData('id')] = $item->getData();
            }
        }

        return $this->loadedData;
    }
}
