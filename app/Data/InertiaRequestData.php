<?php

namespace App\Data;

use Illuminate\Http\Request;
use Inertia\AlwaysProp;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\RecordTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;
use Tighten\Ziggy\Ziggy;

class InertiaRequestData extends Data
{
    public function __construct(
        #[RecordTypeScriptType('string', 'string|string[]')]
        public AlwaysProp $errors,

        public ?UserData $user,

        public ?TeamData $team,

        #[TypeScriptType('string[]')]
        public \Closure $can,

        #[RecordTypeScriptType('string', 'string|string[]')]
        public \Closure $ziggy,

        public bool $sidebarOpen,
    ) {}

    public static function fromMiddleware(Request $request, AlwaysProp $errors): self
    {
        $user = $request->user();
        $currentTeam = $user?->getCurrentTeam();

        return new self(
            errors: $errors,
            user: $user ? UserData::from($user) : null,
            team: $currentTeam ? TeamData::from($currentTeam) : null,
            can: fn () => $user?->getPermissionsViaRoles() ?: [],
            ziggy: fn (): array => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            sidebarOpen: ! $request->hasCookie('sidebar_state')
                || $request->cookie('sidebar_state') === 'true',
        );
    }
}
