<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 02/07/2017
 * Time: 19:35
 */

namespace CodeEduStore\Models;


class ProductStore
{
    private $id;
    private $name;
    private $price;
    private $originalProduct;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ProductStore
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ProductStore
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return ProductStore
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginalProduct()
    {
        return $this->originalProduct;
    }

    /**
     * @param mixed $originalProduct
     * @return ProductStore
     */
    public function setOriginalProduct($originalProduct)
    {
        $this->originalProduct = $originalProduct;
        return $this;
    }


}