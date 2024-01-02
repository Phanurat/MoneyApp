<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            ยืนยันการลบค้างจ่าย
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <h4><b>ชื่อ : {{$data_delete_expense[0]->name_noexpense}}
          
        <h4><b>จำนวนเงิน : {{number_format($data_delete_expense[0]->wallet_noexpense)}}
          บาท</b></h4>
          <form method="post" action="{{ route('submit_delete_no_expense') }}">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_expense" value="{{ $id_expense }}">

                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 4px;">ลบ</button>

            </div>
               
        </form>
    </div>
    
</x-app-layout>
