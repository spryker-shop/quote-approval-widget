<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\QuoteApprovalWidget\Plugin\Router;

use SprykerShop\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use SprykerShop\Yves\Router\Route\RouteCollection;

class QuoteApprovalWidgetRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    protected const ROUTE_QUOTE_APPROVAL_APPROVE = 'quote-approval-approve';
    protected const ROUTE_QUOTE_APPROVAL_DECLINE = 'quote-approval-decline';
    protected const ROUTE_QUOTE_APPROVAL_CREATE = 'quote-approval-create';
    protected const ROUTE_QUOTE_APPROVAL_REMOVE = 'quote-approval-remove';

    protected const PATTERN_ID = '\d+';

    /**
     * @param \SprykerShop\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \SprykerShop\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addQuoteApprovalApproveRoute($routeCollection);
        $routeCollection = $this->addQuoteApprovalDeclineRoute($routeCollection);
        $routeCollection = $this->addCreateQuoteApprovalRoute($routeCollection);
        $routeCollection = $this->addRemoveQuoteApprovalRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @uses \SprykerShop\Yves\QuoteApprovalWidget\Controller\QuoteApprovalController::approveAction()
     *
     * @param \SprykerShop\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \SprykerShop\Yves\Router\Route\RouteCollection
     */
    protected function addQuoteApprovalApproveRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/quote-approval/approve/{idQuoteApproval}', 'QuoteApprovalWidget', 'QuoteApproval', 'approveAction');
        $route = $route->assert('idQuoteApproval', static::PATTERN_ID);
        $routeCollection->add(static::ROUTE_QUOTE_APPROVAL_APPROVE, $route);

        return $routeCollection;
    }

    /**
     * @uses \SprykerShop\Yves\QuoteApprovalWidget\Controller\QuoteApprovalController::declineAction()
     *
     * @param \SprykerShop\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \SprykerShop\Yves\Router\Route\RouteCollection
     */
    protected function addQuoteApprovalDeclineRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/quote-approval/decline/{idQuoteApproval}', 'QuoteApprovalWidget', 'QuoteApproval', 'declineAction');
        $route = $route->assert('idQuoteApproval', static::PATTERN_ID);
        $routeCollection->add(static::ROUTE_QUOTE_APPROVAL_DECLINE, $route);

        return $routeCollection;
    }

    /**
     * @uses \SprykerShop\Yves\QuoteApprovalWidget\Controller\QuoteApprovalController::createQuoteApprovalAction()
     *
     * @param \SprykerShop\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \SprykerShop\Yves\Router\Route\RouteCollection
     */
    protected function addCreateQuoteApprovalRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/quote-approval/create', 'QuoteApprovalWidget', 'QuoteApproval', 'createQuoteApprovalAction');
        $routeCollection->add(static::ROUTE_QUOTE_APPROVAL_CREATE, $route);

        return $routeCollection;
    }

    /**
     * @uses \SprykerShop\Yves\QuoteApprovalWidget\Controller\QuoteApprovalController::removeQuoteApprovalAction()
     *
     * @param \SprykerShop\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \SprykerShop\Yves\Router\Route\RouteCollection
     */
    protected function addRemoveQuoteApprovalRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/quote-approval/{idQuoteApproval}/remove', 'QuoteApprovalWidget', 'QuoteApproval', 'removeQuoteApprovalAction');
        $route = $route->assert('idQuoteApproval', static::PATTERN_ID);
        $routeCollection->add(static::ROUTE_QUOTE_APPROVAL_REMOVE, $route);

        return $routeCollection;
    }
}
