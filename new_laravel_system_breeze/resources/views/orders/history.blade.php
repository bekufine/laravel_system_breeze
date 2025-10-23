<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>
    <div class="py-12" >
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <form  class="border-b border-white/10 pb-12" action="{{ route('order.store') }}" method="POST"> --}}
                    {{-- @csrf --}}
                    <table class="table-fixed w-full border border-gray-700 text-center">
                        <thead> 
                        <tr class="bg-gray-800 text-white">
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label>Event date</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Work start time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Work end time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Workers number</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Event start time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Event end time</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Guests number</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Duty content</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Venue name</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Position</label>
                            </th>
                            <th class="border border-gray-700 w-1/10 p-2">
                            <label class="block text-base/7 font-semibold text-white">Comments</label>
                            </th>
                            <th class="border border-gray-700 w-15 p-2"></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($orders as $order)
                                <x-order-form :historyPage="true" :order="$order"/>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="my-10">
                        {{$orders->links()}}
                    </div>
                    {{-- <div class="flex justify-center w-full">
                        <button type="button" onclick="addNewRow()"  class="btn btn-primary bg-gray-800 p-2 rounded-md w-40 mt-7 text-white cursor-pointer">
                          New row
                        </button>
                    </div>
                    <div class="flex justify-center w-full">
                        <button type="submit" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer"> Send Order</button>
                    </div> --}}
                {{-- </form> --}}
            </div>
        </div>
    </div>
</x-app-layout>