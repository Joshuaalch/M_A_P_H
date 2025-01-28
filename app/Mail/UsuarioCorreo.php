<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $subject;
    public $message;

    public function __construct($usuario, $subject, $message)
    {
        $this->usuario = $usuario;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function build()
    {
        return $this->view('emails.usuario')
            ->subject($this->subject)
            ->with([
                'messageContent' => $this->message,
                'usuario' => $this->usuario,
            ]);
    }
}
