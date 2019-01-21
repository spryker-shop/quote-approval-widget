<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\QuoteApprovalWidget\Widget;

use Generated\Shared\Transfer\QuoteApprovalCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\QuoteApproval\QuoteApprovalConfig;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\QuoteApprovalWidget\QuoteApprovalWidgetFactory getFactory()
 */
class QuoteApprovalWidget extends AbstractWidget
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     */
    public function __construct(QuoteTransfer $quoteTransfer)
    {
        $this->addParameter('quoteTransfer', $quoteTransfer);
        $this->addParameter('quoteApprovalCollection', $this->getQuoteApprovalCollectionByCurrentCustomer($quoteTransfer));
        $this->addParameter('waitingStatus', QuoteApprovalConfig::STATUS_WAITING);
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'QuoteApprovalWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@QuoteApprovalWidget/views/quote-approval-widget/quote-approval-widget.twig';
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalCollectionTransfer
     */
    protected function getQuoteApprovalCollectionByCurrentCustomer(QuoteTransfer $quoteTransfer): QuoteApprovalCollectionTransfer
    {
        $quoteApprovalCollection = new QuoteApprovalCollectionTransfer();

        $customer = $this->getFactory()->getCustomerClient()->getCustomer();
        foreach ($quoteTransfer->getApprovals() as $quoteApprovalTransfer) {
            if ($quoteApprovalTransfer->getApprover()->getIdCompanyUser() === $customer->getCompanyUserTransfer()->getIdCompanyUser()) {
                $quoteApprovalCollection->addQuoteApproval($quoteApprovalTransfer);
            }
        }

        return $quoteApprovalCollection;
    }
}