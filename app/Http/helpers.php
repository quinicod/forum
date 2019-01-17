<?php
function uploadFile($key, $path) {
request()->file($key)->store($path);
// Devolveremos el Hash del Name que es lo que se guarda
return request()->file($key)->hashName();
}