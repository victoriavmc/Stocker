<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl bg-base-300 sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Perfil</th>
                                <th>Nombre Completo</th>
                                <th>Posición</th>
                                <th>Fecha de ingreso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            {{-- Aqui paso los datos del amount trabajadores --}}
                            @foreach ($trabajadores as $trabajador)
                                <tr>
                                    <th>{{ $trabajador->idJobPosition }}</th>
                                    <td>{{ $trabajador->person->users->profile_photo_path ?? 'No' }}</td>
                                    <td>{{ $trabajador->person->personaldata->firstName . ' ' . $trabajador->person->personaldata->lastName }}
                                    </td>
                                    <td>{{ $trabajador->position }}</td>
                                    <td>{{ $trabajador->startDate }}</td>
                                    <td>{{ $trabajador->status }}</td>
                                    <td>
                                        Ver todos los datos. Modicar datos personales. Modificar datos laborales.
                                        Eliminarlo.
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
