<?php declare(strict_types=1);

namespace Zargam\ChangeOrderStatusColor\Model;

use Magento\Framework\Model\AbstractModel;

class OrderBgColor extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\OrderBgColor::class);
    }
}
