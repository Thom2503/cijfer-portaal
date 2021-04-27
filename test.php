<?php
  function uuidv4()
  {
    $data = openssl_random_pseudo_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }

  echo uuidv4()."<br>";
  echo uuidv4()."<br>";
  echo uuidv4()."<br>";

  echo hash("sha512", "test1234")."<br>";
  echo hash("sha512", "test12345")."<br>";
  echo hash("sha512", "sudo1234")."<br>";

// 2bbe0c48b91a7d1b8a6753a8b9cbe1db16b84379f3f91fe115621284df7a48f1cd71e9beb90ea614c7bd924250aa9e446a866725e685a65df5d139a5cd180dc9
// 86743Michiel
 ?>
