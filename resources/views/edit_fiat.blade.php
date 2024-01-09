<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขเงินสด
        </h5>
    </x-slot>

    <div class="mt-5"></div>
    <div class="card mx-auto" style="width: 90%;">
        <form method="post" action="{{ route('update_fiat') }}">
            @csrf
            <div class="mb-3">
                <label for="valueinput" class="form-label">เงินสด</label> <br>
                <label for="valueinput" class="form-label">จำนวนเงิน : 
                    @if (isset($userdata[0]) && isset($userdata[0]->fiat_wallet)) 
                        {{ $userdata[0]->fiat_wallet }}
                    @else
                        0 บาท
                    @endif
                </label>
                <input type="number" class="form-control" name="fiat_update" placeholder="@if(isset($name[0])&&isset($name[0]->fiat_wallet)){{ $name[0]->fiat_wallet }}@else 0 บาท@endif">
                <div class="mt-3"></div>
            </div>
            <div class="mb-3">
                <button type="submit" style="background-color: #0B5ED7; color: white; border: none; padding: 8px 16px; border-radius: 4px;">บันทึกรายการ</button>
            </div>   
        </form>
    </div> 
</x-app-layout>
