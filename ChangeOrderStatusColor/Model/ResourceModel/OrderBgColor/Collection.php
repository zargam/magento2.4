<?php declare(strict_types=1);

namespace Zargam\ChangeOrderStatusColor\Model\ResourceModel\OrderBgColor;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Zargam\ChangeOrderStatusColor\Model\OrderBgColor;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(OrderBgColor::class, \Zargam\ChangeOrderStatusColor\Model\ResourceModel\OrderBgColor::class);
    }
}
