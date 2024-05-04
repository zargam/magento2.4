<?php declare(strict_types=1);

namespace Zargam\ChangeOrderStatusColor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderBgColor extends AbstractDb
{
    /** @var string Main table name */
    const MAIN_TABLE = 'order_bg_color_change';

    /** @var string Main table primary key field name */
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
