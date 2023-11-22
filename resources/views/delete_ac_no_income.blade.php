<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            ยืนยันการลบค้างรับ
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <h4><b>ชื่อ : {{ $data_delete_income[0]->name_noincome }}
          
        <h4><b>จำนวนเงิน : {{ number_format($data_delete_income[0]->wallet_noincome) }}
          บาท</b></h4>
          <form method="post" action="#">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_income" value="{{ $id_income }}">

                <button type="submit" class="btn btn-danger">ลบ</button>
            </div>
               
        </form>
    </div>
    
</x-app-layout>
