<?php declare(strict_types=1);

namespace Academy\Checkout\Plugin\Cart;

use Academy\Checkout\Block\CartSummary;
use Magento\Checkout\Model\DefaultConfigProvider;

class CartSummaryPlugin
{
    private CartSummary $cartSummary;

    public function __construct(
        CartSummary $cartSummary
    ) {
        $this->cartSummary = $cartSummary;
    }

    public function afterGetConfig(DefaultConfigProvider $defaultConfigProvider, array $config): array
    {
        $items = $this->getCartItems($config);

        foreach ($items as &$item) {
            try {
                $product = $this->cartSummary->getProductByCartItemId((int)$item['item_id']);
                $item['sku'] = $product->getSku();
                $item['description'] = $product->getDescription();
            } catch (\Exception $exception) {
                // voor nu ff niets
            }
        }

        $config['totalsData']['items'] = $items;

        return $config;
    }

    private function getCartItems(array $config): array
    {
        if (isset($config['totalsData']['items']) && count($config['totalsData']['items']) > 0) {
            return $config['totalsData']['items'];
        }

        return [];
    }
}
