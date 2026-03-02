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

interface QuoteApprovalWidgetToQuoteApprovalClientInterface
{
    public function isQuoteInApprovalProcess(QuoteTransfer $quoteTransfer): bool;

    public function canQuoteBeApprovedByCurrentCustomer(QuoteTransfer $quoteTransfer): bool;

    public function isCompanyUserInQuoteApproverList(QuoteTransfer $quoteTransfer, int $idCompanyUser): bool;

    public function findWaitingQuoteApprovalByIdCompanyUser(QuoteTransfer $quoteTransfer, int $idCompanyUser): ?QuoteApprovalTransfer;

    public function createQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer;

    public function removeQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer;

    public function getQuoteApproverList(QuoteTransfer $quoteTransfer): CompanyUserCollectionTransfer;

    public function calculateApproveQuotePermissionLimit(QuoteTransfer $quoteTransfer, CompanyUserTransfer $companyUserTransfer): ?int;

    public function calculatePlaceOrderPermissionLimit(QuoteTransfer $quoteTransfer, CompanyUserTransfer $companyUserTransfer): ?int;

    public function isQuoteWaitingForApproval(QuoteTransfer $quoteTransfer): bool;

    public function isQuoteApproved(QuoteTransfer $quoteTransfer): bool;

    public function calculateQuoteStatus(QuoteTransfer $quoteTransfer): ?string;

    public function approveQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer;

    public function declineQuoteApproval(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): QuoteApprovalResponseTransfer;

    public function isQuoteApplicableForApprovalProcess(QuoteTransfer $quoteTransfer): bool;
}
