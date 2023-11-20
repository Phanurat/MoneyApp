{{$id_bank}}
<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขธนาคาร
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="{{ route('update_bank') }}">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id_bank" value="{{ $id_bank }}">

                <label for="valueinput" class="form-label">ชื่อธนาคารเดิม : 
                    {{$select_bank_name[0]->name_bank}}
                    <input type="text" class="form-control" name="name_update" value="{{$select_bank_name[0]->name_bank}}">
                </label>
                
                <div style="margin-top: 10px;"></div>
                <label for="valueinput" class="form-label">จำนวนเงินเดิม : 
                    @if (isset($all_bank_sum) && isset($all_bank_sum)) 
                        {{ $all_bank_sum }} บาท
                    @else
                        0 บาท
                    @endif
                </label>
                
                <input type="number" class="form-control" name="money_update" value="@if(isset($all_bank_sum)&&isset($all_bank_sum)){{$all_bank_sum}}@else 0 @endif"> 
                <div style="margin-top: 10px;"></div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </div>
               
        </form>
    </div>


</x-app-layout>
