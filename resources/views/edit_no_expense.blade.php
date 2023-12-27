<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขค้างจ่าย
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <div style="margin-top: 10px;"></div>
          <h4><b>รายการที่เหลือ: {{$value_count_not_zero}} ทั้งหมด: {{ $noexpense_count }} รายการ
            <a href="{{route('add_no_expense')}}" class="btn btn-warning" style="color: rgb(7, 41, 70); font-size:12px;"><button>เพิ่มค้างจ่าย</button>
            </a></b></h4>
          <h4><b>เงินทั้งหมด : 
            @if(isset($noexpense_sum, $noexpense_get_sum) && isset($noexpense_sum, $noexpense_get_sum))
                {{ number_format($noexpense_sum - $noexpense_get_sum) }} บาท </b></h4>
            @else
                0 บาท
            @endif
    </div>
    @foreach ($all_noexpense as $noexpense)
        @php
            $remaining_balance = $noexpense->wallet_back - $noexpense->wallet_noexpense ;
        @endphp
        @if($remaining_balance !== 0)
            <div style="margin-top: 10px;"></div>
            <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
                <div style="margin-top: 10px;"></div>
                <div class="container">
                    <h4><b>ชื่อ : {{ $noexpense->name_noexpense }}</b></h4>
                    <h4><b>จำนวนเงิน : {{ $noexpense->wallet_noexpense }} / ได้รับแล้ว : 
                        @if(isset($noexpense->wallet_back) && isset($noexpense->wallet_back))
                            {{ $noexpense->wallet_back }} 
                        @else
                            0
                        @endif
                    </b></h4>
                    <h4><b>คงเหลือ : {{ $remaining_balance }}</b></h4>
                    <div class="mb-3">
                        <a class="btn btn-success" href="{{ route('get_mn_no_expense', ['id'=>$noexpense->id_noexpense]) }}">ชำระ</a>
                        <a class="btn btn-primary" href="{{ route('edit_mn_no_expense', ['id'=>$noexpense->id_noexpense]) }}">แก้ไข</a>
                        <a class="btn btn-danger" href="{{ route('delete_ac_no_expense  ', ['id'=>$noexpense->id_noexpense]) }}">ลบ</a>
                    </div>
                </div>             
            </div>
            <div style="margin-top: 10px;"></div>
        @endif
    @endforeach

    
</x-app-layout>
