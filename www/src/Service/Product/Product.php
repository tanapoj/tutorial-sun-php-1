<?php

namespace App\Service\Product;
/**
 * Created by PhpStorm.
 * User: nartra
 * Date: 28/9/19
 * Time: 12:24 PM
 */

use Illuminate\Database\Capsule\Manager as DB;

class Product
{
    public function __construct(DB $db)
    {
    }

    public function getAll(){
        return DB::table('product')->get()->map(function($item){
//            $item->create_at = date("c", strtotime($item->create_at));
//            $item->update_at = date("c", strtotime($item->update_at));
            $item->create_at = strtotime($item->create_at);
            $item->update_at = strtotime($item->update_at);
            return $item;
        });
    }
}