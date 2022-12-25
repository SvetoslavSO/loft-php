<?php

use Core\Application;
include '../src/config.php';

include '../vendor/autoload.php';

require '../src/eloquent.php';

$app = new Application();
$app->run();