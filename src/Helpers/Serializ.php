<?php

namespace App\Helpers;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait Serializ{

    public function getSerializer(){

        $serializer = new Serializer( [new ObjectNormalizer()] , [new XmlEncoder(), new JsonEncoder()]);
        
        return  $serializer;
    }
    
}