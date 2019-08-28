<?php

namespace Fanintek\Fantasena\Http\Controllers\Admin;

use Fanintek\Fantasena\Http\Controllers\Controller;
use Fanintek\Fantasena\Models\User;
use Illuminate\Http\Request;

use DataTables;
use Kris\LaravelFormBuilder\FormBuilder;

class UserManageController extends Controller
{

    protected $model;

    public function __construct(User $model) 
    {
        $this->model = $model;
    }

    /**
     * Collect user list into DataTables JSON
     */
    public function userJson(Request $request)
    {
        return DataTables::of($this->model->all())
                ->addColumn('full_name', function($row) {
                    return "{$row->first_name} {$row->last_name}";
                })
                ->editColumn('is_active', function($row) {
                    return $row->is_active == true ? 'Active' : 'Non-Active';
                })
                ->editColumn('created_at', function($row) {
                    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d F Y H:i:s');
                })
                ->addColumn('action', function ($user) {
                    return buildAction($user->id);
                })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Display form to create the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserCreateForm::class, [
            'method' => 'POST',
            'url' => route('manage.user.create')
        ]);

        if ($request->isMethod('POST')) 
        {
            if (!$form->isValid())
                return redirect()->back()->withErrors($form->getErrors())->withInput();
                
            $data = $form->getFieldValues();

            $user = $this->model->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email'     => $data['email'],
                'password' => \Hash::make($data['password']),
                'is_active' => $data['is_active']
            ]);

            if ($user) {
                $user->assignRole($data['assign_role']);

                return redirect()->route('manage.user.index')->with('splash-type', 'success')->with('splash-message', 'New user created');
            }

            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
        }

        return view('admin.user.create', compact('form'));
    }

    /**
     * Display the detail of resource 
     * 
     * @return \Illuminate\Http\Response
     */
    public function view($id, FormBuilder $formBuilder)
    {
        if ($detailUser = $this->model->find($id)) 
        {
            $form = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserViewForm::class, [
                'model' => $detailUser
            ]);

            return view('admin.user.view', compact('form', 'detailUser'));
        } else {
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'User was not found!');
        }
    }

    /**
     * Display edit form
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request, FormBuilder $formBuilder) 
    {
        if ($detailUser = $this->model->find($id)) 
        {
            $formInformation = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserEditForm::class, [
                'method' => 'POST',
                'url' => route('manage.user.edit', $id),
                'model' => $detailUser
            ]);

            $formChangePassword = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserChangePassword::class, [
                'method' => 'POST',
                'url' => route('manage.user.changePassword', $id)
            ]);

            if ($request->isMethod('POST')) 
            {
                if (!$formInformation->isValid())
                    return redirect()->back()->withErrors($formInformation->getErrors())->withInput();

                $field = $formInformation->getFieldValues();
                $role = $field['assign_role'];
                unset($field['assign_role']);

                foreach ($field as $key => $value) {
                    $detailUser->{$key} = $value;
                }

                $detailUser->syncRoles($role);

                if ($detailUser->save()) 
                    return redirect()->route('manage.user.index')->with('splash-type', 'success')->with('splash-message', 'User was changed successfully');

                return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
            }

            return view('admin.user.edit', compact('detailUser', 'formInformation', 'formChangePassword'));
        } else {
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'User was not found!');
        }
    }

    public function changePassword($id, FormBuilder $formBuilder) 
    {
        if ($detailUser = $this->model->find($id)) 
        {
            $formChangePassword = $formBuilder->create(\Fanintek\Fantasena\Forms\Admin\UserChangePassword::class, [
                'method' => 'POST',
                'url' => route('manage.user.changePassword', $id)
            ]);
    
            if (!$formChangePassword->isValid())
                return redirect()->back()->withErrors($formChangePassword->getErrors())->withInput();

            $field = $formChangePassword->getFieldValues();
            $detailUser->password = \Hash::make($field['password']);
            
            if ($detailUser->save()) 
                    return redirect()->back()->with('splash-type', 'success')->with('splash-message', 'Password was changed successfully');

            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'There\'s something wrong when saving changes');
        } else {
            return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'User was not found!');
        }
    }

    /**
     * Ajax delete user
     * 
     * @return Array
     */
    public function delete(Request $request) 
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:users,id'
        ]); 

        $res = $this->model->find($request->id)->delete();

        if ($res) return redirect()->back()->with('splash-type', 'success')->with('splash-message', 'User successfully deleted!');

        return redirect()->back()->with('splash-type', 'danger')->with('splash-message', 'Failed to delete the user');
    }

}
