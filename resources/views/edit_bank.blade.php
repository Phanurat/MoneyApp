<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขธนาคาร
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <div class="mb-3">
            <h4><b>ธนาคารทั้งหมด : {{$all_bank_count}} 
                <a class="btn btn-success" href="{{route('add_bank')}}"><button>เพิ่มธนาคาร</button></a></b></h4>
            <h4><b>เงินทั้งหมด : {{ number_format($all_bank_sum) }} บาท </b></h4>
        </div>
    </div>

    @foreach ($show_bank_data as $bank)
        <div style="margin-top: 10px;"></div>
        <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
            <div class="container">
                <h4><b>ชื่อธนาคาร : {{ $bank->name_bank }} </b></h4>
                <h4><b>จำนวนเงิน : {{ number_format($bank->wallet_bank) }}</b></h4>
            </div>
            <div style="margin-top: 10px;"></div>
            <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
                <div class="mb-3">
                    <a class="btn btn-primary" href="{{ route('edit_manage_bank', ['id_bank' => $bank->id_bank]) }}">แก้ไข</a>
                    <a class="btn btn-danger" href="{{ route('delete_bank', ['id_bank' => $bank->id_bank]) }}">ลบ</a>
                </div>
            </div>
        </div>
    @endforeach
    
</x-app-layout>
