<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขค้างจ่าย
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <h4><b>รายการที่เหลือ:  ทั้งหมด: {{ $noexpense_count }} รายการ
            <a href="{{route('add_no_expense')}}" class="btn btn-warning" style="color: rgb(7, 41, 70); font-size:12px;">
                <button>เพิ่มค้างจ่าย</button>
            </a></b></h4>
        <h4><b>เงินทั้งหมด: {{ number_format($noexpense_sum) }} บาท</b></h4>
    </div>

    @foreach ($all_noexpense as $noexpense)
        <div style="margin-top: 10px;"></div>
        <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
            <div class="container">
                <h4><b>ชื่อ: {{ $noexpense->name_noexpense }}</b></h4>
                <h4><b>จำนวนเงิน: {{ $noexpense->wallet_noexpense }}</b></h4>
            </div>
            <div class="mb-3">
                <a class="btn btn-success" href="{{ route('get_mn_no_expense', ['id'=>$noexpense->id_noexpense]) }}">ใช้คืน</a>
                <a class="btn btn-primary" href="{{ route('edit_mn_no_expense', ['id'=>$noexpense->id_noexpense]) }}">แก้ไข</a>
                <a class="btn btn-danger" href="{{ route('delete_ac_no_expense', ['id'=>$noexpense->id_noexpense]) }}">ลบ</a>
            </div>
        </div>
    @endforeach
</x-app-layout>
