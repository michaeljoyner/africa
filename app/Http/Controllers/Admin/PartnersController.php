<?php

namespace App\Http\Controllers\Admin;

use App\Assocciates\Partner;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\AssocciatesForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnersController extends Controller
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
        $partners = Partner::latest()->get();

        return view('admin.partners.index')->with(compact('partners'));
    }

    public function show(Partner $partner)
    {
        return view('admin.partners.show')->with(compact('partner'));
    }

    public function store(AssocciatesForm $request)
    {
        $partner = Partner::create($request->acceptedFields());

        $this->flasher->success('Partner Created',
            'The partner has been created. May it be a long and fruitful relationship');

        return redirect('admin/partners/' . $partner->id);
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit')->with(compact('partner'));
    }

    public function update(AssocciatesForm $request, Partner $partner)
    {
        $partner->update($request->acceptedFields());
        $partner->setAllSocialLinks($request->socialLinks());

        $this->flasher->success('Partner Info Updated', 'The partner info has been updated.');

        return redirect('admin/partners/' . $partner->id);
    }

    public function delete(Partner $partner)
    {
        $partner->delete();

        $this->flasher->success('Partner Deleted', 'Everything that begins must end.');

        return redirect('admin/partners');
    }
}
