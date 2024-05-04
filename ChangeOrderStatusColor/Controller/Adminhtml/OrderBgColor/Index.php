<?php declare(strict_types=1);

namespace Zargam\ChangeOrderStatusColor\Controller\Adminhtml\OrderBgColor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Zargam_ChangeOrderStatusColor::order_status_background_color';

    /** @var PageFactory */
    protected $pageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        $page = $this->pageFactory->create();
        $page->setActiveMenu('Zargam_ChangeOrderStatusColor::order_status_background_color');
        $page->getConfig()->getTitle()->prepend(__('Add Color To Order Status'));

        return $page;
    }
}
