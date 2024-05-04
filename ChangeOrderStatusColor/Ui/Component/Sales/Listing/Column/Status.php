<?php
namespace Zargam\ChangeOrderStatusColor\Ui\Component\Sales\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Zargam\ChangeOrderStatusColor\Model\OrderBgColorFactory;

class Status extends Column
{
    /** @var StatusColor */
    protected OrderBgColorFactory $orderBgColorFactory;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderBgColorFactory $orderBgColorFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->orderBgColorFactory = $orderBgColorFactory;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        $orderFactory= $this->orderBgColorFactory->Create();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
               // $item['status_color']='#ff00b0';
                 $od=$orderFactory->getCollection()->addFieldToFilter("status", $item[$this->getData('name')])->getdata();
                 if(!empty($od)){
                    $item['status_color']= $od[0]['color'];
                 }else{
                    $item['status_color']= 'transparent';
                 }
              }
           }

        return $dataSource;
    }
}
