<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    @if (Auth::user()->unreadNotifications->count() > 0)
                        <div class="bg-yellow-100 p-4 mb-4">
                            <h3 class="font-semibold text-lg">You have new notifications:</h3>
                            <ul>
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <li class="border-b py-2">
                                        <a href="{{ route('orders.show', $notification->data['order_id']) }}" class="text-blue-500">
                                            {{ $notification->data['message'] }}
                                        </a>
                                        <form method="POST" action="{{ route('markNotificationAsRead', $notification->id) }}" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-sm text-gray-600">Mark as read</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
