<?php

namespace app\models;

interface Product
{
    public function getSku();
    public function getName();
    public function getPrice();
    public function getAttributes();
}