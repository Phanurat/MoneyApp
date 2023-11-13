<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขเงินสด
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="{{route('update_fiat')}}">
            @csrf
            <div class="mb-3">
                <label for="valueinput" class="form-label">เงินสด</label> <br>
                <label for="valueinput" class="form-label">จำนวนเงิน : 
                    @if (isset($name[0]) && isset($name[0]->fiat_wallet)) 
                        {{ $name[0]->fiat_wallet }}
                    @else
                        0
                        บาท</label>
                    @endif
                <input type="number" class="form-control" name="fiat_update" placeholder="@if(isset($name[0])&&isset($name[0]->fiat_wallet)){{$name[0]->fiat_wallet}}@else 0 บาท@endif">
                <div style="margin-top: 10px;"></div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">บันทึกรายการ</button>
            </div>   
          </form>
          
    </div> 

</x-app-layout>
