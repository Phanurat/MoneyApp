<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มค้างจ่าย
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="{{route('add_ac_no_expense')}}">
            @csrf
            <div class="mb-3">
                <label for="name_bank">ชื่อรายการ : </label>
                <input type="text" name="name_no_expense" placeholder="กรอกชื่อรายการ">
            </div>
            <div class="mb-3">
                <label for="wallet_bank">จำนวนเงิน : </label>
                <input type="number" name="wallet_no_expense" placeholder="จำนวนเงิน">
            </div>
            <button type="submit" class="btn btn-primary">บันทึกรายการ</button>
        </form>
    </div>
</x-app-layout>