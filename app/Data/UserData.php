<?php

namespace App\Data;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $avatar,
        public ?string $email_verified_at,
        public CarbonImmutable $created_at,
        public ?CarbonImmutable $updated_at,
    ) {}
}
