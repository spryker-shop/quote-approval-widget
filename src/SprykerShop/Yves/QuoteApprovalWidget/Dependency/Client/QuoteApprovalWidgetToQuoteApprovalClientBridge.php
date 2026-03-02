<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\QuoteApprovalWidget\Dependency\Client;

use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\QuoteApprovalRequestTransfer;
use Generated\Shared\Transfer\QuoteApprovalResponseTransfer;
use Generated\Shared\Transfer\QuoteApprovalTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteApprovalWidgetToQuoteApprovalClientBridge implements QuoteApprovalWidgetToQuoteApprovalClientInterface
{
    /**
     * @var \Spryker\Client\QuoteApproval\QuoteApprovalClientInterface
     */
    protected $quoteApprovalClient;

    /**
     * @param \Spryker\Client\QuoteApproval\QuoteApprovalClientInterface $quoteApprovalClient
     */
    public function __construct($quoteApprovalClient)
    {
        $this->quoteApprovalClient = $quoteApprovalClient;
    }

    public function isQuoteInApprovalProcess(QuoteTransfer $quoteTransfer): bool
    {
        return $this->quoteApprovalClient->isQuoteInApprovalProcess($quoteTransfer);
    }

    public function canQuoteBeApprovedByCurrentCustomer(QuoteTransfer $quoteTransfer): bool
    {
        return $this->quoteApprovalClient->canQuoteBeApprovedByCurrentCustomer($quoteTransfer);
    }

    public function isCompanyUserInQuoteApproverList(QuoteTransfer $quoteTransfer, int $idCompanyUser): bool
    {
        return $this->quoteApprovalClient->isCompanyUserInQuoteApproverList($quoteTransfer, $idCompanyUser);
    }

    public function findWaitingQuoteApprovalByIdCompanyUser(QuoteTransfer $quoteTransfer, int $idCompanyUser): ?QuoteApprovalTransfer
    {
        return $this->quoteApprovalClient->findWaitingQuoteApprovalByIdCompanyUser($quoteTransfer, $idCompanyUser);
    }

    public function createQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer
    {
        return $this->quoteApprovalClient->createQuoteApproval($quoteApprovalRequestTransfer);
    }

    public function removeQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer
    {
        return $this->quoteApprovalClient->removeQuoteApproval($quoteApprovalRequestTransfer);
    }

    public function getQuoteApproverList(QuoteTransfer $quoteTransfer): CompanyUserCollectionTransfer
    {
        return $this->quoteApprovalClient->getQuoteApproverList($quoteTransfer);
    }

    public function calculateApproveQuotePermissionLimit(QuoteTransfer $quoteTransfer, CompanyUserTransfer $companyUserTransfer): ?int
    {
        return $this->quoteApprovalClient->calculateApproveQuotePermissionLimit($quoteTransfer, $companyUserTransfer);
    }

    public function calculatePlaceOrderPermissionLimit(QuoteTransfer $quoteTransfer, CompanyUserTransfer $companyUserTransfer): ?int
    {
        return $this->quoteApprovalClient->calculatePlaceOrderPermissionLimit($quoteTransfer, $companyUserTransfer);
    }

    public function isQuoteWaitingForApproval(QuoteTransfer $quoteTransfer): bool
    {
        return $this->quoteApprovalClient->isQuoteWaitingForApproval($quoteTransfer);
    }

    public function isQuoteApproved(QuoteTransfer $quoteTransfer): bool
    {
        return $this->quoteApprovalClient->isQuoteApproved($quoteTransfer);
    }

    public function calculateQuoteStatus(QuoteTransfer $quoteTransfer): ?string
    {
        return $this->quoteApprovalClient->calculateQuoteStatus($quoteTransfer);
    }

    public function approveQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer
    {
        return $this->quoteApprovalClient->approveQuoteApproval($quoteApprovalRequestTransfer);
    }

    public function declineQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer
    {
        return $this->quoteApprovalClient->declineQuoteApproval($quoteApprovalRequestTransfer);
    }

    public function isQuoteApplicableForApprovalProcess(QuoteTransfer $quoteTransfer): bool
    {
        return $this->quoteApprovalClient->isQuoteApplicableForApprovalProcess($quoteTransfer);
    }
}
