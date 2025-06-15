<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conservation_status')->insert([
            [
                'name' => 'critical',
                'label' => 'Moi perigoso',
                'color' => '#B40F0F',
                'threshold' => 5,
                'actions' => 'Activar plan de recuperación urxente',
                'should_notify' => true,
            ],
            [
                'name' => 'dangerous',
                'label' => 'Perigoso',
                'color' => '#E0771A',
                'threshold' => 20,
                'actions' => 'Revisar impacto e iniciar medidas de control',
                'should_notify' => true,
            ],
            [
                'name' => 'light',
                'label' => 'Leve',
                'color' => '#EACA14',
                'threshold' => 50,
                'actions' => 'Monitorización periódica recomendada',
                'should_notify' => true,
            ],
            [
                'name' => 'watched',
                'label' => 'Vixiado',
                'color' => '#3D96D5',
                'threshold' => 100,
                'actions' => 'Control ocasional',
                'should_notify' => false,
            ],
            [
                'name' => 'normal',
                'label' => 'Normal',
                'color' => '#2F8022',
                'threshold' => 99999,
                'actions' => 'Sen medidas necesarias',
                'should_notify' => false,
            ],
        ]);
    }
}
