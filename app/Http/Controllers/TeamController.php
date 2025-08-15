<?php

namespace App\Http\Controllers;

use App\Data\TeamData;
use App\Models\Team;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(#[CurrentUser] User $user)
    {
        return Inertia::render('teams/index', [
            'teams' => TeamData::collect($user->teams),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamData $teamData)
    {
        Gate::authorize('create', Team::class);

        $team = Team::create($teamData);

        return to_route('teams.show', $team)->with('success', __('Team created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return Inertia::render('teams/show', [
            'team' => TeamData::from($team),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamData $teamData, Team $team)
    {
        Gate::authorize('update', $team);

        $team->update($teamData);

        return to_route('teams.show', $team)->with('success', __('Team updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        Gate::authorize('delete', $team);

        $team->delete();

        return to_route('teams.index')->with('success', __('Team deleted successfully.'));
    }
}
