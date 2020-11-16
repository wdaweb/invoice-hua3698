<div class="container">
    <form action="api/add_invoice.php" method="post" class="mx-5">
        <p class="mb-4">請輸入發票資訊▼</p>
        <div class="form-group row">
            <label class="col-form-label col-4 col-md-3">消費日期：</label>
            <input type="date" name="date" class="col-5 col-md-3 form-control">
        </div>
        <div class="form-group row">
            <label class="col-form-label col-4 col-md-3">期別：</label>
            <select name="period" class="col-5 col-md-3 custom-select">
                <option value="1">1,2月</option>
                <option value="2">3,4月</option>
                <option value="3">5,6月</option>
                <option value="4">7,8月</option>
                <option value="5">9,10月</option>
                <option value="6">11,12月</option>
            </select>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-4 col-md-3">發票號碼：</label>
            <input type="text" name="code" class="form-control col-2 col-md-1">
            <label class="col-form-label"> - </label>
            <input type="number" name="number" class="form-control col-4 col-md-3">
        </div>
        <div class="form-group row">
            <label class="col-form-label col-4 col-md-3">發票金額：</label>
            <input type="number" name="payment" class="col-5 col-md-3 form-control">
        </div>
        <div class="text-center">
            <!-- <input type="submit" value="送出" class="btn btn-sm btn-primary"> -->
            <input type="submit" value="送出" class="col-2 btn badge-primary badge-pill">
        </div>
    </form>
</div>