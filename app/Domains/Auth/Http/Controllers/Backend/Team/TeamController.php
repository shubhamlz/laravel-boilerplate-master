<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Team;
use App\Domains\Auth\Http\Requests\Backend\Team\StoreTeamRequest;
use App\Domains\Auth\Http\Requests\Backend\Team\EditTeamRequest;
use App\Domains\Auth\Http\Requests\Backend\Team\UpdateTeamRequest;
use App\Domains\Auth\Models\Team;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;
use App\Domains\Auth\Services\UserService;
use App\Domains\Auth\Services\TeamService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

/**
 * Class TeamController.
 */
class TeamController
{
    /**
     * @var teamService
     */
    protected $teamService;
    protected $userService;

    /**
     * @var RoleService
     */
    protected $roleService;

    /**
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * UserController constructor.
     *
     * @param  TeamService $teamService
     * @param  UserService  $userService
     * @param  RoleService  $roleService
     * @param  PermissionService  $permissionService
     */
    public function __construct(UserService $userService,TeamService $teamService, RoleService $roleService, PermissionService $permissionService)
    {
        $this->teamService = $teamService;
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        
        return view('backend.auth.user.team.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.Team.create');
    }

    /**
     * @param  StoreUserRequest  $request
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreTeamRequest $request)
    {
        $team = $this->teamService->store($request->validated());
        // dd($team);
        return redirect()->route('admin.show', $team)->withFlashSuccess(__('The Team member was successfully created.'));
    }

    /**
     * @param  User  $user
     * @return mixed
     */
    public function show(Team $team)
    {
        $team =$team::all();
        return view('backend.auth.Team.show',compact('team'));
    }

    /**
     * @param  EditTeamRequest  $request
     * @param  User  $user
     * @return mixed
     */
    public function edit(EditTeamRequest $request, Team $team)
    {
        $id = $request->id;
        $detail =$team::find($id);
        // dd($detail);
        return view('backend.auth.Team.edit',compact('detail'));
    }

    /**
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return mixed
     *
     * @throws \Throwable
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $data=$request->request;
        $team=$this->teamService->update($team, $request->validated(),$data);
        $team =$team::all();
        // dd($team);
        return redirect()->route('admin.show', ['id',$data->get('id')])->withFlashSuccess(__('The Team member was successfully updated.'));
    }

    /**
     * @param  DeleteUserRequest  $request
     * @param  User  $user
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($id)
    {
        // dd($id);
        $team=Team::findorfail($id);
        $team->delete($team);

       return redirect()->route('admin.show')->withFlashSuccess(__('The user was successfully deleted.'));
    }
}
