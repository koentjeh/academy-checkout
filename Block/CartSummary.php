<?php declare(strict_types=1);

namespace Academy\Checkout\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class CartSummary
{
    /** @var Session */
    private Session $session;

    /** @var ProductRepositoryInterface */
    private ProductRepositoryInterface $productRepository;

    /**
     * CheckoutCartSummary constructor.
     * @param Session $session
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Session $session,
        ProductRepositoryInterface $productRepository
    ) {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    /**
     * @param string $sku
     * @return ProductInterface
     * @throws NoSuchEntityException
     */
    public function getProductBySku(string $sku): ProductInterface
    {
        // TODO:    Lijstje met SKU's als parameter en SearchCriteriaBuilder gebruiken
        //          i.p.v.voor elke SKU een aparte request.
        return $this->productRepository->get($sku);
    }

    /**
     * @param int $cartItemId
     * @return ProductInterface
     * @throws NoSuchEntityException|LocalizedException
     */
    final public function getProductByCartItemId(int $cartItemId): ProductInterface
    {
        $cartItem = $this->session->getQuote()->getItemById($cartItemId);
        return $this->productRepository->get($cartItem->getSku());
    }
}
