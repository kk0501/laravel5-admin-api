<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

require base_path('routes/v1.php');
