<?php 
    $today = new DateTime();          
    $today->modify("+7 days");        
    $formatted = $today->format("Y-m-d");

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make order') }}
        </h2>
    </x-slot>
    <div class="py-12" >
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form  id = "orderForm" class="border-b border rounded-lg  border-white/10 pb-12" action="{{ route('order.store') }}" method="POST">    
                    @csrf
                    <table class="border rounded-lg table-fixed w-full border-gray-700 text-center">
                        <thead >
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
                            <x-order-form id="0"/>
                        </tbody>
                    </table>
                    <div class="flex justify-center w-full">
                        <button type="button" onclick="addNewRow()"  class="btn btn-primary bg-gray-800 p-2 rounded-md w-40 mt-7 text-white cursor-pointer">
                          New row
                        </button>
                    </div>
                    <div class="flex justify-center w-full">
                        <button id="previewBtn" type="button" class="btn btn-primary bg-[#43d175] p-2 rounded-md w-40 mt-7 cursor-pointer"> Send Order</button>
                    </div>
                </form>
                <div>
                    @if ($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <dialog id="previewModal"
        class="rounded-lg p-6 bg-gray-900 text-white w-[98%] sm:w-[90%]">
        <h3 class="text-xl font-semibold mb-6 text-center">Проверьте введённые данные</h3>

        <div id="previewContent" class="overflow-x-auto">
            <!-- JS вставит сюда таблицу -->
        </div>

        <div class="mt-6 flex justify-end gap-4">
            <button id="cancelPreview"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-md">
            Исправить
            </button>
            <button id="confirmSubmit"
                    class="px-4 py-2 bg-green-600 hover:bg-green-500 rounded-md">
            Подтвердить и отправить
    </button>
  </div>
</dialog>
</x-app-layout>
<script>
    var latest = 0;
    let tBody = document.getElementById("tbody");
    //-----------
    const form = document.getElementById('orderForm');
    const modal = document.getElementById('previewModal');
    const preview = document.getElementById('previewContent');

document.getElementById('previewBtn').addEventListener('click', () => {
  const data = new FormData(form);
  
  let html = `<table class="border rounded-lg table-fixed w-full border-gray-700 text-center"> <thead>
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
                        </tr>`;

//   for (const [key, value] of data.entries() ) {
//     console.log(key);
//     console.log(value);
//     html += `
//     <td class="border border-gray-700 p-2">
//             <label> ${value || '<em>не заполнено</em>'}" </label>
//     </td>`;
//     // html += `<li><strong>${key}</strong>: ${value || '<em>не заполнено</em>'}</li>`;
//   }

//     for (const [key, value] of data.entries() )
//     console(data.entries()[i]);
//   }
  preview.innerHTML = html;
  modal.showModal();
});

document.getElementById('cancelPreview').addEventListener('click', () => modal.close());
document.getElementById('confirmSubmit').addEventListener('click', () => form.submit());

    //-----------

    function updateRow(){
        for (let i = 0; i < 11; i++) {
            let inputClear = document.getElementById(`input${i}`);
            inputClear.value="";
        }
    }
    function deleteRow(id){
       let toDelete = document.getElementById(id);
       toDelete.remove();
    }
    function addNewRow(){
        latest ++
        var newElement = document.createElement('tr');
        newElement.setAttribute('id', latest);
        newElement.innerHTML = `
        
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][event_date]" type="date" value="{{ $formatted }}" class="w-full border-0" min="{{ $formatted }}" required/>
            </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][work_start_time]"  type="time"  class="w-auto border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][work_end_time]"  type="time" class="w-auto border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][workers_number]"  type="number" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][event_start_time]"  type="time"  class="w-auto border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][event_end_time]"  type="time"  class="w-auto border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][guests_number]"  type="number" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][duty_content]"  type="text" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][venue_name]"  type="text" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][position]"  type="text" class="w-full border-0" required/>
        </td>
        <td class="border border-gray-700 p-2">
            <input name="orders[${latest}][comments]
            "  type="text" class="w-full border-0" />
        <input type="hidden" name="orders[${latest}][hotel_id]" value="{{ auth()->user()->hotel_id }}">

        <input type="hidden" name="orders[${latest}][dep_id]" value="{{ auth()->user()->dep_id }}">

        <input type="hidden" name="orders[${latest}][coor_id]" value="{{ auth()->user()->coor_id }}">
        </td>
        <td class="border border-gray-700 p-2">
            <button type="button" onclick="deleteRow(${latest})" class="text-red-500 cursor-pointer">削除</button>
        </td>`;
        tBody.appendChild(newElement);
    }
</script>