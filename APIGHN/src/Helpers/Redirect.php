<?php

namespace App\Helpers;

class Redirect {
  public static function to($url) {
    header('Location: ' . $url);
    exit();
  }
}
