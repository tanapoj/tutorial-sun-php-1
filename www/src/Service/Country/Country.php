<?php

namespace App\Service\Country;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


class Country
{

    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getByIso($iso)
    {
        return DB::table("country")->where("iso", "=", $iso)->first();
    }

    public function getAll()
    {
        return DB::table("country")->get();
    }
}