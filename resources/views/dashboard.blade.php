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
                    {{ isset($wallet_bank[0]->wallet_bank) ? $wallet_bank[0]->wallet_bank : 0 }} บาท
                </span>
                

            </div>
            <a class="btn btn-secondary" href="edit_page.html">...</a>
        </div>
    </div>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 10%;">
        <div class="input-group">
            <input id="input4" class="form-control" type="text" placeholder="บัญชีธนาคาร" aria-label="Disabled input example" disabled>
            <div class="input-group-append">
                <span class="input-group-text">1,000 บาท</span>
            </div>
            <a class="btn btn-secondary" href="edit_page.html">...</a>
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
</x-app-layout>
