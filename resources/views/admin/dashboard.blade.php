<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 admin-dashboard">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-8 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-12 w-12 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-2xl font-bold text-white mb-2">Bienvenue dans l'administration BeninOccaz</h3>
                            <p class="text-blue-100 text-lg">Vous êtes connecté en tant qu'administrateur. Utilisez ce tableau de bord pour gérer votre plateforme e-commerce.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-blue-100 rounded-lg">
                                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Utilisateurs</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200 hover:shadow-xl transition-shadow duration-300 {{ $stats['pending_items'] > 0 ? 'ring-2 ring-orange-200' : '' }}">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-orange-100 rounded-lg {{ $stats['pending_items'] > 0 ? 'animate-pulse' : '' }}">
                                    <svg class="h-8 w-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Articles en attente</p>
                                <div class="flex items-center">
                                    <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_items'] }}</p>
                                    @if($stats['pending_items'] > 0)
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            Urgent
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-green-100 rounded-lg">
                                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Articles approuvés</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['approved_items'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Signalements</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_reports'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-purple-100 rounded-lg">
                                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.998 1.998 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Catégories</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200 mb-8">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Actions rapides
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <a href="{{ route('admin.pending-items') }}" class="group bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-4 rounded-xl text-center transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <div class="text-center">
                                <svg class="w-6 h-6 mx-auto mb-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="font-semibold text-sm">Articles en attente</div>
                                @if($stats['pending_items'] > 0)
                                    <span class="inline-block mt-1 bg-white text-orange-600 rounded-full px-2 py-1 text-xs font-bold animate-pulse">{{ $stats['pending_items'] }}</span>
                                @endif
                            </div>
                        </a>
                        <a href="{{ route('admin.users') }}" class="group bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-6 py-4 rounded-xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <div class="text-center">
                                <svg class="w-6 h-6 mx-auto mb-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <div class="font-semibold text-sm">Gérer utilisateurs</div>
                            </div>
                        </a>
                        <a href="{{ route('admin.items') }}" class="group bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-4 rounded-xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <div class="text-center">
                                <svg class="w-6 h-6 mx-auto mb-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <div class="font-semibold text-sm">Gérer articles</div>
                            </div>
                        </a>
                        <a href="{{ route('categories.index') }}" class="group bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-4 rounded-xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <div class="text-center">
                                <svg class="w-6 h-6 mx-auto mb-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.998 1.998 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <div class="font-semibold text-sm">Gérer catégories</div>
                            </div>
                        </a>
                        <a href="{{ route('admin.reports.index') }}" class="group bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-4 rounded-xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <div class="text-center">
                                <svg class="w-6 h-6 mx-auto mb-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <div class="font-semibold text-sm">Voir signalements</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pending Items Alert -->
            @if($stats['pending_items'] > 0)
            <div class="bg-gradient-to-r from-orange-50 to-yellow-50 border-l-4 border-orange-400 rounded-xl p-6 mb-8 shadow-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-2 bg-orange-100 rounded-lg">
                            <svg class="h-6 w-6 text-orange-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h4 class="text-lg font-bold text-orange-900">Attention requise!</h4>
                        <p class="text-orange-800 font-medium">
                            <strong class="text-xl">{{ $stats['pending_items'] }}</strong> article(s) en attente d'approbation nécessitent votre attention immédiate.
                        </p>
                    </div>
                    <div class="ml-6">
                        <a href="{{ route('admin.pending-items') }}" class="bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Examiner maintenant
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Pending Items -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                <div class="p-2 bg-orange-100 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                Articles en attente
                            </h3>
                            <a href="{{ route('admin.pending-items') }}" class="text-orange-600 hover:text-orange-800 text-sm font-semibold transition-colors duration-200">Voir tout →</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($stats['pending_items_list'] as $item)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900 text-sm">{{ Str::limit($item->title, 25) }}</p>
                                    <p class="text-xs text-gray-600 mt-1">Par {{ $item->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-orange-600 mt-1">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.pending-items.show', $item) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs font-medium transition-colors duration-200">Examiner</a>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm mt-2">Aucun article en attente</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            Utilisateurs récents
                        </h3>
                        <div class="space-y-4">
                            @foreach($stats['recent_users'] as $user)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-semibold text-gray-900 text-sm">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-600">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($user->role === 'admin') bg-red-100 text-red-800
                                    @elseif($user->role === 'seller') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($user->role ?? 'buyer') }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Items -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            Articles récents
                        </h3>
                        <div class="space-y-4">
                            @foreach($stats['recent_items'] as $item)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        @if($item->images && count($item->images) > 0)
                                            <img class="h-12 w-12 rounded-lg object-cover" src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->title }}">
                                        @else
                                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-semibold text-gray-900 text-sm">{{ Str::limit($item->title, 25) }}</p>
                                        <p class="text-xs text-gray-600">{{ number_format($item->price, 0, ',', ' ') }} FCFA</p>
                                        <p class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($item->approval_status === 'approved') bg-green-100 text-green-800
                                    @elseif($item->approval_status === 'pending') bg-orange-100 text-orange-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($item->approval_status) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
