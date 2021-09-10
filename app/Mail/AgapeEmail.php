<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgapeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(isset($this->data['type']) && $this->data['type'] == 'welcome'){ 
            return $this->markdown('emails.adminemail')
            ->subject($this->data['subject']);
        }
        if(isset($this->data['type']) && $this->data['type'] == 'loan request'){ 
            return $this->markdown('emails.loan')
            ->subject($this->data['subject']);
        }
        if(isset($this->data['type']) && $this->data['type'] == 'update loan request'){ 
            return $this->markdown('emails.loan')
            ->subject($this->data['subject']);
        }
        if(isset($this->data['type']) && $this->data['type'] == 'loan disbursement'){ 
            return $this->markdown('emails.loan')
            ->subject($this->data['subject']);
        }
        if(isset($this->data['type']) && $this->data['type'] == 'payment'){ 
            return $this->markdown('emails.payment')
            ->subject($this->data['subject']);
        }
        if(isset($this->data['type']) && $this->data['type'] == 'payment completed'){ 
            return $this->markdown('emails.payment')
            ->subject($this->data['subject']);
        }
        if(isset($this->data['type']) && $this->data['type'] == 'payment extended'){ 
            return $this->markdown('emails.payment')
            ->subject($this->data['subject']);
        }
    }
    
}
