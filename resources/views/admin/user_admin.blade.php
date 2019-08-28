@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mx-auto">
            <div class="card">
                <div class="card-header">会員一覧</div>
                <div class="card-body">
                    <table class="table table-sm">
                         <thead>
                            <tr>
                                <th class="session__table__th" scope="col">id</th>
                                <th class="session__table__th" scope="col">登録名</th>
                                <th class="session__table__th" scope="col">E-mail</th>
                                <th class="session__table__th" scope="col">登録日</th>
                                <th class="session__table__th" scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)  
                            <tr>
                                <th class="session__table__th py-auto" scope="row">{{ $user->id }}</th>
                                <td class="session__table__td">{{ $user->name }}</td>
                                <td class="session__table__td">{{ $user->email }}</td>
                                <td class="session__table__td">{{ $user->created_at }}</td>
                                <td class="text-center">
                                    <form action='{{ route('admin_user.delete') }}' method="POST">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                            <input readonly type="hidden" name="userId" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm session__btn">削除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection