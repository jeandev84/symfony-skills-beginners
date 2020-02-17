<?php
namespace App\Services;


/**
 * Class Paginator
 * @package App\Services
*/
class Paginator
{

    /**
     * @param $data
     * @param $offset
     * @param $length [ The length is the limit ]
     * @return array
     */
     public function getPartial($data, $offset, $length)
     {
          return array_slice($data, $offset, $length);
     }
}