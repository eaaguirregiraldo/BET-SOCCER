<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Procesar y formatear la fecha primero
        $birthday = $this->formatBirthdayInput($request->birthday);
        
        // Reemplazar la fecha en el request para que pase la validación
        $request->merge(['birthday' => $birthday]);
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => [
                'required', 
                'date_format:d-m-Y',
                'before:today',
                function ($attribute, $value, $fail) {
                    try {
                        $birthday = Carbon::createFromFormat('d-m-Y', $value);
                        if ($birthday->age < 18) {
                            $fail('Debes ser mayor de 18 años para registrarte.');
                        }
                    } catch (\Exception $e) {
                        $fail('El formato de fecha no es válido. Usa DD-MM-YYYY.');
                    }
                },
            ],
            'phone_number' => [
                'required', 
                'string', 
                'min:10', 
                'max:15',
                'regex:/^[0-9]+$/' // Solo permite números
            ],
        ]);

        try {
            // Convertir la fecha de nacimiento al formato que espera MySQL (YYYY-MM-DD)
            $birthday = Carbon::createFromFormat('d-m-Y', $request->birthday)->format('Y-m-d');
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birthday' => $birthday,
                'phone_number' => $request->phone_number,
                'role' => 'Bet_User',
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Error al registrar usuario: ' . $e->getMessage()]);
        }
    }

    /**
     * Format the birthday input to ensure it's in the correct format.
     *
     * @param string $birthday
     * @return string
     */
    private function formatBirthdayInput($birthday)
    {
        // Eliminar cualquier caracter que no sea número
        $cleanBirthday = preg_replace('/[^0-9]/', '', $birthday);
        
        // Verificar si el formato es DDMMYYYY (8 dígitos)
        if (strlen($cleanBirthday) === 8) {
            // Extraer día, mes y año
            $day = substr($cleanBirthday, 0, 2);
            $month = substr($cleanBirthday, 2, 2);
            $year = substr($cleanBirthday, 4, 4);
            
            // Formatear como DD-MM-YYYY
            return "{$day}-{$month}-{$year}";
        }
        
        // Si ya tiene guiones o el formato es diferente, devolver como está
        return $birthday;
    }
}