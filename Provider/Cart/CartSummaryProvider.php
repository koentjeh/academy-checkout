<?php declare(strict_types=1);

namespace Academy\Checkout\Provider\Cart;

use Academy\Checkout\Block\CartSummary;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Checkout\Model\DefaultConfigProvider;

class CartSummaryProvider implements ConfigProviderInterface
{
    private DefaultConfigProvider $defaultConfigProvider;

    private CartSummary $cartSummary;

    public function __construct(
        DefaultConfigProvider $defaultConfigProvider,
        CartSummary $cartSummary
    ) {
        $this->defaultConfigProvider = $defaultConfigProvider;
        $this->cartSummary = $cartSummary;
    }

    public function getConfig(): array
    {
        try {
            $items = $this->getCartItems($this->defaultConfigProvider->getConfig());
        } catch (\Exception $exception) {
            die($exception->getMessage());
            return ['foo' => []];
        }

        foreach ($items as &$item) {
            try {
                $product = $this->cartSummary->getProductByCartItemId((int)$item['item_id']);
                $item['sku'] = $product->getSku();
                $item['description'] = $product->getDescription();

            } catch (\Exception $exception) {
                // voor nu ff niets
                die($exception->getMessage());
            }
        }

        return [
            'cartSummary' => $items
        ]; // window.checkoutConfig.cartSummary
    }

    private function getCartItems(array $config): array
    {
        if (isset($config['totalsData']['items']) && count($config['totalsData']['items']) > 0) {
            return $config['totalsData']['items'];
        }

        return [];
    }
}
