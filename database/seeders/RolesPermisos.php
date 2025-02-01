<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear Roles
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $gerente = Role::firstOrCreate(['name' => 'Gerente']);
        $trabajador = Role::firstOrCreate(['name' => 'Trabajador']);
        $recluta = Role::firstOrCreate(['name' => 'Recluta']);

        // Permisos Generales
        $permisos = [
            // Job Positions
            'Crear - area de trabajo', 'Modificar - area de trabajo', 'Eliminar - area de trabajo', 'Ver - area de trabajo',

            // User Histories
            'Modificar - historial de trabajo', 'Ver - historial de trabajo',

            // Persons
            'Modificar - datos personales', 'Eliminar - datos personales', 'Ver - datos personales',

            // Products
            'Crear - producto', 'Modificar - producto', 'Eliminar - producto', 'Ver - producto',

            // Inventory
            'Crear - inventario', 'Modificar - inventario', 'Eliminar - inventario', 'Ver - inventario',

            // Price History
            'Crear - precios de venta', 'Modificar - precios de venta', 'Eliminar - precios de venta', 'Ver - precios de venta',

            // Archivist
            'Crear - archivero', 'Modificar - archivero', 'Eliminar - archivero', 'Ver - archivero',

            // Reports
            'Crear - reporte', 'Modificar - reporte', 'Eliminar - reporte', 'Ver - reporte',

            // Asignación de permisos
            'Asignar - permiso','Crear - permiso', 'Modificar - permiso', 'Eliminar - permiso', 'Ver - permiso',

            // Auditoria
            'Eliminar - auditoria', 'Ver - auditoria',
        ];

        // Crear los permisos en la base de datos
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Asignación de permisos por rol
        // 🚩 Administrador: acceso total
        $admin->givePermissionTo(Permission::all());

        // 🚩 Gerente: control casi total (sin permisos críticos de auditoría y administración de permisos)
        $gerente->givePermissionTo([
            // Área de Trabajo
            'Modificar - area de trabajo',
            'Ver - area de trabajo',

            // Historial de Trabajo
            'Ver - historial de trabajo',

            // Datos Personales
            'Modificar - datos personales', 'Ver - datos personales',

            // Productos
            'Ver - producto',

            // Inventario
           'Ver - inventario',

            // Precios de Venta
            'Crear - precios de venta', 'Modificar - precios de venta', 'Ver - precios de venta',

            // Archivero
            'Ver - archivero',

            // Reportes
            'Ver - reporte',

            // Permisos (solo visualización)
            'Ver - permiso',

            // Auditoría (solo visualización)
            'Ver - auditoria',
        ]);

        // 🚩 Trabajador: permisos limitados, enfocados en tareas operativas (ajustable individualmente)
        $trabajador->givePermissionTo([
            #1
                // RRHH
                'Crear - area de trabajo',
                'Modificar - area de trabajo',
                'Ver - area de trabajo',
                'Ver - historial de trabajo',
                'Modificar - datos personales',
                'Ver - datos personales',
                // Asignación de permisos
                'Asignar - permiso',
                'Crear - permiso',
                'Modificar - permiso',
                'Eliminar - permiso',
                'Ver - permiso',

                //(TODO LO ANTERIOR) y Solo Jefe RRHH
                'Eliminar - area de trabajo',
                'Modificar - historial de trabajo',
                'Eliminar - datos personales',
            #2
                // Operario y Jefe de Operarios
                'Crear - producto',
                'Modificar - producto',
                'Eliminar - producto',
                'Ver - producto',
                'Ver - inventario',
                'Crear - reporte',
                'Modificar - reporte',

                //(TODO LO ANTERIOR) y Solo el Jefe de Operarios
                'Crear - inventario',
                'Modificar - inventario',
                'Eliminar - inventario',
                'Eliminar - reporte',
                'Ver - reporte',
            #3
                // Finanzas u Operario
                'Crear - archivero',
                'Modificar - archivero',
                'Eliminar - archivero',
                'Ver - archivero',

                // Jefe de Finanzas
                'Crear - precios de venta',
                'Modificar - precios de venta',
                'Eliminar - precios de venta',
                'Ver - precios de venta',
                // 'Ver - archivero',
                // 'Ver - inventario',
                // 'Ver - reporte',
        ]);

        // 🚩 Recluta: permisos muy básicos, solo de lectura y creación limitada
        $recluta->givePermissionTo([
            // Persons
            'Modificar - datos personales',
            'Ver - datos personales',
        ]);
    }
}
