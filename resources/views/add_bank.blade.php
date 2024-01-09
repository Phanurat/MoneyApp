<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มธนาคาร
        </h5>
        
    </x-slot>
    <div class="container card mx-auto mt-3">
        <div class="mb-3 mt-3" >
            <b class="h3">จำนวนธนาคารทั้งหมด : {{$all_bank_count}} 
        </div>
        <div></div>
        <div class="#">
            <form method="post" action="{{route('add_ac_bank')}}">
                @csrf
                <div>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">ชื่อธนาคาร</span>
                        <input type="text" class="form-control" name="name_bank" placeholder="กรอกชื่อธนาคาร">
                      </div>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">จำนวนเงินเริ่มต้น :</span>
                    <input type="text" class="form-control" name="wallet_bank" placeholder="ระบุจำนวนเงิน">
                    <span class="input-group-text">บาท</span>
                </div>
                <button type="submit" class="btn btn-success">บันทึกรายการ</button>
                <a href="#" class="btn btn-primary">ย้อนกลับ</a>
            </form>
        </div>
    </div>

</x-app-layout>
