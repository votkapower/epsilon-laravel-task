<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="" method="post">
                            <div class="bg-orange-200 text-gray-800 font-bold px-4 py-3 mb-4">Looks like you havent filled your credentials. Fill them and you will be given access to your account services :)</div>
                            <x-label  >Client id</x-label>
                            <x-input  name="epsilon_client_id" value="{{auth()->user()->epsilon_client_id}}" reqired minlength="5">


                            <x-label  >Client secret</x-label>
                            <x-input  name="epsilon_client_secret" value="{{auth()->user()->epsilon_client_secret}}" reqired minlength="5">

                            <x-button>Save credentials</x-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
