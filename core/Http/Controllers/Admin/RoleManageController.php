<?php

namespace Fanintek\Fantasena\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fanintek\Fantasena\Http\Controllers\Controller;


use DataTables;
use Spatie\Permission\Models\Role;
use Kris\LaravelFormBuilder\FormBuilder;

class RoleManageController extends Controller
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Collect user list into DataTables JSON
     */
    public function roleJson(Request $request)
    {
        return DataTables::of($this->model->all())
                ->editColumn('created_at', function($row) {
                    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d F Y H:i:s');
                })
                ->addColumn('action', function ($role) {
                    return buildAction($role->id);
                })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.role.index');
    }

    /**
     * Display the detail of resource 
     * 
     * @return \Illuminate\Http\Response
     */
    public function view($id, FormBuilder $formBuilder)
    {
        if ($detailRole = $this->model->find($id)) 
        {
            $form = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\RoleViewForm::class, [
                'model' => $detailRole
            ]);

            return view('admin.role.view', compact('form', 'detailRole'));
        } else {
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'Role was not found!');
        }
    }

    /**
     * Display form to create the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, FormBuilder $formBuilder)
    {
        $formRole = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\RoleForm::class, [
            'method' => 'POST',
            'url' => route('manage.role.create')
        ]);

        if ($request->isMethod('POST')) 
        {
            if (!$formRole->isValid())
                return redirect()->back()->withErrors($formRole->getErrors())->withInput();
                
            $role = $this->model->create($formRole->getFieldValues());

            if ($role) {

                return redirect()->route('manage.role.index')->with('splash-type', 'success')->with('splash-message', 'New role created');
            }

            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
        }

        return view('admin.role.create', compact('formRole'));
    }

    /**
     * Display edit form
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, FormBuilder $formBuilder) 
    {
        if ($detailRole = $this->model->find($id)) 
        {
            $formRole = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\RoleForm::class, [
                'method' => 'POST',
                'url' => route('manage.role.edit', $id),
                'model' => $detailRole
            ]);

            if ($request->isMethod('POST')) 
            {
                if (!$formRole->isValid())
                    return redirect()->back()->withErrors($formRole->getErrors())->withInput();

                $field = $formRole->getFieldValues();

                foreach ($field as $key => $value) {
                    $detailRole->{$key} = $value;
                }

                if ($detailRole->save()) 
                    return redirect()->route('manage.role.index')->with('splash-type', 'success')->with('splash-message', 'Role was changed successfully');

                return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
            }

            return view('admin.role.edit', compact('detailRole', 'formRole'));
        } else {
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'User was not found!');
        }
    }

    /**
     * Ajax delete role
     * 
     * @return Array
     */
    public function delete(Request $request) 
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:roles,id'
        ]); 

        $res = $this->model->find($request->id)->delete();

        if ($res) return redirect()->back()->with('splash-type', 'success')->with('splash-message', 'Role successfully deleted!');

        return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'Failed to delete the role');
    }
}
