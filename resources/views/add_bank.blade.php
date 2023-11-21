<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มธนาคาร
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <h4><b>ธนาคารทั้งหมด : {{$all_bank_count}} 
    </div>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="{{route('add_ac_bank')}}">
            @csrf
            <div class="mb-3">
                <label for="name_bank">ชื่อธนาคาร : </label>
                <input type="text" name="name_bank" placeholder="กรอกชื่อธนาคาร">
            </div>
            <div class="mb-3">
                <label for="wallet_bank">จำนวนเงินเริ่มต้น : </label>
                <input type="number" name="wallet_bank" placeholder="จำนวนเงิน">
            </div>
            <button type="submit" class="btn btn-primary">บันทึกรายการ</button>
        </form>
    </div>
</x-app-layout>
