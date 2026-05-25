<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\DestroyUserRequest;
use App\Http\Requests\Admin\Users\UserIndexRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAccountRegistrationMail;

class AdminUserController extends Controller
{
    public function __construct()
    {
        // ログイン済みかつ is_admin===true でなければ 403 にする
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (! $request->user()->is_admin) {
                abort(403);
            }
            return $next($request);
        });
    }


    public function index(UserIndexRequest $request)
    {
        // 検索ワード（q）が渡されていればフィルタ、それ以外は全件取得
        $q = $request->input('q');

        $users = User::when($q, function ($query) use ($q) {
                    return $query->where('employee_number', 'like', "%{$q}%");
        })
                ->orderBy('employee_number')
                ->get();

        return view('admin.users.index', compact('users', 'q'));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(StoreUserRequest $request)
    {
        // バリデート済みデータを取得
        $data = $request->validated();

        //ランダムパスワード生成
        $plainPassword = (string) random_int(1000, 9999);

        $user = User::create([
            'employee_number' => $data['employee_number'],
            'password'        => Hash::make($plainPassword),
            'name'            => $data['name'],
            'is_admin'        => $data['is_admin'],
        ]);


        return redirect()->route('admin.users.index')->with('status', 'アカウントを作成しました');
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->name      = $data['name'];
        $user->is_admin  = $data['is_admin'];


        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('status', 'アカウント情報を更新しました');
    }


    public function destroy(DestroyUserRequest $request, User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('status', 'アカウントを削除しました');
    }
}