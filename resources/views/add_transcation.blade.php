<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มรายการ
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="{{ route('save_transcation') }}">
            @csrf
            <div class="mb-3">
              <label for="nameinput" class="form-label">ชื่อรายการ</label>
              <input type="text" class="form-control" name="name_trans">
            </div>
            <div class="mb-3">
                <label for="valueinput" class="form-label">จำนวนเงิน</label>
                <input type="number" class="form-control" name="value_trans">
            </div>
            <div class="mb-3">
                <label for="valueinput" class="form-label">ประเภท</label>
                <select name="select_type" id="select-type">

                    <option value="income">รายได้</option>
                    <option value="expense">รายจ่าย</option>
                </select>
            </div>
            <div class="mb-3">
                <a href="add_transcation_bank.php"><button type="button">เพิ่มรายการ ธนาคาร</button></a>
            </div>
            <button type="submit" class="btn btn-primary">บันทึกรายการ</button>
          </form>
    </div> 

</x-app-layout>
