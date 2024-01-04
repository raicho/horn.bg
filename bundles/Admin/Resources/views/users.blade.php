@extends('admin::layouts.master')

@section('pageTitle')
    {{  trans('admin::pages.users.title')  }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="w-100 mb-3 p-3 bg-dark bg-gradient">
                <div class="text-end">
                    <form class="input-group" action="{{ route('admin_users') }}" method="POST">
                        @csrf
                        <input type="text" name="search" class="form-control border-0 border-0 shadow-none" placeholder="{{ trans('admin::messages.Searching') }}...">
                        @if(request()->isMethod('POST') && strlen(request()->search) > 0)
                            <a href="{{ route('admin_users') }}" class="btn btn-danger border-0 text-white btn-outline-dark">X</a>
                        @endif
                        <button class="btn btn-primary border-0 text-white btn-outline-dark" type="submit"> {{ trans('admin::messages.Search') }}</button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">ID#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Is admin</th>
                        <th scope="col" class="text-center">Is verified</th>
                        <th scope="col" class="text-center">Created at</th>
                        <th scope="col" class="text-center">Updated at</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row" class="text-center">{{ $user->id }}</th>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->is_admin == 1 ? trans('admin::messages.Yes') : trans('admin::messages.No') }}</td>
                                <td class="text-center">{{ $user->is_verified == 1 ? trans('admin::messages.Yes') : trans('admin::messages.No') }}</td>
                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">{{ $user->updated_at }}</td>
                                <td class="text-center">
                                    <form id="delete-user-{{ $user->id }}" action="{{ route('admin_delete_user', $user->id) }}" method="POST">
                                        @csrf
                                    </form>
                                    @if($user->is_admin < 1)
                                        <button
                                            class="btn btn-danger btn-sm alert-action"
                                            data-form="delete-user-{{ $user->id }}"
                                        >
                                            <i class="bi-trash"></i>
                                            {{ trans('admin::messages.Delete') }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="col-12 mt-3">
                {{ $users->links('admin::components.pagination') }}
            </div>

        </div>
    </div>
@endsection



