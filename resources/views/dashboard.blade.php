<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(!count($accountServices))
                        <p class="mb-4">Looks like you have no account Services. Do you want to issue a call to the database (pro tip: you do)?</p>
                        <form action="/manualySyncRemoteServices" method="get">
                             <x-button type="submit">Manualy check for my account services</x-button>
                        </form>
                    @else 
 
                        @foreach ($accountServices as $service)
                            <x-account-service-card :service="$service"></x-account-service-card>
                        @endforeach

                        {!! $accountServices->links() !!}


                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
