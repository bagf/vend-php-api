<?php

namespace ShoppinPal\Vend\Api\V2\Parameters;


class SearchProducts extends SearchAbstract
{
    public static function get()
    {
        return new SearchProducts();
    }

    public function withVariantParentId($variantParentId)
    {
        return $this->include('variant_parent_id', $variantParentId);
    }

    public function withProductTypeId($productTypeId)
    {
        return $this->include('product_type_id', $productTypeId);
    }

    public function withTagId($tagId)
    {
        return $this->include('tag_id', $tagId);
    }

    public function withBrandId($brandId)
    {
        return $this->include('brand_id', $brandId);
    }

    public function withSupplierId($supplierId)
    {
        return $this->include('supplier_id', $supplierId);
    }

    public function withSku($sku)
    {
        return $this->include('sku', $sku);
    }

    public function withoutVariantParentId($variantParentId)
    {
        return $this->exclude('variant_parent_id', $variantParentId);
    }

    public function withoutProductTypeId($productTypeId)
    {
        return $this->exclude('product_type_id', $productTypeId);
    }

    public function withoutTagId($tagId)
    {
        return $this->exclude('tag_id', $tagId);
    }

    public function withoutBrandId($brandId)
    {
        return $this->exclude('brand_id', $brandId);
    }

    public function withoutSupplierId($supplierId)
    {
        return $this->exclude('supplier_id', $supplierId);
    }

    public function withoutSku($sku)
    {
        return $this->exclude('sku', $sku);
    }
}
