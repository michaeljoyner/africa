<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\TeamMember;
use App\Http\Requests\SimplePublishRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamMemberPublishingController extends Controller
{
    public function update(SimplePublishRequest $request, TeamMember $member)
    {
        $new_state = $request->publish ? $member->publish() : $member->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
