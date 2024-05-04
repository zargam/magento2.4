<?php declare(strict_types=1);

namespace Zargam\ChangeOrderStatusColor\Controller\Adminhtml\OrderBgColor;

use Zargam\ChangeOrderStatusColor\Model\OrderBgColor;
use Zargam\ChangeOrderStatusColor\Model\OrderBgColorFactory;
use Zargam\ChangeOrderStatusColor\Model\ResourceModel\OrderBgColor as OrderBgColorResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Zargam_ChangeOrderStatusColor::order_status_background_color_delete';

    protected $orderBgColorFactory;
    protected $orderBgColorResource;

    public function __construct(
        Context $context,
        OrderBgColorFactory $orderBgColorFactory,
        OrderBgColorResource $orderBgColorResource
    ) {
        $this->orderBgColorFactory  = $orderBgColorFactory;
        $this->orderBgColorResource = $orderBgColorResource;
        parent::__construct($context);
    }

    public function execute(): Redirect
    {
        try {
            $id = $this->getRequest()->getParam('id');
            $orderbgcolor = $this->orderBgColorFactory->create();
            $this->orderBgColorResource->load($orderbgcolor, $id);
            if ($orderbgcolor->getId()) {
                $this->orderBgColorResource->delete($orderbgcolor);
                $this->messageManager->addSuccessMessage(__('The record has been deleted.'));
            } else {
                $this->messageManager->addErrorMessage(__('The record does not exist.'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        /** @var Redirect $redirect */
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('*/*');
    }
}
