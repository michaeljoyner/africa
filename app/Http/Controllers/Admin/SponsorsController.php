<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\Sponsor;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\AssocciatesForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorsController extends Controller
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
        $sponsors = Sponsor::latest()->get();
        return view('admin.sponsors.index')->with(compact('sponsors'));
    }

    public function show(Sponsor $sponsor)
    {
        return view('admin.sponsors.show')->with(compact('sponsor'));
    }

    public function store(AssocciatesForm $request)
    {
        $this->validate($request, ['name' => 'required|max:255']);

        $sponsor = Sponsor::create($request->acceptedFields());

        $this->flasher->success('Sponsor Created', 'The sponsor has been created. That is a good thing.');

        return redirect('admin/associates/' . $sponsor->id);
    }

    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit')->with(compact('sponsor'));
    }

    public function update(AssocciatesForm $request, Sponsor $sponsor)
    {
        $sponsor->update($request->acceptedFields());
        $sponsor->setAllSocialLinks($request->socialLinks());

        $this->flasher->success('Sponsor Updated', 'The sponsor has been successfully updated.');

        return redirect('admin/associates/' . $sponsor->id);
    }

    public function delete(Sponsor $sponsor)
    {
        $sponsor->delete();

        $this->flasher->success('Sponsor Deleted', 'The sponsor has been deleted.');

        return redirect('admin/associates');
    }
}
