{{$id_expense}}

<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขค้างจ่าย
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="#">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_no_income" value="">

                <label for="valueinput" class="form-label">ชื่อเดิม :
                    
                    <input type="text" class="form-control" name="name_update" value="">
                </label>
                
                <div style="margin-top: 10px;"></div>
                <label for="valueinput" class="form-label">จำนวนเงินเดิม : 
                    
                </label>
                
                <input type="number" class="form-control" name="money_update" value="#"> 
                <div style="margin-top: 10px;"></div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
               
        </form>
    </div>


</x-app-layout>
