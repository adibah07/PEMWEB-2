<?php

namespace App\Filament\Widgets;

use App\Models\Absensi;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class AbsensiDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Status Kehadiran';
    protected static ?int $sort = 2; // Urutan widget pada dashboard
    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = null; // Interval refresh data, set null untuk tidak auto-refresh

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(30); // Data 30 hari terakhir
        
        $hadir = Absensi::where('status', 'hadir')
            ->where('tanggal', '>=', $startDate)
            ->count();
            
        $izin = Absensi::where('status', 'izin')
            ->where('tanggal', '>=', $startDate)
            ->count();
            
        $sakit = Absensi::where('status', 'sakit')
            ->where('tanggal', '>=', $startDate)
            ->count();
            
        $alfa = Absensi::where('status', 'alfa')
            ->where('tanggal', '>=', $startDate)
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Status Kehadiran',
                    'data' => [$hadir, $izin, $sakit, $alfa],
                    'backgroundColor' => [
                        '#10B981', // Hijau untuk hadir
                        '#F59E0B', // Kuning untuk izin
                        '#3B82F6', // Biru untuk sakit
                        '#EF4444', // Merah untuk alfa
                    ],
                    'borderColor' => '#FFFFFF',
                    'borderWidth' => 2,
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => ['Hadir', 'Izin', 'Sakit', 'Alfa'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'font' => [
                            'size' => 12,
                        ],
                        'padding' => 16,
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                ],
            ],
            'cutout' => '70%',
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }
}
