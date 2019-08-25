<?php

namespace Fanintek\Fantasena\Http\Controllers\Admin;

use Fanintek\Fantasena\Http\Controllers\Controller;
use Fanintek\Fantasena\Models\User;
use Illuminate\Http\Request;

use DataTables;

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
                    return $row->is_active == true ? 'Active' : 'Deactive';
                })
                ->editColumn('created_at', function($row) {
                    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d F Y H:i:s');
                })
                ->addColumn('action', function ($user) {
                    return '<a href="javascript:void(0);" data-toggle="modal" data-target="#editModal" data-userId="'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Fanintek\Fantasena\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fanintek\Fantasena\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fanintek\Fantasena\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fanintek\Fantasena\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
