<?php

namespace App\Http\Controllers\Admin;

use App\Expeditions\Expedition;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\ExpeditionForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpeditionsController extends Controller
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
        $expeditions = Expedition::latest()->get();

        return view('admin.expeditions.index')->with(compact('expeditions'));
    }

    public function show(Expedition $expedition)
    {
        return view('admin.expeditions.show')->with(compact('expedition'));
    }

    public function store(ExpeditionForm $request)
    {
        $expedition = Expedition::create($request->only(['name', 'description']));

        $this->flasher->success('Expedition Created!', 'The expedition has been created. Best of luck!');

        return redirect('admin/expeditions/' . $expedition->id);
    }

    public function edit(Expedition $expedition)
    {
        return view('admin.expeditions.edit')->with(compact('expedition'));
    }

    public function update(ExpeditionForm $request, Expedition $expedition)
    {
        $expedition->update($request->acceptedFields());

        $this->flasher->success('Expedition Updated!', 'The expedition has been successfully updated.');

        return redirect('admin/expeditions/' . $expedition->id);
    }

    public function delete(Expedition $expedition)
    {
        $expedition->delete();

        $this->flasher->success('Expedition Deleted!', 'The expedition has been deleted.');

        return redirect('admin/expeditions');
    }
}
