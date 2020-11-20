<div class="container">
    <form action="api/add_invoice.php" method="post" class="mx-3">
        <p class="mb-4">請輸入發票資訊▼</p>
        <div class="form-group row text-center">
            <label class="col-form-label col-5 col-md-3">消費日期：</label>
            <input type="date" name="date" class="col-6 col-md-4 form-control">
        </div>
        <div class="form-group row text-center">
            <label class="col-form-label col-5 col-md-3">期　　別：</label>
            <select name="period" class="col-6 col-md-4 custom-select">
                <option value="1">1、2月</option>
                <option value="2">3、4月</option>
                <option value="3">5、6月</option>
                <option value="4">7、8月</option>
                <option value="5">9、10月</option>
                <option value="6">11、12月</option>
            </select>
        </div>
        <div class="form-group row text-center">
            <label class="col-form-label col-5 col-md-3">發票號碼：</label>
            <input type="text" name="code" placeholder="AB" class="form-control col-1 col-md-1">
            <input type="number" name="number" placeholder="12345678" class="form-control col-5 col-md-3">
        </div>
        <div class="form-group row text-center">
            <label class="col-form-label col-5 col-md-3">發票金額：</label>
            <input type="number" name="payment" class="form-control col-6 col-md-4">
        </div>
        <div class="text-center">
            <!-- <input type="submit" value="送出" class="btn btn-sm btn-primary"> -->
            <input type="submit" value="送出" class="col-2 btn badge-primary badge-pill">
        </div>
    </form>
</div>