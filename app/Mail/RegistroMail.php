<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
@session_start();

class RegistroMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        
         $email = $request['email'];
         $pin   = $_SESSION["pin"];
         //dd($pin);
         $mensaje = $_SESSION["mensaje"];
         return $this->from('yoe318@gmail.com')
                    ->view('email.emailregistro')->with([
                            'email' => $email,
                            'pin' => $pin,
                            'mensaje' => $mensaje,
                      ])->subject($mensaje);    
    }
}
