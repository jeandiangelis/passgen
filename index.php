<?php

use Generator\HumanReadableGenerator;

require __DIR__ . '/vendor/autoload.php';

echo (new HumanReadableGenerator(['dishes'], 1, 10))->generate();
