<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use PhpParser\Node\Expr\Cast\String_;

class AdminWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Admin $admin;
    private string $password;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $admin , string $password)
    {
        //
        $this->admin = $admin;
        $this->admin = $password  ;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->cc('admin@laravel12.com','L12-Admin')
        ->markdown('mail.admin-welcome-email')->with(
        [
            'name'=> $this->admin->name,
            'password' => $this->admin->password,

        ]
        );
    }
}
