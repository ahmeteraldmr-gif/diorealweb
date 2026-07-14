@extends('admin.layouts.app')

@yield('title', 'Kontrol Paneli')

@section('page_title', 'Kontrol Paneli')
@section('page_subtitle', 'Dioreal portal içeriklerinin genel özeti ve istatistikleri.')

@section('content')
    <!-- Stats Cards Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Oteller</span>
                <div class="stat-card-value">{{ $stats['hotels'] }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-hotel"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Restoranlar</span>
                <div class="stat-card-value">{{ $stats['restaurants'] }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-utensils"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Yatlar</span>
                <div class="stat-card-value">{{ $stats['yachts'] }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-ship"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Gezi Rehberleri</span>
                <div class="stat-card-value">{{ $stats['guides'] }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Etkinlikler</span>
                <div class="stat-card-value">{{ $stats['events'] }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Journal Yazıları</span>
                <div class="stat-card-value">{{ $stats['journals'] }}</div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
    </div>

    <!-- Recent Items Sections -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 2rem;">
        
        <!-- Recent Hotels -->
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-hotel" style="color: var(--primary); margin-right: 0.5rem;"></i> Son Eklenen Oteller</h3>
                <a href="{{ route('admin.hotels.index') }}" class="btn btn-outline btn-sm">Tümünü Gör</a>
            </div>
            <div class="table-responsive">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Otel Adı</th>
                            <th>Kategori (Tag)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentHotels as $hotel)
                            <tr>
                                <td>
                                    <img src="{{ asset($hotel->img) }}" alt="" class="table-img">
                                </td>
                                <td>
                                    <strong>{{ $hotel->name['tr'] ?? '' }}</strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $hotel->name['en'] ?? '' }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $hotel->tag['tr'] ?? '' }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted);">Henüz otel eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Restaurants -->
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-utensils" style="color: var(--primary); margin-right: 0.5rem;"></i> Son Eklenen Restoranlar</h3>
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline btn-sm">Tümünü Gör</a>
            </div>
            <div class="table-responsive">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Restoran Adı</th>
                            <th>Kategori (Tag)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRestaurants as $restaurant)
                            <tr>
                                <td>
                                    <img src="{{ asset($restaurant->img) }}" alt="" class="table-img">
                                </td>
                                <td>
                                    <strong>{{ $restaurant->name['tr'] ?? '' }}</strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $restaurant->name['en'] ?? '' }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $restaurant->tag['tr'] ?? '' }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted);">Henüz restoran eklenmemiş.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
