<?php

use Generator\HumanReadableGenerator;

require __DIR__ . '/vendor/autoload.php';

echo (new HumanReadableGenerator(['lamma', 'ace', 'dig', 'eleven', 'book'], 1, 1))->generate();
