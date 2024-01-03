<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มรายการ ธนาคาร
        </h5>
    </x-slot>

    <div style="margin-top: 10px;"></div>
    <div class="card mx-auto" style="width: 90%; margin: 0 20%;">
        <form method="post" action="{{ route('save_transcation') }}">
            @csrf
            <div class="mb-3">
                <label for="datetimeinput" class="form-label">เวลา</label>
                <input type="datetime-local" class="form-control" id="datetimeinput" name="datetime_trans">
            </div>

            <div class="mb-3">
                <label for="nameinput" class="form-label">ชื่อธนาคาร</label>
                <input type="text" class="form-control" name="name_trans">
            </div>
            
            <div class="mb-3">
                <label for="valueinput" class="form-label">จำนวนเงิน</label>
                <input type="number" class="form-control" name="value_trans">
            </div>
            <div class="mb-3">
                <label for="valueinput" class="form-label">ประเภท</label>
                <select name="select_type" id="select-type" required>
                    <option value="" disabled selected> --- เลือกประเภท --- </option>
                    <!--<option value="income">รายได้</option>
                    <option value="expense">รายจ่าย</option>-->
                    <!--<option value="" disabled selected> ---- </option>-->
                    <option value="inbank">รายได้ (ธนาคาร)</option>
                    <option value="exbank">รายจ่าย (ธนาคาร)</option>
                </select>
            </div>
            <button type="submit" style="background-color: #0B5ED7; color: white; border: none; padding: 8px 16px; border-radius: 4px;">บันทึกรายการ</button>
          </form>
    </div> 

</x-app-layout>

<script>
    // ดึงข้อมูลวันที่และเวลาปัจจุบัน
    let currentDatetime = new Date();
    let year = currentDatetime.getFullYear();
    let month = (currentDatetime.getMonth() + 1).toString().padStart(2, '0');
    let day = currentDatetime.getDate().toString().padStart(2, '0');
    let hours = currentDatetime.getHours().toString().padStart(2, '0');
    let minutes = currentDatetime.getMinutes().toString().padStart(2, '0');
    let datetimeString = `${year}-${month}-${day}T${hours}:${minutes}`;

    // กำหนดค่าเริ่มต้นใน input datetime-local
    document.getElementById('datetimeinput').value = datetimeString;

</script>
