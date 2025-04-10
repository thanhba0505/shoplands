<?php

namespace App\Helpers;

class Redirect {
  public static function to($path) {
    header('Location: ' . BASE_URL . '/' . $path);
    exit();
  }
}
