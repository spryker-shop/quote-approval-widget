<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\QuoteApprovalWidget\Dependency\Client;

use Generated\Shared\Transfer\MoneyTransfer;

interface QuoteApprovalWidgetToMoneyClientInterface
{
    public function fromInteger(int $amount, ?string $isoCode): MoneyTransfer;

    public function formatWithSymbol(MoneyTransfer $moneyTransfer): string;
}
