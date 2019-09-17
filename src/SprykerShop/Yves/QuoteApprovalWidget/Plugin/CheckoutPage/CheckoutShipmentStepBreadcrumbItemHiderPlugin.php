<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\QuoteApprovalWidget\Plugin\CheckoutPage;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use SprykerShop\Yves\CheckoutPageExtension\Dependency\Plugin\CheckoutShipmentStepBreadcrumbItemHiderPluginInterface;

/**
 * @method \SprykerShop\Yves\QuoteApprovalWidget\QuoteApprovalWidgetFactory getFactory()
 */
class CheckoutShipmentStepBreadcrumbItemHiderPlugin extends AbstractPlugin implements CheckoutShipmentStepBreadcrumbItemHiderPluginInterface
{
    /**
     * {@inheritdoc}
     * - Makes a call to quote client to get quote lock.
     * - Makes a call to quote approval client to determine that quote status is not declined.
     * - Applied on breadcrumb item to shipment step.
     * - Returns true if quote is locked and not in status declined.
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBreadcrumbItemHidden(QuoteTransfer $quoteTransfer): bool
    {
        $isQuoteLocked = $this->getFactory()
            ->getQuoteClient()
            ->isQuoteLocked($quoteTransfer);

        $isQuoteDeclined = $this->getFactory()
            ->getQuoteApprovalClient()
            ->isQuoteDeclined($quoteTransfer);

        return $isQuoteLocked && !$isQuoteDeclined;
    }
}
