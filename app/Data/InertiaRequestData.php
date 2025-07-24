<?php

namespace App\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\AlwaysProp;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\RecordTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;
use Tighten\Ziggy\Ziggy;

#[TypeScript]
class InertiaRequestData extends Data
{
    public function __construct(
        #[RecordTypeScriptType('string', 'string|string[]')]
        public AlwaysProp $errors,

        public ?UserData $user,

        #[TypeScriptType('string[]')]
        public \Closure $can,

        #[RecordTypeScriptType('string', 'string|string[]')]
        public \Closure $ziggy,

        public bool $sidebarOpen,
    ) {}

    public static function fromMiddleware(Request $request, AlwaysProp $errors): self
    {
        return new self(
            errors: $errors,
            user: Auth::check() ? UserData::from($request->user()) : null,
            can: fn () => [
                // TODO: Add your permissions here
            ],
            ziggy: fn (): array => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            sidebarOpen: ! $request->hasCookie('sidebar_state')
                || $request->cookie('sidebar_state') === 'true',
        );
    }
}
