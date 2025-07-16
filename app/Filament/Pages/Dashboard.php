<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AttendanceStats;
use App\Filament\Widgets\LatestAbsensiTable;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?int $navigationSort = 0;
    protected static ?string $title = 'Dashboard Sistem Absensi';
    
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            AttendanceStats::class,
            LatestAbsensiTable::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }
}
