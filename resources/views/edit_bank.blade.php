<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขธนาคาร
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
          <h4><b>ธนาคารทั้งหมด : {{$all_bank_count}} 
            <a href="{{route('add_bank')}}" style="color: rgb(11, 62, 104); font-size:24px;"><button>เพิ่มธนาคาร</button></a></b></h4>
          <h4><b>เงินทั้งหมด : {{$all_bank_sum}} บาท</b></h4>
    </div>

    @foreach ($show_bank_data as $bank)
        <div style="margin-top: 10px;"></div>
        <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
            <div class="container">
                <h4><b>ชื่อธนาคาร : {{ $bank->name_bank }} </b></h4>
                <h4><b>จำนวนเงิน : {{ $bank->wallet_bank }}</b></h4>
            </div>

            <!--route PATH edit_manage_bank, 'id'=> $bank->id -->
            <a class="" href="#">+</a>
        </div>
    @endforeach
    
</x-app-layout>