<?php

namespace App\Listeners;

use App\Events\EmailNotification;
use App\Mail\BajaPersonal;
use App\Mail\Bienvenida;
use App\Mail\ConfirBaja;
use App\Mail\ConfirCambios;
use App\Mail\NotiAreaLaburo;
use App\Mail\NotiAsignarAreaLaburo;
use App\Mail\NotiInventario;
use App\Mail\NotiMensual;
use App\Mail\NotiPermisos;
use App\Mail\SolicitudBaja;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{

    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailNotification $event): void
    {
        switch ($event->emailType) {
            case 'bajaPersonal':
                Mail::to($event->data['email'])->send(new BajaPersonal($event->data));
                break;

            case 'bienvenida':
                Mail::to($event->data['email'])->send(new Bienvenida($event->data));
                break;

            case 'confirBaja':
                Mail::to($event->data['email'])->send(new ConfirBaja($event->data));
                break;

            case 'confirCambios':
                Mail::to($event->data['email'])->send(new ConfirCambios($event->data));
                break;

            case 'notiAreaLaburo':
                Mail::to($event->data['email'])->send(new NotiAreaLaburo($event->data));
                break;

            case 'notiAsignarAreaLaburo':
                Mail::to($event->data['email'])->send(new NotiAsignarAreaLaburo($event->data));
                break;

            case 'notiInventario':
                Mail::to($event->data['email'])->send(new NotiInventario($event->data));
                break;

            case 'notiMensual':
                Mail::to($event->data['email'])->send(new NotiMensual($event->data));
                break;

            case 'notiPermisos':
                Mail::to($event->data['email'])->send(new NotiPermisos($event->data));
                break;

            default:
                Mail::to($event->data['email'])->send(new SolicitudBaja($event->data));
                break;
        }
    }
}
