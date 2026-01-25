<?php

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (!file_exists($link)) {
    symlink($target, $link);
}