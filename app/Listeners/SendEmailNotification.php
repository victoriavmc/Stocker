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
                Mail::to($event->data['user']->email)->send(new BajaPersonal($event->data['personaldata']));
                break;

            case 'bienvenida':
                Mail::to($event->data['user']->email)->send(new Bienvenida($event->data['personaldata']));
                break;

            case 'confirBaja':
                Mail::to($event->data['user']->email)->send(new ConfirBaja($event->data['personaldata']));
                break;

            case 'confirCambios':
                Mail::to($event->data['user']->email)->send(new ConfirCambios($event->data['personaldata']));
                break;

            case 'notiAreaLaburo':
                Mail::to($event->data['user']->email)->send(new NotiAreaLaburo($event->data['personaldata']));
                break;

            case 'notiAsignarAreaLaburo':
                Mail::to($event->data['user']->email)->send(new NotiAsignarAreaLaburo($event->data['personaldata']));
                break;

            case 'notiInventario':
                Mail::to($event->data['user']->email)->send(new NotiInventario($event->data['personaldata']));
                break;

            case 'notiMensual':
                Mail::to($event->data['user']->email)->send(new NotiMensual($event->data['personaldata']));
                break;

            case 'notiPermisos':
                Mail::to($event->data['user']->email)->send(new NotiPermisos($event->data['personaldata']));
                break;

            default:
                Mail::to($event->data['user']->email)->send(new SolicitudBaja($event->data['personaldata']));
                break;
        }
    }
}
