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
        $messages['usr_name.required'] = 'El campo nombre es obligatorio';
        $messages['usr_name.min'] = 'El campo nombre debe tener por lo menos dos caracteres';

        $rules['usr_lastname']='required|min:2|max:40';
        $messages['usr_lastname.required'] = 'El campo apellido es obligatorio';

        $rules['usr_DNI']='required|min:8|max:8';
        $messages['usr_DNI.required'] = 'El campo DNI es obligatorio';

        $rules['usr_email']='required|email|unique:users';
        $messages['usr_email.required'] = 'Campo email incorrecto';

        $rules['usr_password']='required|confirmed|min:6';
        $messages['usr_password.required'] = 'El campo password es obligatorio';

        $rules['usr_password_confirm']='required_with:password|same:password|min:6';
        $messages['usr_password_confirm.required'] = 'El campo confirmar password es obligatorio';

        $rules['usr_phone']='min:9|max:12';
        $messages['usr_phone.required'] = 'El campo telefono debe tener mínimo 8 y máximo 12 caracteres';

        $rules['user_about']='min:20|max:250';
        $messages['user_about.required'] = 'El campo telefono debe tener mínimo 20 y máximo 250 caracteres';

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