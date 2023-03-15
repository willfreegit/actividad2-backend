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
        $validator = $this->validateLogin($request);
        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return back()->with('message', 'Credenciales correctas!!!');
        }
        return back()->with('message', 'Credenciales incorrectas!!!');

    }

    public function postLoginApi(Request $request)
    {
        $validator = $this->validateLogin($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json('Credenciales correctas', 200);
        }
        return response()->json('Credenciales incorrectas', 200);

    }
      
    private function validateLogin($request){
        $rules = [];
        $messages = [];

        $rules['email']='required|email';
        $messages['email.required'] = 'Email requerido';
        $messages['email.email'] = 'Email con formato incorrecto';

        $rules['password']='required';
        $messages['password.required'] = 'Contraseña requerida';

        return Validator::make($request->all(), $rules, $messages);
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

    public function postRegistrationApi(Request $request)
    {
        $validator = $this->validateRegister($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $data = $request->all();
        $this->create($data);
         
        return response()->json('Registro completo', 200);
    }

    private function validateRegister($request){
        $rules = [];
        $messages = [];

        $rules['name']='required|min:2|max:20';
        $messages['name.required'] = 'Nombre requerido';
        $messages['name.min'] = 'Nombre debe tener por lo menos 2 caracteres';
        $messages['name.max'] = 'Nombre debe tener máximo 20 caracteres';

        $rules['lastname']='required|min:2|max:40';
        $messages['lastname.required'] = 'Apellido requerido';
        $messages['lastname.min'] = 'Apellido debe tener por lo menos 2 caracteres';
        $messages['lastname.max'] = 'Apellido debe tener máximo 40 caracteres';

        $rules['DNI']='required|min:9|max:9';
        $messages['DNI.required'] = 'DNI requerido';
        $messages['DNI.min'] = 'DNI debe ser de tamaño 9 caracteres';
        $messages['DNI.max'] = 'DNI debe ser de tamaño 9 caracteres';
        
        $dni_ok = false;
        $dni = $request->input('DNI');
        try{
            $pattern = "/^[XYZ]?\d{5,8}[A-Z]$/";
            $dni_validate = strtoupper($dni);
            if(preg_match($pattern, $dni_validate)) {
              $number = substr($dni_validate, 0, -1);
              $number = str_replace('X', 0, $number);
              $number = str_replace('Y', 1, $number);
              $number = str_replace('Z', 2, $number);
              $dni_validate = substr($dni_validate, -1, 1);
              $start = $number % 23;
              $letter = 'TRWAGMYFPDXBNJZSQVHLCKET';
              $letter = substr('TRWAGMYFPDXBNJZSQVHLCKET', $start, 1);
              if($letter == $dni_validate) {
                $dni_ok = true;
              }
            }
        } catch (Exception $ex) {
            error_log($ex);
        }
        if (!$dni_ok) {
            error_log('-----------------ingreso a mostrar...');
            $rules['DNI_']='required';
            $messages['DNI_.required'] = 'DNI incorrecto, ingrese un número válido, ejemplo: 73547889F';
        }

        $rules['email']='required|email|unique:users';
        $messages['email.required'] = 'Email requerido';
        $messages['email.email'] = 'Email con formato incorrecto';
        $messages['email.unique'] = 'Esta dirección email ya ha sido registrada';

        $rules['password']='required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@.]).*$/';
        $messages['password.required'] = 'Contraseña requerida';
        $messages['password.min'] = 'El tamaño mínimo de la contraseña 8 caracteres';
        $messages['password.regex'] =
        'La contraseña debe tener letras mayusculas y minusculas, números y algún caracter especial: !$#%@.';

        $rules['password_confirm']='required_with:password|same:password';
        $messages['password_confirm.required'] = 'Confirmar contraseña requerido';
        $messages['password_confirm.same'] = 'Las contraseñas no coinciden';

        $rules['phone']='min:9|max:12';
        $messages['phone.min'] = 'Telefono debe tener por lo menos 9 caracteres';
        $messages['phone.max'] = 'Telefono debe tener máximo 12 caracteres';

        $rules['country']='min:2|max:100';
        $messages['country.min'] = 'País debe tener mínimo 2 caracteres';
        $messages['country.max'] = 'País debe tener máximo 100 caracteres';

        $rules['IBAN']='required';
        $messages['IBAN.required'] = 'IBAN es requerido';

        $rules['about']='min:20|max:250';
        $messages['about.min'] = 'La información debe tener mínimo 20 caracteres';
        $messages['about.max'] = 'La información debe tener máximo 250 caracteres';

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
        'name' => $data['name'],
        'lastname' => $data['lastname'],
        'DNI' => $data['DNI'],
        'email' => $data['email'],
        'phone' => isset($data['phone']) ? $data['phone'] : null,
        'country' => isset($data['country']) ? $data['country'] : null,
        'IBAN' => $data['IBAN'],
        'about' => isset($data['about']) ? $data['about'] : null,
        'password' => Hash::make($data['password'])
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