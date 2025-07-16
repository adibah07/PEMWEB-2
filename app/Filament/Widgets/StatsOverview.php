<?php

namespace App\Filament\Widgets;

use App\Models\Absensi;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';
    
    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();

        // Cache calculations for better performance
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMatakuliah = Matakuliah::count();
        $absensiHariIni = Absensi::whereDate('waktu_absen', $today)->count();

        // Calculate attendance rate
        $totalAbsensiMingguIni = Absensi::whereDate('waktu_absen', '>=', $thisWeek)->count();
        $hadirMingguIni = Absensi::whereDate('waktu_absen', '>=', $thisWeek)
            ->where('status', 'hadir')->count();
        $tingkatKehadiran = $totalAbsensiMingguIni > 0 
            ? round(($hadirMingguIni / $totalAbsensiMingguIni) * 100, 1)
            : 0;

        return [
            Stat::make('Total Mahasiswa', number_format($totalMahasiswa))
                ->description('Mahasiswa aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
            
            Stat::make('Total Dosen', number_format($totalDosen))
                ->description('Pengajar aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
            
            Stat::make('Mata Kuliah', number_format($totalMatakuliah))
                ->description('Tersedia')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('warning')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
            
            Stat::make('Absensi Hari Ini', number_format($absensiHariIni))
                ->description('Kehadiran tercatat')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
        ];
    }
}
