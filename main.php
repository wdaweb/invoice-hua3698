    <div class="row">
        <div class="col-2">
            <!-- <ul>
                <li>美金飄落</li>
                <li>中獎插圖</li>
                <li>沒中獎插圖</li>
                <li></li>
                <li></li>
            </ul> -->
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body bg-light">
                    <form action="api/add_invoice.php" method="post" class="mx-3">
                        <h5 class="">請輸入發票資訊▼</h5>
                        <div class="form-group row text-center">
                            <label class="col-form-label">消費日期：</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                        <div class="form-group row text-center">
                            <label class="col-form-label">期　　別：</label>
                            <select name="period" class="custom-select">
                                <option value="1">1、2月</option>
                                <option value="2">3、4月</option>
                                <option value="3">5、6月</option>
                                <option value="4">7、8月</option>
                                <option value="5">9、10月</option>
                                <option value="6">11、12月</option>
                            </select>
                        </div>
                        <div class="form-group row text-center">
                            <label class="col-form-label">發票號碼：</label>
                            <input type="text" name="code" placeholder="AB" class="form-control">
                            <input type="number" name="number" placeholder="12345678" class="form-control">
                        </div>
                        <div class="form-group row text-center">
                            <label class="col-form-label">發票金額：</label>
                            <input type="number" name="payment" class="form-control">
                        </div>
                        <div class="text-center">
                            <!-- <input type="submit" value="送出" class="btn btn-sm btn-primary"> -->
                            <input type="submit" value="送出" class="col-2 btn badge-primary badge-pill">
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-2"></div>
    </div>