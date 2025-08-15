<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\FromAuthenticatedUser;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class TeamData extends Data
{
    public function __construct(
        public string $name,

        public ?string $description,

        public int $order_column,

        #[Rule('hex_color')]
        public ?string $color,

        #[FromAuthenticatedUser]
        public UserData $owner,
    ) {}
}
