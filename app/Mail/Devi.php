<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DetailDevis;
use App\Models\User;
use App\Models\Societe;
use App\Models\Devis;
use Illuminate\Support\Facades\Auth;
 
 
class Devi extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Elements de contact
     * @var array
     */
    public $devis;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $devis)
    {
        $this->devis = $devis;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
 	$soci= User::all()->Where('email','=',Auth::user()->email)->first(); 
 	$soce= $soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$soce);
        $d = Devis::all()->where('log_in','=',Auth::user()->email)->SortByDesc('id')->first();
        $devs=DetailDevis::all()->where('num_dev',$d->numero);
        return  $this->subject("DEMANDE DE DEVIS")->view('email-devis',compact('devs','d','Societ'));
    }
}