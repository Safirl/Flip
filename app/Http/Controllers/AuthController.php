<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthController extends Controller
{
    //Return la view pour se connecter
    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('account')->with('success', 'Vous êtes déjà connecté');
        }
        return view('auth.login');
    }

    //Redirige vers la page se connecter
    public function register()
    {
        return view('auth.register');
    }

    public function createUser(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'friend_id' => $this->generateFriendCode()
        ]);
        Auth::login($user);

        $request->session()->regenerate();
        return redirect()->intended(route('polls'))->with('success', 'Bienvenue ' . $credentials['name'] . ' !');
    }

    private function generateFriendCode(): string
    {
        do {
            $friendId = strtoupper(bin2hex(random_bytes(3))); // Exemple : "A1B2C3"
        } while ($this->friendIdExists($friendId));

        return $friendId;
    }

    private function friendIdExists(string $friendId): bool
    {
        return \App\Models\User::where('friend_id', $friendId)->exists();
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('polls'))->with('success', 'Vous êtes connecté');
        }
        return to_route('auth.login')->withErrors([
            'email' => 'Email ou mot de passe incorrect!',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('auth.login')->with('success', 'Vous avez été déconnecté');
    }

    public function deleteUser(User $user): RedirectResponse {

        if (auth()->id() !== $user->id && !auth()->user()->isAdmin) {
            abort(403, 'Action non autorisée.');
        }

        Log::info('Utilisateur supprimé', [
            'user_deleted_id' => $user->id,
            'deleted_by_id' => auth()->id(),
            'timestamp' => now(),
        ]);

        $user->delete();

        return redirect()->route('polls')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
