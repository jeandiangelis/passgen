<?php

use Generator\HumanReadableGenerator;

require __DIR__ . '/vendor/autoload.php';

echo (new HumanReadableGenerator(['eleven', 'eleven', 'eleven', 'eleven', 'eleven'], 1, 3))->generate();
