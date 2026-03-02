<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\QuoteApprovalWidget\Widget;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteApprovalTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\QuoteApprovalWidget\QuoteApprovalWidgetFactory getFactory()
 * @method \SprykerShop\Yves\QuoteApprovalWidget\QuoteApprovalWidgetConfig getConfig()
 */
class QuoteApprovalWidget extends AbstractWidget
{
    /**
     * @var string
     */
    protected const PARAMETER_IS_VISIBLE = 'isVisible';

    /**
     * @var string
     */
    protected const IS_QUOTE_APPLICABLE_FOR_APPROVAL_PROCESS = 'isQuoteApplicableForApprovalProcess';

    public function __construct(QuoteTransfer $quoteTransfer)
    {
        $this->addParameter('quoteTransfer', $quoteTransfer);
        $this->addParameter('quoteOwner', $this->getQuoteOwner($quoteTransfer));
        $this->addParameter('waitingQuoteApproval', $this->getWaitingQuoteApprovalByCurrentCompanyUser($quoteTransfer));
        $this->addParameter('canQuoteBeApprovedByCurrentCustomer', $this->canQuoteBeApprovedByCurrentCustomer($quoteTransfer));
        $this->addIsVisibleParameter($quoteTransfer);
        $this->addIsQuoteApplicableForApprovalProcessParameter($quoteTransfer);
    }

    public static function getName(): string
    {
        return 'QuoteApprovalWidget';
    }

    public static function getTemplate(): string
    {
        return '@QuoteApprovalWidget/views/quote-approval-widget/quote-approval-widget.twig';
    }

    protected function addIsVisibleParameter(QuoteTransfer $quoteTransfer): void
    {
        $this->addParameter(
            static::PARAMETER_IS_VISIBLE,
            $this->hasQuoteApprovalsForCurrentCompanyUser($quoteTransfer),
        );
    }

    protected function getQuoteOwner(QuoteTransfer $quoteTransfer): ?CustomerTransfer
    {
        if (!$quoteTransfer->getCustomerReference()) {
            return null;
        }

        $customerTransfer = (new CustomerTransfer())
            ->setCustomerReference($quoteTransfer->getCustomerReference());

        $customerResponseTransfer = $this->getFactory()
            ->getCustomerClient()
            ->findCustomerByReference($customerTransfer);

        $customerResponseTransfer->requireCustomerTransfer();

        return $customerResponseTransfer->getCustomerTransfer();
    }

    protected function getWaitingQuoteApprovalByCurrentCompanyUser(QuoteTransfer $quoteTransfer): ?QuoteApprovalTransfer
    {
        if (!$this->findCurrentCompanyUser()) {
            return null;
        }

        return $this->getFactory()
            ->getQuoteApprovalClient()
            ->findWaitingQuoteApprovalByIdCompanyUser(
                $quoteTransfer,
                $this->findCurrentCompanyUser()
                    ->getIdCompanyUser(),
            );
    }

    protected function hasQuoteApprovalsForCurrentCompanyUser(QuoteTransfer $quoteTransfer): bool
    {
        if (!$this->findCurrentCompanyUser()) {
            return false;
        }

        return $this->getFactory()
            ->getQuoteApprovalClient()
            ->isCompanyUserInQuoteApproverList(
                $quoteTransfer,
                $this->findCurrentCompanyUser()
                    ->getIdCompanyUser(),
            );
    }

    protected function findCurrentCompanyUser(): ?CompanyUserTransfer
    {
        $customerTransfer = $this->getFactory()
            ->getCustomerClient()
            ->getCustomer();

        if (!$customerTransfer) {
            return null;
        }

        return $customerTransfer->getCompanyUserTransfer();
    }

    protected function canQuoteBeApprovedByCurrentCustomer(QuoteTransfer $quoteTransfer): bool
    {
        return $this->getFactory()->getQuoteApprovalClient()
            ->canQuoteBeApprovedByCurrentCustomer($quoteTransfer);
    }

    protected function addIsQuoteApplicableForApprovalProcessParameter(QuoteTransfer $quoteTransfer): void
    {
        $this->addParameter(
            static::IS_QUOTE_APPLICABLE_FOR_APPROVAL_PROCESS,
            $this->getFactory()
                ->getQuoteApprovalClient()
                ->isQuoteApplicableForApprovalProcess($quoteTransfer),
        );
    }
}
