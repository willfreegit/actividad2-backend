<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Validator;
  
class AuthorizationController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $validator = $this->validateRegister($request);
        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $data = $request->all();
        $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    private function validateRegister($request){
        $rules = [];
        $messages = [];

        $rules['usr_name']='required|min:2|max:20';
        $messages['usr_name.required'] = 'Nombre requerido';
        $messages['usr_name.min'] = 'Nombre debe tener por lo menos 2 caracteres';
        $messages['usr_name.max'] = 'Nombre debe tener máximo 20 caracteres';

        $rules['usr_lastname']='required|min:2|max:40';
        $messages['usr_lastname.required'] = 'Apellido requerido';
        $messages['usr_lastname.min'] = 'Apellido debe tener por lo menos 2 caracteres';
        $messages['usr_lastname.max'] = 'Apellido debe tener máximo 40 caracteres';

        $rules['usr_DNI']='required|min:8|max:8';
        $messages['usr_DNI.required'] = 'DNI requerido';
        $messages['usr_DNI.min'] = 'DNI debe ser de tamaño fijo 8 caracteres';
        $messages['usr_DNI.max'] = 'DNI debe ser de tamaño fijo 8 caracteres';

        $rules['usr_email']='required|email|unique:users';
        $messages['usr_email.required'] = 'Email requerido';
        $messages['usr_email.email'] = 'Email con formato incorrecto';
        $messages['usr_email.unique'] = 'Esta dirección email ya ha sido registrada';

        $rules['usr_password']='required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@.]).*$/';
        $messages['usr_password.required'] = 'Constraseña requerida';
        $messages['usr_password.min'] = 'El tamaño mínimo de la contraseña 8 caracteres';
        $messages['usr_password.regex'] = 'La contraseña debe contener: letras mayusculas y minusculas, por lo menos un número y uno de los caracteres especiales !$#%@.';

        $rules['usr_password_confirm']='required_with:usr_password|same:usr_password';
        $messages['usr_password_confirm.required'] = 'Confirmar contraseña requerido';
        $messages['usr_password_confirm.same'] = 'Las contraseñas no coinciden';

        $rules['usr_phone']='min:9|max:12';
        $messages['usr_phone.min'] = 'Telefono debe tener por lo menos 9 caracteres';
        $messages['usr_phone.max'] = 'Telefono debe tener máximo 12 caracteres';

        $rules['usr_country']='min:2|max:100';
        $messages['usr_country.min'] = 'País debe tener mínimo 2 caracteres';
        $messages['usr_country.max'] = 'País debe tener máximo 100 caracteres';

        $rules['user_about']='min:20|max:250';
        $messages['user_about.min'] = 'La información debe tener mínimo 20 caracteres';
        $messages['user_about.max'] = 'La información debe tener máximo 250 caracteres';

        return Validator::make($request->all(), $rules, $messages);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'usr_name' => $data['usr_name'],
        'usr_lastname' => $data['usr_lastname'],
        'usr_DNI' => $data['usr_DNI'],
        'usr_email' => $data['usr_email'],
        'usr_phone' => $data['usr_phone'],
        'usr_country' => $data['usr_country'],
        'usr_IBAN' => $data['usr_IBAN'],
        'user_about' => $data['user_about'],
        'usr_password' => Hash::make($data['usr_password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}