<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\User;
use App\Models\Card;
use App\Models\PayLog;

class HomeController extends Controller
{
    public function index() {
        $users = DB::table('users')->get();
        return view('admin.dashboard')->with("users", $users);
    }

    public function toggleEnabled(Request $req)
    {
        $user = User::find($req->id);

        if($user->enabled == "1") {
            $user->enabled = "0";
        } else {
            $user->enabled = "1";
        }

        if($user->save()) {
            if($user->enabled == "1") {
                return "Disable";
            } else {
                return "Enable";
            }
        }

    }

    public function addCard(Request $req)
    {
        $card = Card::create([
            'card_number' => $req->card_number,
            'exp_year' => $req->exp_year,
            'exp_month' => $req->exp_month,
            'cvv' => $req->cvv,
            'card_holder' => $req->card_holder,
            'enabled' => '0'
        ]);

        return view('admin.card_created')->with("success", "success");
    }

    public function addUser(Request $req)
    {
        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => Hash::make($req->password),
        ]);

        event(new Registered($user));

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }

    public function userDetail(Request $req)
    {
        $id = $req->id;
        $logs = User::find($id)->payLogs;
        return view('admin.log_details')->with("data",
            [
                User::find($id)->name,
                $logs
            ]);
    }

    public function getCards(Request $req)
    {
        $cards = Card::all();
        return view('admin.cards')->with('cards', $cards);
    }

    public function cardToggleEnabled(Request $req)
    {
        $card = Card::find($req->id);

        if($card->enabled == "1") {
            $card->enabled = "0";
        } else {
            $card->enabled = "1";
        }

        if($card->save()) {
            if($card->enabled == "1") {
                return "Disable";
            } else {
                return "Enable";
            }
        }
    }

    public function getLogs(Request $req)
    {
        $logs = PayLog::all();
        return view('admin.report')->with('logs', $logs);
    }
}
