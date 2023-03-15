<?php

namespace App\Utils;

class Iban
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
 /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     */
    public function  checkIban($value)
    { 
		/*Logica de la funcion*/
        //Si la bandera se mantiene en cero se devuelve un error en $fail caso contrario no devuelve nada
        $bandera_error=0;
	    /*Variable para concaternar los mensajes de error de todos los segmentos*/
        $mensaje_error='';
        /* primer paso es limpiar el valor ingresado de espacios en blanco*/
        $iban =$value;
        $iban = str_replace(' ', '', $iban);
        $iban = trim($iban);
        //echo $iban;
        /*se chequea que el string resultante sea del valor pedido antes de dividirlo*/
        if(strlen($iban)!=24) {
            $bandera_error=1;
            $mensaje_error='El Iban no cumple con su longitud de 24'; }
            //no continua con la validacion por no ser de la longitud necesaria
        else{
            //Se divide el string en sus partes para verificacion

            //2 letras del código ISO del país ES
            $str_pais= strtoupper(substr($iban,0,2));
            //Se revisa si el substring contiene todas letras
            if (ctype_alpha($str_pais))
            {
                if ($str_pais!=='ES'){
                    $bandera_error=+1;
                    }
            }        
            else{
                $bandera_error=+1;
            }

            if ($bandera_error>0){
                
                if ($mensaje_error===''){
                    $mensaje_error='El Iban no cumple con el código ISO del país ES'; }
                else{
                    $mensaje_error .= '. El Iban no cumple con el código ISO del país ES'; }
            }


            //2 números de control IBAN
            $str_controlIban=substr($iban,2,2);            

            if(!preg_match('/^[0123456789]+$/',$str_controlIban)) 
            {

                $bandera_error=+1;
                if ($mensaje_error===''){
                    $mensaje_error='El Iban no cumple con los números de control IBAN'; }
                else{
                    $mensaje_error .= '. El Iban no cumple con los números de control IBAN'; }
            }

            //4 números código del banco
            $str_banco=substr($iban,4,4);            

            if(!preg_match('/^[0123456789]+$/',$str_banco)) 
            {
                $bandera_error=+1;
                if ($mensaje_error===''){
                    $mensaje_error='El Iban no cumple con los números de código del banco'; }
                else{
                    $mensaje_error .= '. El Iban no cumple con los números de código del banco'; }
            }           

            //4 números código sucursal del banco
            $str_sucursal=substr($iban,4,4);            

            if(!preg_match('/^[0123456789]+$/',$str_sucursal)) 
            {
                $bandera_error=+1;
                if ($mensaje_error===''){
                    $mensaje_error='El Iban no cumple con los números de código de la sucursal del banco'; }
                else{
                    $mensaje_error .= '. El Iban no cumple con los números de código de la sucursal del banco'; }
            }           


            //2 números dígito de control
            $str_control=substr($iban,12,2);            
            if(!preg_match('/^[0123456789]+$/',$str_control)) 
            {
                $bandera_error=+1;
                if ($mensaje_error===''){
                    $mensaje_error='El Iban no cumple con los números del dígito de control'; }
                else{
                    $mensaje_error .= '. El Iban no cumple con los números del dígito de control'; }
            }           

            //10 números número de cuenta
            $str_cuenta=substr($iban,12,2);            
            if(!preg_match('/^[0123456789]+$/',$str_cuenta)) 
            {
                $bandera_error=+1;
                if ($mensaje_error===''){
                    $mensaje_error='El Iban no cumple con los números de la cuenta'; }
                else{
                    $mensaje_error .= '. El Iban no cumple con los números de la cuenta'; }
            }           
            
        }
        //echo $mensaje_error;
        //si existio algun error durante la validacion envia el mismo a traves del $fail
        if ($bandera_error>0) {return  $mensaje_error.= '.';}
    }
}