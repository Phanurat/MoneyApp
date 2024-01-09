<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        #bodystyle{
            background-color: aliceblue;
        }
        #boxlist{
            border-style: solid;
            border-width: 3px;
            border-radius: 20px;
            /* background-color: blue; */
        }
    </style>
    <x-slot name="header" >
        <h5 class="h4">
            แก้ไขธนาคาร
        </h5>
        <div class="container" id="bodystyle">
            <div class="card ">
                <div class="row justify-content-center">
                    <div class="col-1">
                    </div>
                    <div class="col">
                        <div class="input-group mb-1 pt-3">
                            <span class="input-group-text" >รายการทั้งหมด</span>
                            <span class="input-group-text form-control" >{{$all_bank_count}} รายการ</span>
                            <button class="btn btn-primary" data-bs-target="#sho" data-bs-toggle="modal">เพิ่มธนาคาร</button>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" >จำนวนเงินทั้งหมด</span>
                            <span class="input-group-text form-control" >{{ number_format($all_bank_sum) }} บาท</span>
                        </div>
                    </div>
                    <div class="col-1">
                    </div>
                    </div>
                    <div class="d-flex justify-content-center mb-3 ">
                        <a class="btn btn-primary" href="{{route("dashboard")}}">ย้อนกลับ</a>
                    </div>

                  {{-- modal--------------------------------------------------------------------------------------- --}}
                    <div class="modal fade" id="sho">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="bi bi-bank h4"></i>-เพิ่มธนาคาร</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container  mx-auto mt-3">
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
                                                <a href="{{route('edit_bank')}}" class="btn btn-primary">ย้อนกลับ</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="modal-footer">
                                    <button class="btn btn-success">บันทึกข้อมูล</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
            </div>
        
            {{-- -----------------------------------------------------------ส่วนรายการ V V V---------------------------------------------- --}}
                @foreach ($show_bank_data as $bank)
                    <div class="card mt-3" id="boxlist">
                        <div class="card-body">
                            <div class="container">
                                <div class="d-flex ">
                                    <div class="p-2 h3">
                                        <i class="bi bi-currency-dollar"></i>
                                     </div>
                                    <div class="p-2 flex-grow-1 h5">
                                        <p class="card-title">ชื่อธนาคาร : {{ $bank->name_bank }}</p>
                                        <p class="card-text mb-3">จำนวนเงิน : {{ number_format($bank->wallet_bank) }} บาท</p>
                                    </div>
                                    <div class="p-2 h3">
                                        <a class="btn btn-warning" href="{{ route('edit_manage_bank', ['id_bank' => $bank->id_bank]) }}">แก้ไข</a>
                                        <a class="btn btn-danger" href="{{ route('delete_bank', ['id_bank' => $bank->id_bank]) }}">ลบ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>   
        
    </x-slot>
</x-app-layout>