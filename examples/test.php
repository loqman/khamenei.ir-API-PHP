<?php
/**
 * Author: Loqman
 * Date: 27/11/13
 * Time: 8:31 PM
 * License: GPL
 */
require "../lib/khamenei_api.php";

$api = new KhameneiAPI();
$api->type(KhameneiAPI::TYPE_ARTICLE)
    ->limit(8)
    ->offset(6)
    ->order_by(KhameneiAPI::DATE_ASC)
    ->from_year(1387)
    ->to_year(1390)
    ->get();