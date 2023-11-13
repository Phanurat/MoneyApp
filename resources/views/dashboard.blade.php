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
                    {{ $name[0]->fiat_wallet }} บาท
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
                <span class="input-group-text">1,000 บาท</span>
            </div>
            <a class="btn btn-secondary" href="{{ route('edit_fiat') }}">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="ค้างรับ" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">1,000 บาท</span>
            </div>
            <a class="btn btn-secondary" href="edit_page.html">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="ค้างจ่าย" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">1,000 บาท</span>
            </div>
            <a class="btn btn-secondary" href="edit_page.html">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="คงเหลือ" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">1,000 บาท</span>
            </div>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <a href="{{ route('add_transcation') }}" class="add-report-button">เพิ่มรายการ</a>

</x-app-layout>
