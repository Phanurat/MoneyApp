<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            ยืนยันการลบธนาคาร
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <h4><b>ชื่อธนาคาร : {{$show_data_bank[0]->name_bank}}
          
        <h4><b>จำนวนเงิน : {{$show_data_bank[0]->wallet_bank}}
          บาท</b></h4>
          <form method="post" action="{{ route('submit_delete_bank') }}">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_bank" value="{{ $id_bank }}">

                <button type="submit" class="btn btn-danger">ลบ</button>
            </div>
               
        </form>
    </div>
    
</x-app-layout>
