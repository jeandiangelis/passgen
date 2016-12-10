<?php

use Generator\HumanReadableGenerator;

require __DIR__ . '/vendor/autoload.php';

echo (new HumanReadableGenerator(['1', '2', '3'], 1, 1))->generate();
