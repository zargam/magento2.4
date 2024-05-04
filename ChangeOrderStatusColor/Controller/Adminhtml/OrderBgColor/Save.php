<?php declare(strict_types=1);

namespace Zargam\ChangeOrderStatusColor\Controller\Adminhtml\OrderBgColor;

use Zargam\ChangeOrderStatusColor\Model\OrderBgColor;
use Zargam\ChangeOrderStatusColor\Model\OrderBgColorFactory;
use Zargam\ChangeOrderStatusColor\Model\ResourceModel\OrderBgColor as OrderBgColorResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Zargam_ChangeOrderStatusColor::order_status_background_color_save';

    private OrderBgColorFactory $orderBgColorFactory;
    private OrderBgColorResource $orderBgColorResource;

    public function __construct(
        Context $context,
        OrderBgColorFactory  $orderBgColorFactory,
        OrderBgColorResource $orderBgColorResource
    ) {
        $this->orderBgColorFactory = $orderBgColorFactory;
        $this->orderBgColorResource = $orderBgColorResource;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $post = $this->getRequest()->getPost();

        $isExistingPost = $post->id;
        $orderbgcolor = $this->orderBgColorFactory->create();
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($isExistingPost) {
            try {
                $this->orderBgColorResource->load($orderbgcolor, $post->id);
                if (!$orderbgcolor->getData('id')) {
                    throw new NotFoundException(__('This record no longer exists.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirect->setPath('*/*/');
            }
        } else {
            unset($post->id);
            try{
              //  $key = array_search($post->status, array_column($orderbgcolor->getCollection()->getData(), 'status'));
                $key = array_search($post->status, array_column($orderbgcolor->getCollection()->getData(), 'status'));
                if ($key !== false) {
                    throw new LocalizedException(__('You have already added the color in this order status'));
                }
             } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                return $redirect->setPath('*/*/');
            }
        }

        $orderbgcolor->setData(array_merge($orderbgcolor->getData(), $post->toArray()));

        try {
            $this->orderBgColorResource->save($orderbgcolor);
            $this->messageManager->addSuccessMessage(__('The record has been saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the record.'));
            return $redirect->setPath('*/*/');
        }

        // On success, redirect back to the admin grid
        return $redirect->setPath('*/*/index');
    }
}
