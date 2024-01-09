{{$id_expense}}

<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขค้างจ่าย
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="{{route('update_ac_no_expense')}}">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_no_expense" value="{{$id_expense}}">

                <label for="valueinput" class="form-label">ชื่อเดิม : {{ $data_no_expense[0]->name_noexpense }}
                    
                    <input type="text" class="form-control" name="name_update" value="{{ $data_no_expense[0]->name_noexpense }}">
                </label>
                
                <div style="margin-top: 10px;"></div>
                <label for="valueinput" class="form-label">จำนวนเงินเดิม : 
                    {{ $data_no_expense[0]->wallet_noexpense }}
                </label>
                
                <input type="number" class="form-control" name="money_update" value="{{ $data_no_expense[0]->wallet_noexpense }}"> 
                <div style="margin-top: 10px;"></div>
                <div class="mb-3">
                    <button type="submit" style="background-color: #0B5ED7; color: white; border: none; padding: 8px 16px; border-radius: 4px;">บันทึกข้อมูล</button>
                </div>
            </div>
               
        </form>
    </div>


</x-app-layout>
