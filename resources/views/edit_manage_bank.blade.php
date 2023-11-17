<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขธนาคาร
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="#update_bank">
            @csrf
            <div class="mb-3">
                <label for="valueinput" class="form-label">ชื่อธนาคารเดิม : 
                    {{ $name_bank }}
                <input type="text" class="form-control" name="fiat_update" placeholder="{{ $name_bank }}">
                
                <div style="margin-top: 10px;"></div>
                <label for="valueinput" class="form-label">จำนวนเงินเดิม : 
                    @if (isset($all_bank_sum) && isset($all_bank_sum)) 
                        {{ $all_bank_sum }}
                    @else
                        0
                        บาท</label>
                    @endif
                <input type="number" class="form-control" name="fiat_update" placeholder="@if(isset($all_bank_sum)&&isset($all_bank_sum)){{$all_bank_sum}}@else 0 บาท@endif">
                <div style="margin-top: 10px;"></div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>   
          </form>
          
    </div> 

</x-app-layout>
