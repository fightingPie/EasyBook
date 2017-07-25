<?php
/**
 * Created by PhpStorm.
 * User: phuang
 * Date: 2017/7/21
 * Time: 11:28
 */

namespace App\Transformer;


abstract class Transformer
{
    public function transformCollection($items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}