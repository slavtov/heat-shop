<?php

function getSale(int $oldprice, int $price)
{
    $sale = $oldprice - $price;
    $res  = $sale / $oldprice * 100;

    return '-' . round($res) . '%';
}
