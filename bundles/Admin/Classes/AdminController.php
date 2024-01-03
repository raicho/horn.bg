<?php

namespace Admin\Classes;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use User\Models\UserModel;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function dashboardAdmin(Request $request): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        //session()->flash('flash-message', ['type' => 'success', 'content' => 'welcome']);
        $data = [
            'users' => UserModel::all()
        ];
        return view('admin::dashboard', $data);
    }

    public function usersAdmin()
    {
        return view('admin::users');
    }


}
