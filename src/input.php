<?php
    require "idcontrol.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <title>診察予約調整希望受付フォーム</title>
    <!--<link rel="stylesheet" href="style.css">-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
    <script type="text/javascript" src="contact.js"></script>
    <!-- 郵便番号住所自動入力 -->
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Bootstrap -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap4-charming.min.css">
</head>

<body>
    <div class="row">
        <div class="col-12">
            <h2 class="display-4 ht-tm-component-title">診察予約調整希望受付フォーム</h2>
        </div>
    </div>
    <div class="container-fluid  d-flex h-100">
        <form action="confirm.php" method="post" class="needs-validation" name="form" id="inputform" enctype="multipart/form-data" onsubmit="return validate()" novalidate>
            <h1 class="contact-title">診察予約調整希望 内容入力</h1>
            <p>こちらでは検査予約のみに関する予約調整はお受けできません。<br>内容をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
            <div class="card col-12">
                <h5>お名前</h5>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="name" placeholder="例）埼玉　太郎" value="">
                    </div>
                </div>
                <br>
                <h5>診察券番号</h5>
                <div class="row form-group">
                    <div class="col">
                        <input type="text" class="form-control" name="patientid" id="patientid" placeholder="例）00012345" value="">
                    </div>
                </div>
                <br>
                <h5>診療科</h5>
                <div class="row form-group">
                    <div class="col">
                        <select name="section" class="custom-select" id="section">
                            <option value="0">受診希望診療科を選択してください</option>
                            <option value="内科">内科</option>
                            <option value="総合診療科">総合診療科</option>
                            <option value="脳神経内科">脳神経内科</option>
                            <option value="呼吸器内科">呼吸器内科</option>
                            <option value="循環器内科">循環器内科</option>
                            <option value="小児科・小児外科">小児科・小児外科</option>
                            <option value="外科（消化器外科）">外科（消化器外科）</option>
                            <option value="乳腺外科">乳腺外科</option>
                            <option value="整形外科">整形外科</option>
                            <option value="形成外科">形成外科</option>
                            <option value="脳神経外科">脳神経外科</option>
                            <option value="呼吸器外科">呼吸器外科</option>
                            <option value="心臓血管外科">心臓血管外科</option>
                            <option value="皮膚科">皮膚科</option>
                            <option value="泌尿器科">泌尿器科</option>
                            <option value="産科">産科</option>
                            <option value="婦人科">婦人科</option>
                            <option value="眼科">眼科</option>
                            <option value="耳鼻咽喉科">耳鼻咽喉科</option>
                            <option value="放射線科">放射線科</option>
                            <option value="精神科">精神科</option>
                            <option value="緩和ケア内科">緩和ケア内科</option>
                        </select>
                    </div>
                </div>
                <br>
                <h5>電話番号</h5>
                <div class="row form-group">
                    <div class="col">
                        <input class="form-control" type="text" name="tel" placeholder="例）0357125050" value="">
                    </div>
                </div>
                <br>
                <h5>メールアドレス</h5>
                <div class="row form-group">
                    <div class="col">
                        <input type="email" class="form-control" name="email" id="email" placeholder="例）guest@example.com" value="">
                    </div>
                </div>
                <br>
                <h5>当院でのオンライン診療受診回数</h5>
                <div class="row">
                    <input type="hidden" name="telemedicine_cnt_value_forie11trident" value="２回目以降">
                    <div class="custom-control custom-radio form-group col d-flex justify-content-center align-items-center">
                        <input type="radio" class="custom-control-input" name="telemedicine_cnt" id="telemedicine_cnt1" value="２回目以降" onClick='telemedicinecntChangeToAnother(this.checked);' checked="checked">
                        <label class="custom-control-label" for="telemedicine_cnt1">２回目以降</label>
                    </div>
                    <div class="custom-control custom-radio form-group col d-flex justify-content-center align-items-center">
                        <input type="radio" class="custom-control-input" name="telemedicine_cnt" id="telemedicine_cnt2" value="新規予約" onClick='telemedicinecntChangeToFirst(this.checked);'>
                        <label class="custom-control-label" for="telemedicine_cnt2">初回</label>
                    </div>
                </div>
                <br>
                <h5>署名済み承諾書写真</h5>
                <p>
                    <span style="color:#000080">※当院でのオンライン診療受診が初めての患者さんは、PDFダウンロードの後印刷、承諾書に署名した文書を撮影した画像を添付ください。</span>
                </p>
                <div class="row form-group">
                    <div class="col">
                        <div class="input-group">
                            <div class="custom-file">
                                <!--FileSize_MAX=5MB -->
                                <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
                                <input type="file" class="custom-file-input" name="picturefile" id="picturefile" accept="image/*">
                                <label class="custom-file-label" for="picturefile" data-browse="参照">署名済み承諾書写真画像を添付してください</label>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="reset btn btn-outline-secondary input-group-text" id="picturefile_cancel">取消</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <!--<h4 class="d-flex justify-content-center align-items-center">調整依頼種別</h4>-->
                            調整依頼種別
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="request_type_value_forie11trident" value="予約変更">
                                <div class="custom-control custom-radio form-group col d-flex justify-content-center align-items-center">
                                    <input type="radio" class="custom-control-input" name="request_type" id="request_type1" value="予約変更" onClick='reservedflagChangeToReservedPtv("request_change",this.checked);' checked="checked">
                                    <label class="custom-control-label" for="request_type1">予約変更</label>
                                </div>
                                <div class="custom-control custom-radio form-group col d-flex justify-content-center align-items-center">
                                    <input type="radio" class="custom-control-input" name="request_type" id="request_type2" value="新規予約" onClick='reservedflagChangeToReservedNgv("request_new",this.checked);'>
                                    <label class="custom-control-label" for="request_type2">新規予約</label>
                                </div>
                                <div class="custom-control custom-radio form-group col d-flex justify-content-center align-items-center">
                                    <input type="radio" class="custom-control-input" name="request_type" id="request_type3" value="予約キャンセル" onClick='reservedflagChangeToReservedPtv("request_cancel",this.checked);'>
                                    <label class="custom-control-label" for="request_type3">予約キャンセル</label>
                                </div>
                            </div>
                            <span class="d-flex justify-content-center align-items-center" style="color:#008080">※「調整依頼種別」にて”予約変更”または”予約キャンセル”をご希望の患者さんのみ、次の「受付済み診察予約日」の入力が必要です。</span><br>

                            <div class="row">
                                <h6 class="col-4 d-flex justify-content-center align-items-center">受付済み診察予約日</h6>
                                <div class="col-8 form-group">
                                    <input type="text" class="form-control d-flex justify-content-center align-items-center" name="ReservedDate" id="reservedcalendar" placeholder="カレンダーより予約済み診察日をお選びください" value="" disabled="false">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div>
                    <label></label>
                    <p>
                        <span style="color:#000080">※以下の希望予約日は予め患者さん主治医の担当診療日を事前にご確認の上、ご入力ください。</span>
                    </p>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center">
                            希望予約候補日
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <h6 class="col-2 d-flex justify-content-center align-items-center">第一希望予約日</h6>
                                <div class="col-10 form-group d-flex justify-content-center align-items-center">
                                    <input type="text" class="form-control" name="Reservation1" id="calendar1" placeholder="カレンダーより希望日をお選びください" value="">
                                <div class="custom-control custom-radio col-2 d-flex justify-content-center align-items-center">
                                    <input type="radio" class="custom-control-input" name="rsv1ampm" id="rsv1ampm1" value="AM">
                                    <label class="custom-control-label " for="rsv1ampm1">AM</label>
                                </div>
                                <div class="custom-control custom-radio col-2 d-flex justify-content-center align-items-center">
                                    <input type="radio" class="custom-control-input" name="rsv1ampm" id="rsv1ampm2" value="PM" checked>
                                    <label class="custom-control-label" for="rsv1ampm2">PM</label>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <h6 class="col-2 d-flex justify-content-center align-items-center">第二希望予約日</h6>
                                <div class="col-10 form-group d-flex justify-content-center align-items-center">
                                    <input type="text" class="form-control" name="Reservation2" id="calendar2" placeholder="カレンダーより希望日をお選びください" value="">
                                    <div class="custom-control custom-radio col-2 d-flex justify-content-center align-items-center">
                                        <input type="radio" class="custom-control-input" name="rsv2ampm" id="rsv2ampm1" value="AM">
                                        <label class="custom-control-label" for="rsv2ampm1">AM</label>
                                    </div>
                                    <div class="custom-control custom-radio col-2 d-flex justify-content-center align-items-center">
                                        <input type="radio" class="custom-control-input" name="rsv2ampm" id="rsv2ampm2" value="PM" checked>
                                        <label class="custom-control-label" for="rsv2ampm2">PM</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h6 class="col-2 d-flex justify-content-center align-items-center">第三希望予約日</h6>
                                <div class="col-10 form-group d-flex justify-content-center align-items-center">
                                    <input type="text" class="form-control" name="Reservation3" id="calendar3" placeholder="カレンダーより希望日をお選びください" value="">
                                    <div class="custom-control custom-radio col-2 d-flex justify-content-center align-items-center">
                                        <input type="radio" class="custom-control-input" name="rsv3ampm" id="rsv3ampm1" value="AM">
                                        <label class="custom-control-label" for="rsv2ampm1">AM</label>
                                    </div>
                                    <div class="custom-control custom-radio col-2 d-flex justify-content-center align-items-center">
                                        <input type="radio" class="custom-control-input" name="rsv3ampm" id="rsv3ampm2" value="PM" checked>
                                        <label class="custom-control-label" for="rsv2ampm2">PM</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <h5>予約調整ポリシー承諾</h5>
                <div class="custom-control custom-checkbox form-group">
                    <input type="checkbox" class="custom-control-input" id="policy" name="policy" value="policy">
                    <label class="custom-control-label" for="policy">診察予約調整のご希望は、同日に実施される検査や診察する主治医都合等によりご希望に沿えない場合があります。予めご了承ください。</label>
                </div>
                <br>
                <h5>個人情報の取り扱い</h5>
                <div class="custom-control custom-checkbox form-group">
                    <input type="checkbox" class="custom-control-input" id="check" name="check" value="check">
                    <label class="custom-control-label" for="check">独立行政法人国立病院機構埼玉病院では、ホームページにおける個人情報の収集・利用・管理について、適切に取り扱うとともに、当サイトを閲覧する皆様のプライバシーを十分尊重し、安心して利用いただけるよう努めていきます。</label>
                </div>
                <br>
                <button type="submit" class="btn btn-block btn-info" name="submit_button" form="inputform">確認画面へ</button>
            </div>

        </form>

    </div>
    <script type="text/javascript">
        //javascriptによる日付計算はかなりクセがある。詳細は要参照→https://qiita.com/kazu56/items/cca24cfdca4553269cab
        $.get("https://holidays-jp.github.io/api/v1/date.json", function(holidaysData) {
            var holidays = Object.keys(holidaysData);
            var now_date = new Date();
            var now_year = now_date.getFullYear().toString();
            var next_year = (now_date.getFullYear() + 1).toString();
            //年末年始対応Part1（12/28～31、翌年1/2-3までを無条件で非選択UI化するための定数追加※いわゆる祝日リストにはないものの、祝日として扱ってほしい日付の追加	）
            holidays.push(now_year + "-12-28", now_year + "-12-29", now_year + "-12-30", now_year + "-12-31", next_year + "-01-02", next_year + "-01-03");
            //年末年始対応Part2（年が明けたとき、1/2、1/3を祝日として取扱ための日付追加）
            holidays.push(now_year + "-01-02", now_year + "-01-03");
            $(function() {
                $("#calendar1,#calendar2,#calendar3").datepicker({
                    //７日後から選択可
                    minDate: "+7d",
                    //180日後まで選択可
                    maxDate: "+180d",
                    beforeShowDay: function(date) {
                        var child_date = new Date();
                        if (date.getDay() == 0) {
                            // 日曜日
                            return [false, 'day-sunday'];
                        } else if (date.getDay() == 6) {
                            // 土曜日
                            return [false, 'day-saturday'];
                        } else {
                            var dt_year = date.getFullYear().toString();
                            var dt_month = ("00" + (date.getMonth() + 1)).slice(-2);
                            var dt_date = ("00" + date.getDate().toString());
                            dt_date = dt_date.slice(-2);
                            var strDate = dt_year + "-" + dt_month + "-" + dt_date;

                            for (let i = 0; i < holidays.length; i++) {
                                //祝日一覧とカレンダー表示日付の突合処理→該当あれば非選択UIへ
                                if (strDate == holidays[i].toString()) {
                                    return [false, 'day-holiday'];
                                    break;
                                }
                            }
                            // 平日（選択可能UI定義）
                            return [true, ''];
                        }
                    }
                });
            });
            $("#reservedcalendar").datepicker({
                beforeShowDay: function(date) {
                    //日曜日、土曜日無効化
                    return [date.getDay() == 0 || date.getDay() == 6 ? false : true];
                }
            });
        });
        //DOMツリー構築完了時に処理を実行
        $(document).ready(function() {
            if (sessionStorage.getItem("arr_confirm_data") != null) {
                const arr_confirm_data = JSON.parse(sessionStorage.getItem("arr_confirm_data"));
                //IE11におけるforEach対応参考URL→https://qiita.com/k-gen/items/01ff3d70eaf798f6e34b
                const ie_arr_confirm_data = Array.prototype.slice.call(arr_confirm_data);
                ie_arr_confirm_data.forEach(function(key) {
                    if (document.getElementsByName(key).value == null) {
                        var key_name = key.name;
                        var Settting_ValueSpace = document.getElementsByName(key_name);
                        var key_value = key.value;
                        if (key.value != null) {
                            if (key.name == "telemedicine_cnt"){
                                if (key_value == "２回目以降"){
                                    telemedicinecntChangeToAnother(true);
                                }
                            } else {
                                telemedicinecntChangeToFirst(true);
                            }
                            if (key.name == "request_type") {
                                if (key_value !== "新規予約") {
                                    var request_type = "";
                                    if (key_value == "予約変更") {
                                        request_type = "request_change";
                                    //予約キャンセル
                                    } else {
                                        request_type = "request_cancel";
                                    }
                                    reservedflagChangeToReservedPtv(request_type, true);
                                //新規予約選択時
                                } else {
                                    var request_type = "request_new";
                                    reservedflagChangeToReservedNgv(request_type, true);
                                }
                            } else {
                                var search_ampm = (key.name).indexOf("ampm");
                                if (search_ampm > 0) {
                                    if (key_value == "AM") {
                                        document.getElementById(key.name + "1").checked = true;
                                    } else {
                                        document.getElementById(key.name + "2").checked = true;
                                    }
                                } else {
                                    if (key.name == "ctrlnum") {
                                        //メール送信（確定）されていない番号はクリア
                                        //console.log("test");
                                        key_value = "";
                                    } else {
                                        //参考URL→https://itsakura.com/js-getelementsbyname
                                        Settting_ValueSpace[0].value = key_value;
                                    }
                                }
                            }
                        }
                    }
                });
                //console.log(ie_arr_confirm_data);
            } else {
                telemedicinecntChangeToAnother(true);
                reservedflagChangeToReservedPtv("request_change", true);
            }
        });
        //参考URL→https://qiita.com/isaaac/items/e6ffc9b817bad749a525
        //"予約変更"、"予約キャンセル"選択時処理
        function reservedflagChangeToReservedPtv(str_request_type, ischecked) {
            if (ischecked == true) {
                document.getElementById("reservedcalendar").disabled = false;
                if (str_request_type !== "request_cancel") {
                    reservedflagChangeTo1to3ResevationDateTimePtv(true);
                } else {
                    reservedflagChangeTo1to3ResevationDateTimeNgv(true);
                }
            }
        }
        //”新規予約”選択時処理
        function reservedflagChangeToReservedNgv(str_request_type, ischecked) {
            if (ischecked == true) {
                document.getElementById("reservedcalendar").disabled = true;
                document.getElementById("reservedcalendar").value = "";
                reservedflagChangeTo1to3ResevationDateTimePtv(true);
            }
        }

        //予約キャンセル時のみ第１～３希望予約日無効化
        function reservedflagChangeTo1to3ResevationDateTimeNgv(ischecked) {
            if (ischecked == true) {
                document.getElementById("calendar1").disabled = true;
                document.getElementById("calendar1").value = "";
                document.getElementById("rsv1ampm1").disabled = true;
                document.getElementById("rsv1ampm1").checked = false;
                document.getElementById("rsv1ampm2").disabled = true;
                document.getElementById("rsv1ampm2").checked = false;

                document.getElementById("calendar2").disabled = true;
                document.getElementById("calendar2").value = "";
                document.getElementById("rsv2ampm1").disabled = true;
                document.getElementById("rsv2ampm1").checked = false;
                document.getElementById("rsv2ampm2").disabled = true;
                document.getElementById("rsv2ampm2").checked = false;

                document.getElementById("calendar3").disabled = true;
                document.getElementById("calendar3").value = "";
                document.getElementById("rsv3ampm1").disabled = true;
                document.getElementById("rsv3ampm1").checked = false;
                document.getElementById("rsv3ampm2").disabled = true;
                document.getElementById("rsv3ampm2").checked = false;
            }
        }
        //予約キャンセル以外のとき第１～３希望予約日有効化＆カレンダー入力値クリア
        function reservedflagChangeTo1to3ResevationDateTimePtv(ischecked) {
            if (ischecked == true) {
                document.getElementById("calendar1").disabled = false;
                document.getElementById("calendar1").value = "";
                document.getElementById("rsv1ampm1").disabled = false;
                document.getElementById("rsv1ampm1").checked = false;
                document.getElementById("rsv1ampm2").disabled = false;
                document.getElementById("rsv1ampm2").checked = true;

                document.getElementById("calendar2").disabled = false;
                document.getElementById("calendar2").value = "";
                document.getElementById("rsv2ampm1").disabled = false;
                document.getElementById("rsv2ampm1").checked = false;
                document.getElementById("rsv2ampm2").disabled = false;
                document.getElementById("rsv2ampm2").checked = true;

                document.getElementById("calendar3").disabled = false;
                document.getElementById("calendar3").value = "";
                document.getElementById("rsv3ampm1").disabled = false;
                document.getElementById("rsv3ampm1").checked = false;
                document.getElementById("rsv3ampm2").disabled = false;
                document.getElementById("rsv3ampm2").checked = true;
            }
        }
        //当院オンライン診療受診回数が’初回’のとき次項’署名済み承諾書写真’を有効化
        function telemedicinecntChangeToFirst(ischecked) {
            if (ischecked == true){
                $(".custom-file-label").html("署名済み承諾書写真画像を添付してください");
                document.getElementById("telemedicine_cnt2").checked = true;
                document.getElementById("picturefile").disabled = false;
                document.getElementById("picturefile_cancel").disabled = false;
            }
        }
        //当院オンライン診療受診回数が’２回目以降’のとき次項’署名済み承諾書写真’を無効化
        function telemedicinecntChangeToAnother(ischecked) {
            if (ischecked == true){
                $(".reset").trigger("click");
                document.getElementById("telemedicine_cnt1").checked = true;
                document.getElementById("picturefile").disabled = true;
                document.getElementById("picturefile_cancel").disabled = true;
            }
        }
        //署名済み写真アップロード
        $(".custom-file-input").on("change", function() {
            // 制限サイズ(5MB)
            const sizeLimit = 1024 * 1024 * 5;
            var inputfilesize = this.files[0].size;
            if (inputfilesize <= sizeLimit) {
                $(this).next(".custom-file-label").html($(this)[0].files[0].name);
            } else {
                // ファイルサイズが制限以上
                alert('ファイルサイズは5MB以下にしてください'); // エラーメッセージを表示
                $(this).parent().children(".custom-file-label").html("署名済み承諾書写真画像を添付してください");
                $(".custom-file-input").val("");
            }
        });
        //ファイルの取消
        $(".reset").click(function() {
            $(this).parent().prev().children(".custom-file-label").html("ファイル添付不要です");
            $(".custom-file-input").val("");
        });

    </script>
</body>

</html>
