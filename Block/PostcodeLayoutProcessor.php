<?php declare(strict_types=1);

namespace Academy\Checkout\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class PostcodeLayoutProcessor implements LayoutProcessorInterface
{

    public function process($jsLayout)
    {
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shipping-address-fieldset']['children']['postcode'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shipping-address-fieldset']['children']['postcode'] = $this->getPostcodeField();
        }

        return $jsLayout;
    }

    private function getPostcodeField(): array
    {
        return [
            'component' => 'Academy_Checkout/js/form/element/post-code',
            'config' => [
                'customScope'   => 'shippingPostcode',
                'template'      => 'ui/form/field',
                'elementTmpl'   => 'ui/form/element/input'
            ],
            'dataScope' => 'shippingPostcode',
            'provider' => 'checkoutProvider',
            'label' => __('Postcode'),
            'sortOrder' => '10',
            'validation' => [
                'required-entry' => true,
                'min_text_length' => 6
            ]
        ];
    }
}
