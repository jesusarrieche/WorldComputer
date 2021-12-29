<?php

namespace App\Traits;

use Spipu\Html2Pdf\Html2Pdf;
use System\Core\View;

/**
 * Trait General para funciones Helpers
 */
trait Utility
{
    /**
     * ENCRIPTADO
     */
    public function encriptar($cadena)
    {
        $salida = FALSE;
        $password = hash('sha256', CODIGO_PASSWORD); //Genera Valor Cifrado en base a un string
        $vectorInicializacion = substr(hash('sha256', CODIGO_VECTOR), 0, 16);
        $salida = openssl_encrypt($cadena, METODO, $password, 0, $vectorInicializacion);
        $salida = base64_encode($salida);
        return $salida;
    }

    public function desencriptar($cadena)
    {
        $password = hash('sha256', CODIGO_PASSWORD);
        $vectorInicializacion = substr(hash('sha256', CODIGO_VECTOR), 0, 16);
        $salida = openssl_decrypt(base64_decode($cadena), METODO, $password, 0, $vectorInicializacion);
        return $salida;
    }
    public function encriptarContrasena($password)
    {
        $salida = password_hash($password, PASSWORD_DEFAULT, ['cost' => 8]);
        return $salida;
    }
    public function verificarContrasena($password_verificar, $password)
    {
        $salida = password_verify($password_verificar, $password);
        return $salida;
    }

    /**
     * LIMPIAR DATOS
     */
    public function limpiaCadena($cadena)
    {
        $cadena = trim($cadena); //Elimina espacios al inicio y al final de la cadena
        $cadena = stripcslashes($cadena); //Elimina Barras Invertidas de la cadena
        $cadena = str_replace('<script>', '', $cadena);
        $cadena = str_replace('</script>', '', $cadena);
        $cadena = str_replace('<script src', '', $cadena);
        $cadena = str_replace('<script type', '', $cadena);
        $cadena = str_replace('SELECT * FROM', '', $cadena);
        $cadena = str_replace('DELETE FROM', '', $cadena);
        $cadena = str_replace('INSERT INTO', '', $cadena);
        $cadena = str_replace('--', '', $cadena);
        $cadena = str_replace('^', '', $cadena);
        $cadena = str_replace('(', '', $cadena);
        $cadena = str_replace(')', '', $cadena);
        $cadena = str_replace('[', '', $cadena);
        $cadena = str_replace(']', '', $cadena);
        $cadena = str_replace('{', '', $cadena);
        $cadena = str_replace('}', '', $cadena);
        $cadena = str_replace('==', '', $cadena);

        return $cadena;
    }

    public function codigoAleatorio($letra, $logitud, $numero)
    {
        $acum = NULL;
        for ($i = 0; $i < $logitud; $i++) {
            $num = rand(0, 9);
            $acum .= $num;
        }
        return $letra . $acum . $numero;
    }
    /**
     * DIRECTORIOS
     */
    public function crearCarpeta($nombreCarpeta, $direccion)
    {
    }

    /**
     * *********
     */
    /**
     * DOCUMENTOS
     */
    public function crearPDF($html)
    {

        $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        $html2pdf->output();
    }
    /*
        ESTEGANOGRAFÍA
    */
    public function cifrarEnImagen(){//Grabar mensaje en imagen
        $message_to_hide = "He\$ll&o";
        $src = "public/assets/img/code.png";
        $src_result = "public/assets/img/code_.png";

        $binary_message = $this->imgBinaria($message_to_hide);
        $message_length = strlen($binary_message);
        
        $im = imagecreatefrompng($src);//Obtener imagen a partir de fichero
        for($x = 0; $x < $message_length; $x++){
            $y = $x;
            $rgb = imagecolorat($im, $x, $y);//Obtener índice del color de un pixel
            $r = ($rgb >> 16) & 0xFF;//Obtener colores RGB
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $newR = $r;
            $newG = $g;
            $newB = $this->imgBinaria($b);
            $newB[strlen($newB) - 1] = $binary_message[$x];//A la última posición del valor del color azul se agrega parte del mensaje
            $newB = $this->imgString($newB);

            $new_color = imagecolorallocate($im, $newR, $newG, $newB);//Asignar el nuevo color con el mensaje dentro
            imagesetpixel($im, $x, $y, $new_color);//Establecer el pixel en la imagen
        }
        imagepng($im, $src_result);//Crear la imagen
        imagedestroy($im);
        return true;
    }
    public function decifrarImagen(){//Extraer mensaje desde imagen
        $message = '';
        $src = "public/assets/img/code_.png";
        $im = imagecreatefrompng($src);//Obtener imagen a partir de un fichero
        for($x = 0; $x < 336; $x++){
            $y = $x;
            $rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $blue = $this->imgBinaria($b);
            $message .= $blue[strlen($blue) - 1];//Obtener parte del mensaje desde la última posición del valor del color azul
        }
        $message = $this->imgString($message);
        echo "<br>".$message."<br>";
        return $message;
    }

    private function imgBinaria($str){//De decimal pasa a binario
        $str = (string)$str;//Asignar el tipo de variable como string
        $l = strlen($str);
        $result = '';
        while($l--){
            //Pasar el código ASCII a decimal, luego a binario
            $result = str_pad(decbin(ord($str[$l])), 8, "0", STR_PAD_LEFT).$result;
        }
        return $result;
    }
    private function imgString($str){//De binario a string
        //Dividir cadena en trozos pequeños y convertir en array
        $text_array = explode("\r\n", chunk_split($str, 8));
        $newstring = '';
        $response = '';
        $isUTF8 = true;
        for($n= 0; $n < count($text_array) - 1; $n++){
            //Convertir un número y devolver el caracter específico
            $newstring .= chr(base_convert($text_array[$n], 2, 10));
        }
        for ($i=0; $i < strlen($newstring); $i++) { //Extraer de la cadena solo caracteres UTF8
           $isUTF8 = preg_match('/^[\w\$\&]+$/', $newstring[$i]);
           if(!$isUTF8){
               break;
           }
           $response .= $newstring[$i];
        }
        return $response;
    }
}
