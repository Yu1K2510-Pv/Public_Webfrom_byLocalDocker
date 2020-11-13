var validate = function() {

	var flag = true;

	//Validation表示クリア
	 $("*").removeClass("is-invalid");
	 $(".invalid-feedback").remove();
	
	removeElementsByClass("error");
	removeClass("error-form");

	// お名前の入力をチェック
	if(document.form.name.value == ""){
		errorElement(document.form.name, "お名前が入力されていません");
		flag = false;
	}
	// 診察券番号（患者ID）の入力をチェック
	if(document.form.patientid.value == ""){
		errorElement(document.form.patientid, "診察券番号が入力されていません");
		flag = false;
	} else {
		if(!validatePatientID(document.form.patientid.value)){
			errorElement(document.form.patientid, "数字と-(ハイフン)のみ最大９桁まで入力してください")
		}
	}

	// 診療科の入力をチェック
	if(document.form.section.value == 0){
		errorElement(document.form.section, "診療科が入力されていません");
		flag = false;
	}

	// 電話番号の入力をチェック
	if(document.form.tel.value == ""){
		errorElement(document.form.tel, "電話番号が入力されていません");
		flag = false;
	} else {
		// 電話番号の形式をチェック
		if(!validateNumber(document.form.tel.value)){
			errorElement(document.form.tel, "半角数字のみを入力してください");
			flag = false;
		} else {
			if(!validateTel(document.form.tel.value)){
				errorElement(document.form.tel, "電話番号が正しくありません");
				flag = false;
			}
		}
	}

	// メールアドレスの入力をチェック
	if(document.form.email.value == ""){
		errorElement(document.form.email, "メールアドレスが入力されていません");
		flag = false;
	} else {
		// メールアドレスの形式をチェック
		if(!validateMail(document.form.email.value)){
			errorElement(document.form.email, "メールアドレスが正しくありません");
			flag = false;
		}
	}
	//新規予約以外
	if(document.form.request_type.value !== "新規予約"){
		// 受付済み診察予約日の入力をチェック
		var userAgent = window.navigator.userAgent;
		//IE11（IE6～10は例外)はradioのvalueが普通に取得できない（参考→http://blog.netandfield.com/shar/2015/09/internetexplorer-2.html）
		//"trident"はIE11を指す（参考→https://qiita.com/sakuraya/items/33f93e19438d0694a91d)
		if(userAgent.indexOf("trident") >= 1){
			var flg_request_type = document.form.elements[request_type];
			for(var i=0; i < flg_request_type.length; i++){
				if(flg_request_type[i].checked == true){
					if(flg_request_type[i].value != window.document.form.elements[request_type_value_forie11trident].value){
						document.form.request_type_value_forie11trident.value = flg_request_type[i].value;
					}
				}
			}
		} else { //IE11（IE6～10は例外）以外のブラウザによるradioのvalue判定
			if(document.form.request_type.value !== "新規予約"){
				if(document.form.ReservedDate.value == ""){
					errorElement(document.form.ReservedDate, "受付済み診察予約日が入力されていません");
					flag = false;
				}
			}
		}
	}

	if(document.form.request_type.value !== "予約キャンセル"){
		// 第一希望予約日の入力をチェック
		if(document.form.Reservation1.value == ""){
			errorElement(document.form.Reservation1, "第一希望予約日が入力されていません");
			flag = false;
		} else {
			// 日付の形式チェック
			if(!validateDate(document.form.Reservation1.value)){
				errorElement(document.form.Reservation1, "YYYY/MM/DDの形式で日付を入力してください");
				flag = false;
			} else {
				// 予約日付が入力日より７日後以降の日付が入力されているかチェック
				if(!validateResavationDate(document.form.Reservation1.value)){
					errorElement(document.form.Reservation1, "予約希望日は入力日から７日後以降の日付を入力してください");
				}
			}
		}

		// 第二希望予約日の入力をチェック
		if(document.form.Reservation2.value == ""){
			errorElement(document.form.Reservation2, "第二希望予約日が入力されていません");
			flag = false;
		} else {
			// 日付の形式チェック
			if(!validateDate(document.form.Reservation2.value)){
				errorElement(document.form.Reservation2, "YYYY/MM/DDの形式で日付を入力してください");
				flag = false;
			} else {
				// 予約日付が入力日より７日後以降の日付が入力されているかチェック
				if(!validateResavationDate(document.form.Reservation2.value)){
					errorElement(document.form.Reservation2, "予約希望日は入力日から７日後以降の日付を入力してください");
				}
			}
		}

		// 第三希望予約日の入力をチェック
		if(document.form.Reservation3.value == ""){
			errorElement(document.form.Reservation3, "第三希望予約日が入力されていません");
			flag = false;
		}  else {
			// 日付の形式チェック
			if(!validateDate(document.form.Reservation3.value)){
				errorElement(document.form.Reservation3, "YYYY/MM/DDの形式で日付を入力してください");
				flag = false;
			} else {
				// 予約日付が入力日より７日後以降の日付が入力されているかチェック
				if(!validateResavationDate(document.form.Reservation3.value)){
					errorElement(document.form.Reservation3, "予約希望日は入力日から７日後以降の日付を入力してください");
				}
			}
		}
	}
	// 予約変更ポリシーへの同意の入力をチェック
	if(document.form.policy.checked == false){
		errorElement(document.form.policy, "予約調整のポリシーへの同意が選択されていません");
		flag = false;
	}

	// 個人情報の取り扱いの同意の入力をチェック
	if(document.form.check.checked == false){
		errorElement(document.form.check, "個人情報の取り扱いの同意が選択されていません");
		flag = false;
	}
	return flag;
}


/*
var errorElement = function(form, msg) {
	form.className = "error-form";
	var newElement = document.createElement("div");
	newElement.className = "error";
	var newText = document.createTextNode(msg);
	newElement.appendChild(newText);
	form.parentNode.insertBefore(newElement, form.nextSibling);
}
*/
var errorElement = function(form, msg) {
	//form.className = "is-invalid";
	form.classList.add("is-invalid");
	var newElement = document.createElement("div");
	newElement.className = "invalid-feedback";
	var newText = document.createTextNode(msg);
	newElement.appendChild(newText);
	var target_parent = form.parentNode;
	var target_children = target_parent.children;
	var f_exists_invalid_feedback = form.classList.contains("invalid-feedback");
	
	if(f_exists_invalid_feedback != true){
		form.parentNode.insertBefore(newElement, form.nextSibling);
	}
}
/*
var returntonomalElement = function(form) {
	var result = form.classList.contains("is-invalid");
	if (result == true){
		form.classList.remove("is-invalid");
	}
}
*/

var removeElementsByClass = function(className){
	var elements = document.getElementsByClassName(className);
	while (elements.length > 0){ 
		elements[0].parentNode.removeChild(elements[0]);
	}
}


var removeClass = function(className){
	var elements = document.getElementsByClassName(className);
	while (elements.length > 0) {
		elements[0].className = "";
	}
}


var validateMail = function (val){
	if (val.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)==null) {
		return false;
	} else {
		return true;
	}
}


var validateNumber = function (val){
	if (val.match(/[^0-9]+/)) {
		return false;
	} else {
		return true;
	}
}


var validateTel = function (val){
	if (val.match(/^[0-9-]{6,13}$/) == null) {
		return false;
	} else {
		return true;
	}
}


var validateKana = function (val){
	if (val.match(/^[ぁ-ん]+$/) == null) {
		return false;
	} else {
		return true;
	}
}


var validateDate = function (val){
	// フォーマット（YYYY/MM/DD）チェック
    if (!val.match(/^\d{4}\/\d{2}\/\d{2}$/)) {
        return false;
     }
     var yyyy = val.substr(0, 4);
     var mm = val.substr(5, 2) - 1; //1月は0から始まる為 -1 する。
     var dd = val.substr(8, 2);

     // 月,日の妥当性チェック
    if (mm >= 0 && mm <= 11 && dd >= 1 && dd <= 31) {

        var vDt = new Date(yyyy, mm, dd);

        if (isNaN(vDt)) {
            return false;
        } else if(vDt.getFullYear() == yyyy && vDt.getMonth() == mm && vDt.getDate() == dd) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

var validateResavationDate = function (val){
	//予約候補日が現在日付から７日後以降かをチェック
	var today = new Date();
	var today = new Date(today.getFullYear(), today.getMonth(), today.getDate());
	var plus7daysdate = new Date(today.setDate(today.getDate() + 7));

	var year = val.substr(0, 4);
	var month = val.substr(5, 2) - 1;
	var day = val.substr(8, 2);

	var checkdate = new Date(year, month, day);

	
	if (plus7daysdate <= checkdate){
		return true;
	} else {
		return false;
	}
}

var validatePatientID = function (val){
	if (val.match(/^[0-9-０-９－]{1,9}$/) == null) {
		return false;
	} else {
		return true;
	}
}

	document.getElementsByName("submit_button").onclick = function(){
	sessionStorage.clear();
}

/**
 * make_hidden : hiddenを作成する : Version 1.2
 */
function make_hidden(name, value, formname) {
    var q = document.createElement('input');
    q.type = 'hidden';
    q.name = name;
    q.value = value;
    if (formname) {
    	if ( document.forms[formname] == undefined ){
    		console.error( "ERROR: form " + formname + " is not exists." );
    	}
    	document.forms[formname].appendChild(q);
    } else {
    	document.forms[0].appendChild(q);
    }
}
