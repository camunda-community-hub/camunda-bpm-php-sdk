<?php
/**
 * Created by IntelliJ IDEA.
 * User: hentschel
 * Date: 07.06.13
 * Time: 20:42
 * To change this template use File | Settings | File Templates.
 */

namespace org\camunda\php\sdk\entity\request;


class Request
{

    public function iterate()
    {
        $tmp = [];
        foreach ($this as $index => $value) {
            $tmp[$index] = $value;
        }

        return $tmp;
    }
}