<?php

namespace Fanintek\Fantasena\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fanintek\Fantasena\Http\Controllers\Controller;

use Fanintek\Fantasena\Models\FanMenu;

use DataTables;
use Kris\LaravelFormBuilder\FormBuilder;

class MenuManageController extends Controller
{
    protected $model;

    public function __construct(FanMenu $model)
    {
        $this->model = $model;
    }

    /**
     * Collect user list into DataTables JSON
     */
    public function menuJson(Request $request)
    {
        return DataTables::of($this->model->all())
                ->addColumn('parent_menu', function($row) {
                    return $row->parent_menu()->value('menu_label');
                })
                ->editColumn('created_at', function($row) {
                    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d F Y H:i:s');
                })
                ->addColumn('action', function ($role) {
                    return buildAction($role->id);
                })->make(true);
    }

    public function index(Request $request) 
    {
        return view('admin.menu.index');
    }

    /**
     * Display the detail of resource 
     * 
     * @return \Illuminate\Http\Response
     */
    public function view($id, FormBuilder $formBuilder)
    {
        if ($detailMenu = $this->model->find($id)) 
        {
            $form = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\MenuForm::class, [
                'model' => $detailMenu
            ]);

            $form->disableFields();
            $form->remove('submit');
            $form->remove('clear');

            return view('admin.menu.view', compact('form', 'detailMenu'));
        } else {
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'Menu was not found!');
        }
    }

    /**
     * Display form to create the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, FormBuilder $formBuilder)
    {
        $formMenu = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\MenuForm::class, [
            'method' => 'POST',
            'url' => route('manage.menu.create')
        ]);

        if ($request->isMethod('POST')) 
        {
            if (!$formMenu->isValid())
                return redirect()->back()->withErrors($formMenu->getErrors())->withInput();

            $data = $formMenu->getFieldValues();
            $data['granted_to'] = json_encode(['roles' => $data['granted_to'], 'users' => []]);
                
            $menu = $this->model->create($data);

            if ($menu) {
                return redirect()->route('manage.menu.index')->with('splash-type', 'success')->with('splash-message', 'New menu created');
            }

            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
        }

        return view('admin.menu.create', compact('formMenu'));
    }

    /**
     * Display edit form
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, FormBuilder $formBuilder) 
    {
        if ($detailMenu = $this->model->find($id)) 
        {
            $formMenu = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\MenuForm::class, [
                'method' => 'POST',
                'url' => route('manage.menu.edit', $id),
                'model' => $detailMenu
            ]);

            if ($request->isMethod('POST')) 
            {
                if (!$formMenu->isValid())
                    return redirect()->back()->withErrors($formMenu->getErrors())->withInput();

                $field = $formMenu->getFieldValues();
                $field['granted_to'] = json_encode(['roles' => $field['granted_to'], 'users' => []]);

                foreach ($field as $key => $value) {
                    $detailMenu->{$key} = $value;
                }

                if ($detailMenu->save()) 
                    return redirect()->route('manage.menu.index')->with('splash-type', 'success')->with('splash-message', 'Role was changed successfully');

                return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
            }

            return view('admin.menu.edit', compact('detailRole', 'formMenu'));
        } else {
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'Menu was not found!');
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
            'id' => 'required|integer|exists:menus,id'
        ]); 

        if (count($this->model->where(['parent_id' => $request->id])->get()) > 0)
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'You can\'t delete this menu if it has children.');

        $res = $this->model->find($request->id)->delete();
        if ($res) return redirect()->back()->with('splash-type', 'success')->with('splash-message', 'Menu successfully deleted!');

        return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'Failed to delete the menu');
    }
}
