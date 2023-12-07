<style>
    /* เพิ่มรายงาน button */
    .add-report-button {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #0074cc;
        color: #fff;
        border: none;
        border-radius: 15px;
        padding: 10px 20px;
        margin-top: 10px; /* ระยะห่างบน 10px */
        margin-left: auto; /* วางตรงกลางด้านซ้าย */
        margin-right: auto; /* วางตรงกลางด้านขวา */
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s;
        cursor: pointer;
    }
    .add-report-button:hover {
        background-color: #0056a0;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            ยินดีต้อนรับสู่ {{ __('Dashboard') }}
        </h5>
    </x-slot>
    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="เงินสด" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">
                    @if (isset($userdata[0]) && isset($userdata[0]->fiat_wallet))
                        <span class="input-group-text">
                            {{ number_format($userdata[0]->fiat_wallet) }} บาท
                        </span>
                    @else
                        <span class="input-group-text">
                            0 บาท
                        </span>
                    @endif
                </span>
            </div>
            <a class="btn btn-secondary" href="{{ route('edit_fiat') }}">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="บัญชีธนาคาร" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">
                    @if(isset($all_bank_sum) && isset($bankMoney[0]->wallet_bank))
                        <span class="input-group-text">
                            {{ number_format($all_bank_sum) }} บาท
                        </span>
                    @else
                        <span class="input-group-text">
                            0 บาท
                        </span>
                    @endif
                </span>
            </div>
            <a class="btn btn-secondary" href="{{ route('edit_bank') }}">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="ค้างรับ" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">
                    @if(isset($noincome_sum) && isset($noincome_sum))
                        <span class="input-group-text">
                            {{ number_format($noincome_sum) }} บาท
                        </span>
                    @else
                        <span class="input-group-text">
                            0 บาท
                        </span>
                    @endif
                </span>
            </div>
            <a class="btn btn-secondary" href="{{route('edit_no_income')}}">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="ค้างจ่าย" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">
                    @if(isset($noexpense_sum) && isset($noexpense_sum))
                        <span class="input-group-text">
                            {{ number_format($noexpense_sum) }} บาท
                        </span>
                    @else
                        <span class="input-group-text">
                            0 บาท
                        </span>
                    @endif
                </span>
            </div>
            <a class="btn btn-secondary" href="{{route('edit_no_expense')}}">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="คงเหลือรวม (สด+ธนาคาร)" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">
                    @if(isset($total_money_income) && isset($total_money_income))
                        <span class="input-group-text">
                            {{ number_format($total_money_income) }} บาท
                        </span>
                    @else
                        <span class="input-group-text">
                            0 บาท
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="คงเหลือ" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">
                    @if(isset($total_fiat_expense) && isset($total_fiat_expense))
                        <span class="input-group-text">
                            {{ number_format($total_fiat_expense) }} บาท
                        </span>
                    @else
                        <span class="input-group-text">
                            0 บาท
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    
    <div class="card mx-auto" style="width: 30%;">
        <a href="{{ route('add_transcation') }}" class="add-report-button">เพิ่มรายการ</a>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="สรุปรายงาน" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text"></span>
            </div>
        </div>
    </div>
    
    <div style="margin-top: 500px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text"></span>
            </div>
        </div>
    </div>
    

</x-app-layout>
