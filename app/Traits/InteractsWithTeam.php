<?php

namespace App\Traits;

use App\Models\Team;
use Illuminate\Support\Collection;
use Spatie\Permission\Contracts\Role;

/**
 * Trait for interacting with team-related functionality.
 */
trait InteractsWithTeam
{
    static string $TEAM_ID_FIELD_NAME = 'current_team_id';
    static int $TEAM_ID_COOKIE_EXPIRATION = 60 * 24 * 90; // 90 days = 3 months

    protected ?Team $currentTeam = null;

    public function getCurrentTeam(): Team
    {
        // return the current team if it exists
        if (! is_null($this->currentTeam)) {
            return $this->currentTeam;
        }

        $teamId = session(self::$TEAM_ID_FIELD_NAME) ?? request()->cookie(self::$TEAM_ID_FIELD_NAME);

        // Check if the team ID is numeric and find the team
        if (is_numeric($teamId)) {
            $this->currentTeam = $this->teams()->find($teamId);
        }

        // If the team is still not found, get the first owned team
        if (is_null($this->currentTeam)) {
            $this->currentTeam = $this->ownedTeams()->orderBy('order_column')->first();
        }

        // If the team is still not found, get the first team
        if (is_null($this->currentTeam)) {
            $this->currentTeam = $this->teams()->orderBy('order_column')->first();
        }

        // If the team is still not found, create a new one
        if (is_null($this->currentTeam)) {
            $this->currentTeam = $this->ownedTeams()->create(['name' => __('Default Team')]);
        }

        $this->setCurrentTeam($this->currentTeam);

        return $this->currentTeam;
    }

    /**
     * Sets the current team in the session, cookie and context.
     */
    public function setCurrentTeam(Team $team): void
    {
        session([self::$TEAM_ID_FIELD_NAME => $team->id]);
        cookie()->queue(
            cookie(
                self::$TEAM_ID_FIELD_NAME,
                $team->id,
                self::$TEAM_ID_COOKIE_EXPIRATION
            )
        );

        $this->currentTeam = $team;

        setPermissionsTeamId($team->id);
    }

    /**
     * Add a member to the team with specified roles.
     */
    public function joinTeam(Team $team, string|int|array|Role|Collection|\BackedEnum ...$roles): void
    {
        $prevPermissionsTeamId = getPermissionsTeamId();

        try {
            setPermissionsTeamId($team->getKey());
            $this->assignRole($roles);
        } finally {
            setPermissionsTeamId($prevPermissionsTeamId);
        }
    }
}
