<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\QuoteApprovalWidget\Widget;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\QuoteApprovalWidget\QuoteApprovalWidgetFactory getFactory()
 */
class QuoteApprovalStatusWidget extends AbstractWidget
{
    public function __construct(QuoteTransfer $quoteTransfer)
    {
        $this->addParameter('quoteStatus', $this->calculateQuoteStatus($quoteTransfer));
    }

    public static function getName(): string
    {
        return 'QuoteApprovalStatusWidget';
    }

    public static function getTemplate(): string
    {
        return '@QuoteApprovalWidget/views/quote-approval-status-widget/quote-approval-status-widget.twig';
    }

    protected function calculateQuoteStatus(QuoteTransfer $quoteTransfer): ?string
    {
        return $this->getFactory()
            ->getQuoteApprovalClient()
            ->calculateQuoteStatus($quoteTransfer);
    }
}
