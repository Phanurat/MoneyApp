<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขค้างรับ
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <div style="margin-top: 10px;"></div>
          <h4><b>ค้างรับทั้งหมด : {{ $noincome_count }} รายการ
            <a href="{{route('add_no_income')}}" class="btn btn-warning" style="color: rgb(7, 41, 70); font-size:12px;"><button>เพิ่มค้างรับ</button></a></b></h4>
          <h4><b>เงินทั้งหมด : {{number_format($noincome_sum)}} บาท </b></h4>
    </div>
    @foreach ($all_noincome as $noincome)
        @php
            $remaining_balance = $noincome->wallet_noincome - $noincome->wallet_get;
        @endphp
        @if($remaining_balance !== 0)
            <div style="margin-top: 10px;"></div>
            <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
                <div style="margin-top: 10px;"></div>
                <div class="container">
                    <h4><b>ชื่อ : {{ $noincome->name_noincome }}</b></h4>
                    <h4><b>จำนวนเงิน : {{ $noincome->wallet_noincome }} / ได้รับแล้ว : 
                        @if(isset($noincome->wallet_get) && isset($noincome->wallet_get))
                            {{ $noincome->wallet_get }} 
                        @else
                            0
                        @endif
                    </b></h4>
                    <h4><b>คงเหลือ : {{ $remaining_balance }}</b></h4>
                    <div class="mb-3">
                        <a class="btn btn-success" href="{{ route('get_mn_no_income', ['id'=>$noincome->id_noincome]) }}">ได้รับ</a>
                        <a class="btn btn-primary" href="{{ route('edit_mn_no_income', ['id'=>$noincome->id_noincome]) }}">แก้ไข</a>
                        <a class="btn btn-danger" href="{{ route('delete_ac_no_income', ['id'=>$noincome->id_noincome]) }}">ลบ</a>
                    </div>
                </div>             
            </div>
            <div style="margin-top: 10px;"></div>
        @endif
    @endforeach

    
</x-app-layout>
