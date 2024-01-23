<?php

namespace App\Data;

use Spatie\LaravelData\Data;

/** @typescript */
class CauseData extends Data
{
    public function __construct(
        public readonly  ?string $id,
        public readonly  ?string $title,
        public readonly  ?string $description,
    ) {}
}
