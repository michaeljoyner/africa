<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\TeamMember;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\AssocciatesForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamMembersController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $members = TeamMember::latest()->get();
        return view('admin.members.index')->with(compact('members'));
    }

    public function show(TeamMember $member)
    {
        return view('admin.members.show')->with(compact('member'));
    }

    public function store(AssocciatesForm $request)
    {
        $member = TeamMember::create($request->acceptedFields());

        $this->flasher->success('Team Member Added', 'Long live the team!');

        return redirect('admin/members/' . $member->id);
    }

    public function edit(TeamMember $member)
    {
        return view('admin.members.edit')->with(compact('member'));
    }

    public function update(AssocciatesForm $request, TeamMember $member)
    {
        $member->update($request->acceptedFields());
        $member->setAllSocialLinks($request->socialLinks());

        $this->flasher->success('Team Member Updated', 'The info for this team mate has been updated successfully');

        return redirect('admin/members/' . $member->id);
    }

    public function delete(TeamMember $member)
    {
        $member->delete();

        $this->flasher->success('Team Member Deleted', 'The team member has been deleted');

        return redirect('admin/members');
    }
}
