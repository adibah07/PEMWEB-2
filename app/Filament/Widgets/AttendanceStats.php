<?php

namespace App\Filament\Widgets;

use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendanceStats extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 4;
    
    protected int | string | array $columnSpan = 'full';
    
    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        // Today's attendance
        $hadirHariIni = Absensi::whereDate('waktu_absen', $today)
            ->where('status', 'hadir')->count();
        $izinHariIni = Absensi::whereDate('waktu_absen', $today)
            ->where('status', 'izin')->count();
        $sakitHariIni = Absensi::whereDate('waktu_absen', $today)
            ->where('status', 'sakit')->count();
        $alfaHariIni = Absensi::whereDate('waktu_absen', $today)
            ->where('status', 'alfa')->count();

        // This week's attendance rate
        $totalAbsensiMingguIni = Absensi::whereDate('waktu_absen', '>=', $thisWeek)->count();
        $hadirMingguIni = Absensi::whereDate('waktu_absen', '>=', $thisWeek)
            ->where('status', 'hadir')->count();
        $tingkatKehadiran = $totalAbsensiMingguIni > 0 
            ? round(($hadirMingguIni / $totalAbsensiMingguIni) * 100, 1)
            : 0;

        // Active schedules today
        $jadwalAktifHariIni = Jadwal::whereDate('tanggal', $today)->count();

        return [
            Stat::make('Hadir Hari Ini', number_format($hadirHariIni))
                ->description('Mahasiswa hadir')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
            
            Stat::make('Izin & Sakit', number_format($izinHariIni + $sakitHariIni))
                ->description('Dengan keterangan')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
            
            Stat::make('Tidak Hadir', number_format($alfaHariIni))
                ->description('Tanpa keterangan')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
            
            Stat::make('Tingkat Kehadiran', $tingkatKehadiran . '%')
                ->description('Minggu ini')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($tingkatKehadiran >= 80 ? 'success' : ($tingkatKehadiran >= 60 ? 'warning' : 'danger'))
                ->extraAttributes([
                    'class' => 'relative overflow-hidden',
                ]),
        ];
    }
}
