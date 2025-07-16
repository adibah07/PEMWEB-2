<?php

namespace App\Filament\Widgets;

use App\Models\Absensi;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class AbsensiTrendsChart extends ChartWidget
{
    protected static ?string $heading = 'Tren Kehadiran';
    protected static ?int $sort = 5;
    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = null; // Interval refresh data, set null untuk tidak auto-refresh

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(30); // Data 30 hari terakhir
        $dates = [];
        $hadirData = [];
        $izinData = [];
        $sakitData = [];
        $alfaData = [];
        
        // Generate dates for the last 30 days
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays(29 - $i)->format('Y-m-d');
            $dates[] = Carbon::now()->subDays(29 - $i)->format('d/m');
            
            $hadir = Absensi::whereDate('tanggal', $date)
                ->where('status', 'hadir')
                ->count();
                
            $izin = Absensi::whereDate('tanggal', $date)
                ->where('status', 'izin')
                ->count();
                
            $sakit = Absensi::whereDate('tanggal', $date)
                ->where('status', 'sakit')
                ->count();
                
            $alfa = Absensi::whereDate('tanggal', $date)
                ->where('status', 'alfa')
                ->count();
                
            $hadirData[] = $hadir;
            $izinData[] = $izin;
            $sakitData[] = $sakit;
            $alfaData[] = $alfa;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Hadir',
                    'data' => $hadirData,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                    'borderColor' => '#10B981',
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Izin',
                    'data' => $izinData,
                    'backgroundColor' => 'rgba(245, 158, 11, 0.2)',
                    'borderColor' => '#F59E0B',
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Sakit',
                    'data' => $sakitData,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'borderColor' => '#3B82F6',
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Alfa',
                    'data' => $alfaData,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => '#EF4444',
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $dates,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'top',
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
                    'intersect' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0, // Angka bulat
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Mahasiswa',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Tanggal (30 hari terakhir)',
                    ],
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }
}
