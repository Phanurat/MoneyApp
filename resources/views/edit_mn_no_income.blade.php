<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขค้างรับ
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="#">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_no_income" value="">

                <label for="valueinput" class="form-label">ชื่อเดิม :{{ $data_no_income[0]->name_noincome }}
                    
                    <input type="text" class="form-control" name="name_update" value="{{ $data_no_income[0]->name_noincome }}">
                </label>
                
                <div style="margin-top: 10px;"></div>
                <label for="valueinput" class="form-label">จำนวนเงินเดิม : 
                    {{ $data_no_income[0]->wallet_noincome }}
                </label>
                
                <input type="number" class="form-control" name="money_update" value="{{ $data_no_income[0]->wallet_noincome }}"> 
                <div style="margin-top: 10px;"></div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
               
        </form>
    </div>


</x-app-layout>
