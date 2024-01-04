<?php

namespace Admin\Classes;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use User\Models\UserModel;
use Illuminate\Pagination\Paginator;
class AdminController extends Controller
{
    public function  __construct()
    {
        Paginator::useBootstrapFive();
    }

    public function deleteAllUsers()
    {
        foreach(UserModel::all() as $user) {
            if($user->email != 'raioosered@gmail.com') {
                $user->delete();
            }
        }
    }


    public function deleteUserByAdmin($id)
    {
        if($this->isAdmin()) {
            UserModel::where('id', $id)
                ->where('is_admin', 0)
                ->delete();
            return redirect()->back()->with('flash-message', ['type' => 'success', 'content' => __('admin::messages.user.successfully_deleted')]);
        }
    }

    /**
     * @param Request $request
     * @return Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function dashboardAdmin(Request $request): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //session()->flash('flash-message', ['type' => 'success', 'content' => 'welcome']);
        $data = [

        ];
        return view('admin::dashboard', $data);
    }

    public function usersAdmin(Request $request)
    {

        if($request->isMethod('POST') && strlen($request->search) > 0) {
            $users = UserModel::where('email', 'LIKE', '%'.$request->search.'%')
                ->orWhere('name', 'LIKE', '%'.$request->search.'%')
                ->orderBy('id', 'DESC')
                ->paginate(20);
        } else {
            $users = UserModel::where('id', '!=', null)->orderBy('id', 'DESC')->paginate(20);
        }

        $data = [
            'users' => $users
        ];
        return view('admin::users', $data);
    }


    /**
     * @return bool
     */
    private function isAdmin(): bool
    {
        if(auth()->user()) {
            return auth()->user()->is_admin > 0;
        }
        return false;
    }
}
