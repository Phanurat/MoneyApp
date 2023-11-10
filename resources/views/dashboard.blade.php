<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            ยินดีต้อนรับสู่ {{ __('Dashboard') }}
        </h5>
        <h3>รายการทั้งหมด xxx ครั้ง</h3>
    </x-slot>
    <br>  
    <div class="container">
        <div class="row">
            <div class="input-group mb-3">
                <input id="input1" class="form-control" type="text" placeholder="เงินสด" aria-label="Disabled input example" disabled>
                <a class="btn btn-secondary" href="#">...</a>
            </div>
            
            <div class="mb-3"></div> <!-- Add spacing -->
    
            <div class="input-group mb-3">
                <input id="input2" class="form-control" type="text" placeholder="บัญชีธนาคาร" aria-label="Disabled input example" disabled>
                <a class="btn btn-secondary" href="edit_page.html">...</a>
            </div>
            
            <div class="mb-3"></div> <!-- Add spacing -->
    
            <div class="input-group mb-3">
                <input id="input3" class="form-control" type="text" placeholder="ค้างรับ" aria-label="Disabled input example" disabled>
                <a class="btn btn-secondary" href="edit_page.html">...</a>
            </div>
            
            <div class="mb-3"></div> <!-- Add spacing -->
    
            <div class="input-group mb-3">
                <input id="input4" class="form-control" type="text" placeholder="ค้างจ่าย" aria-label="Disabled input example" disabled>
                <a class="btn btn-secondary" href="edit_page.html">...</a>
            </div>
            
            <div class="mb-3"></div> <!-- Add spacing -->
    
            <div class="input-group">
                <input id="input5" class="form-control" type="text" placeholder="คงเหลือ" aria-label="Disabled input example" disabled>
            </div>
        </div>
    </div>
    
    
</x-app-layout>
