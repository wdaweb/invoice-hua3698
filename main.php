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
                <div class="card-body p-5">
                    <h5 class="card-title pb-3">請輸入發票資訊▼</h5>
                    <form action="api/add_invoice.php" method="post" class="card-text row">
                        <div class="form-group col-12 col-lg-6">
                            <label for="pay_date">消費日期：</label>
                            <input type="date" name="date" class="form-control" id="pay_date" required>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="per">期　　別：</label>
                            <select name="period" class="custom-select" id="per" required>
                                <option value="1">1、2月</option>
                                <option value="2">3、4月</option>
                                <option value="3">5、6月</option>
                                <option value="4">7、8月</option>
                                <option value="5">9、10月</option>
                                <option value="6">11、12月</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label>發票號碼：</label>
                            <div class="input-group">
                                <input type="text" name="code" placeholder=" AB " class="form-control col-4">
                                <input type="number" name="number" placeholder=" 12345678 " class="form-control col-8">
                            </div>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="dollar">發票金額：</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="payment" class="form-control" id="dollar" placeholder="888" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">元</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="cid_msg">備註</label>
                            <textarea class="form-control" name="" id="cid_msg" rows="2" placeholder="Writer Your Message..."></textarea>
                        </div>
                        <div class="form-group col-12 text-center">
                            <!-- <input type="submit" value="送出" class="btn btn-sm btn-primary"> -->
                            <input type="submit" value="送出" class="btn badge-primary badge-pill col-4 col-lg-2">
                        </div>

                    </form>

                </div>
            </div>

        </div>
        <div class="col-2"></div>
    </div>

    <!-- <article class="container py-5">
                        <form class="row" method="post">
                            
                            
                            <div class="form-group col-12">
                                <label for="cid_msg">需求說明</label>
                                <textarea class="form-control" id="cid_msg" rows="3" placeholder="Writer Your Message..."></textarea>
                            </div>
                            <div class="form-group col-12 text-center">
                                <small class="text-muted">請如實填寫便於信件回覆，我們保證不隨意公開您的留言資訊</small>
                                <hr class="border-secondary">
                                <button class="btn btn-primary" type="submit">確認送出</button>
                            </div>
                        </form>
                    </article> -->


    <!-- <form action="api/add_invoice.php" method="post" class="mx-3 card-text">

                        <div class="form-group row text-center">
                            <label class="col-form-label">發票號碼：</label>
                            <input type="text" name="code" placeholder="AB" class="form-control">
                            <input type="number" name="number" placeholder="12345678" class="form-control">
                        </div>
                        <div class="form-group row text-center">
                            <label class="col-form-label">發票金額：</label>
                            <input type="number" name="payment" class="form-control">
                        </div>
                        <div class="form-group col-12 text-center">
                            <!-- <input type="submit" value="送出" class="btn btn-sm btn-primary"> -->
    <!-- <input type="submit" value="送出" class="btn badge-primary badge-pill">
                        </div>
                    </form> -->