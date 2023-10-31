<?php

/**
 * @file
 * extract.php
 */

$data_file = fopen('data.json', 'r');
$output_file = fopen('output.csv', 'w');
$json = fread($data_file, filesize('data.json'));
$data = json_decode($json);
foreach ($data as $datum) {
  foreach ($datum as $item) {
    if (property_exists($item, 'ipv6Prefix')) {
      $split = explode('::', $item->ipv6Prefix);
      echo $item->ipv6Prefix;
      echo "\r\n";
      fputcsv($output_file, [$item->ipv6Prefix]);
    }
    else {
      $split = explode('/', $item->ipv4Prefix);
      echo $split[0];
      echo "\r\n";
      fputcsv($output_file, [$split[0]]);
    }
  }
}
fclose($data_file);
fclose($output_file);
