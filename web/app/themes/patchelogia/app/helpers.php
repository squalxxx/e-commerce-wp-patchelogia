<?php

/**
 * Theme helpers.
 */

namespace App;

foreach (glob(__DIR__ . '/Support/*.php') as $file) {
    require_once $file;
}
