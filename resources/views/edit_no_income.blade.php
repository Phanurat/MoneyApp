<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขค้างรับ
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
          <h4><b>ค้างรับทั้งหมด : {{ $noincome_count }} รายการ
            <a href="{{route('add_no_income')}}" style="color: rgb(11, 62, 104); font-size:24px;"><button>เพิ่มค้างรับ</button></a></b></h4>
          <h4><b>เงินทั้งหมด : {{number_format($noincome_sum)}} บาท </b></h4>
    </div>
    @foreach ($all_noincome as $noincome)
        <div style="margin-top: 10px;"></div>
        <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
            <div class="container">
                <h4><b>ชื่อ : {{ $noincome->name_noincome }} </b></h4>
                <h4><b>จำนวนเงิน : {{ $noincome->wallet_noincome }}</b></h4>
            </div>
            <a class="" href="#id">ได้รับ</a>
            <a class="" href="{{route('edit_mn_no_income', ['id'=>$noincome->id_noincome])}}">แก้ไข</a>
            <a class="" href="{{route('delete_ac_no_income', ['id'=>$noincome->id_noincome])}}">ลบ</a>
        </div>
    @endforeach
    
</x-app-layout>
