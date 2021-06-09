<?php declare(strict_types=1);

namespace Academy\Checkout\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class FormValidationLayoutProcessor implements LayoutProcessorInterface
{
    public function process($jsLayout)
    {
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['firstname'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['firstname']['validation'] = [
                // 'email-validation => 1, does work. Probably done something wrong trying to add it to lib/validation/rules.js. See firstname mixins.
                'capitalized'   => 1,
                'min-length-3'  => 1
            ];
        }

        return $jsLayout;
    }
}
