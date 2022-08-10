var contentName = "transaksi";
var basedApi = BASE_URL + `api/transaksi`;
var formAdd = $("#form-addtrans-" + contentName);
var formEdit = $("#form-edit-" + contentName);
var modalAdd = $("#modal-add-" + contentName);
var modalEdit = $("#modal-edit-" + contentName);
var transTgl = formAdd.find(".trans-tgl").val(moment().format("YYYY-MM-DD"));
var addSparepartSel = formAdd.find(".add-sparepart");
var delSparepartSel = formAdd.find(".remove-sparepart");
let fetchSparepart;

addSparepartSel.on("click", addSparepart);
delSparepartSel.on("click", removeSparepart);

formEdit.on("submit", function (e) {
	e.preventDefault();
	var formValues = formEdit.serialize();
	var sendId = setEditId.val();
	console.log(formValues);
	$.post(basedApi + `/update/` + sendId, formValues, function (data) {
		var dataResult = JSON.parse(data);
		if (dataResult.statusCode == 200) {
			modalEdit.modal("hide");
			successMsg("Update Success");
			setTimeout(() => {
				formEdit.find("input").val("");
				thisTable.ajax.reload();
			}, 1000);
		} else if (dataResult.statusCode == 201) {
			alert("Error occured !");
		}
	});
});

formAdd.on("submit", function (e) {
	e.preventDefault();
	var formInputValues = formAdd.serialize();
	// console.log(formInputValues);
	var checked = formAdd.find(".check-service:checked").length > 0;
	if (!checked) {
		// alert("Please check at least one checkbox");
		Swal.fire({
			icon: "error",
			title: "Ops !",
			text: "Pilih Salah Satu Jasa Service",
			timer: 3000,
			showCancelButton: false,
			showConfirmButton: false,
			allowOutsideClick: false,
			allowEscapeKey: false,
		});
		return false;
	} else {
		$.post(basedApi + "/add", formInputValues, function (data) {
			var dataResult = JSON.parse(data);
			var dataRespId = dataResult.responseId;
			if (dataResult.statusCode == 200) {
				Swal.fire({
					title: "Loading",
					text: "Input Data Loading ...",
					timer: 2000,
					showCancelButton: false,
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false,
					didOpen: () => {
						Swal.showLoading();
					},
				}).then(() => {
					Swal.fire({
						icon: "success",
						title: "Input Berhasil",
						text: "Redirect",
						timer: 3000,
						showCancelButton: false,
						showConfirmButton: false,
						allowOutsideClick: false,
						allowEscapeKey: false,
					}).then(() => {
						window.location.href = BASE_URL + "transaksi/detail/" + dataRespId;
					});
				});
			} else if (dataResult.statusCode == 201) {
				alert("Error occured !");
			}
		});
	}
});

$.getJSON(BASE_URL + "api/montir", function (data) {
	var selectMontir = formAdd.find(".montir");
	$.each(data, function (index) {
		var thisData = data[index];
		var option = "";
		for (let i = 0; i < thisData.length; i++) {
			option += `<option value="${thisData[i].montir_id}">${thisData[i].montir_nm}</option>`;
		}
		selectMontir.append(option);
	});
});

$.getJSON(BASE_URL + "api/motor", function (data) {
	var selectMotor = formAdd.find(".motor");
	$.each(data, function (index) {
		var thisData2 = data[index];
		var option2 = "";
		for (let i = 0; i < thisData2.length; i++) {
			option2 += `<option value="${thisData2[i].motor_id}">${thisData2[i].motor_nm}</option>`;
		}
		selectMotor.append(option2);
		selectMotor.val(`${thisData2[0].motor_id}`);
	});
	selectMotor.select2({});
});

$.getJSON(BASE_URL + "api/service", function (data) {
	var loadService = formAdd.find(".load-service");
	var checkbox = "";
	checkbox += "<div class='row'>";
	$.each(data, function (index) {
		var thisData3 = data[index];
		for (let r = 0; r < thisData3.length; r++) {
			checkbox += "<div class='col-md-6'>";
			checkbox += `<label class="ckbox m-2">`;
			checkbox += `<input type="checkbox" name="chservice[]" class="check-service" value="${thisData3[r].service_id}"><span>${thisData3[r].service_nm}</span>`;
			checkbox += `</label>`;
			checkbox += `</div>`;
		}
	});
	checkbox += "</div>";
	loadService.append(checkbox);
});

function addSparepart() {
	var new_chq_no = parseInt($("#total_chq").val()) + 1;
	var noUrut = new_chq_no - 1;
	var optionSparepart = [];
	var getSparepartHarga = 0;
	var getSparepartNm, getSparepartCatNm, getSparepartId;
	var newInput = "";
	var getQty = 0;
	var getSub = 0;
	var getCount = 0;

	newInput += `<tr id='noUrut_${new_chq_no}'>`;
	newInput += `<td><div>${noUrut}</div></td>`;
	newInput += `<td class="wd-10p"><select class='form-control' style="width: 75%" name='id_sparepart[]' id='new_${new_chq_no}'></select></td>`;
	newInput += `<td>`;
	newInput += `<input type="hidden" class='form-control w-5'  id='nama_${new_chq_no}' name='nmspr[]'>`;
	newInput += `<input type="hidden" class='form-control w-5'  id='harga_${new_chq_no}' name='hrg[]'>`;
	newInput += `<input type="text"  disabled class='form-control w-5'  id='harga_text_${new_chq_no}'>`;
	newInput += `</td>`;
	newInput += `<td><input type="number" min="0" class='form-control w-5' id='qty_${new_chq_no}' value="1" name='qty[]'></td>`;
	newInput += `<td>`;
	newInput += `<input type="hidden" class='form-control w-5' id='subtotal_${new_chq_no}' name='subtotal[]'>`;
	newInput += `<input type="text"  disabled class='form-control w-5' id='subtotal_text_${new_chq_no}'>`;
	newInput += `</td>`;
	newInput += `</tr>`;

	$("#new_chq").append(newInput);
	var idSpareParts = "";
	$.getJSON(BASE_URL + "api/spart-prod/ready-stock", function (response) {
		fetchSparepart = response.data;
		optionSparepart += `<option>--- PILIH SPAREPART ---</option>`;
		for (let x = 0; x < fetchSparepart.length; x++) {
			getSparepartNm = fetchSparepart[x].sparepart_prod_nm;
			getSparepartId = fetchSparepart[x].sparepart_prod_id;
			getSparepartCatNm = fetchSparepart[x].sparepart_cat_nm;
			getSparepartHarga = fetchSparepart[x].sparepart_prod_hrg;
			optionSparepart += `<option value="${getSparepartId}">( <span class="mr-2 font-weight-bold">${getSparepartCatNm}</span> ) ${getSparepartNm}</option>`;
		}
		$("#new_" + new_chq_no).append(optionSparepart);
		$("#new_" + new_chq_no).select2({ width: "resolve" });
		$("#new_" + new_chq_no).on("change", function (e) {
			e.preventDefault();
			$.getJSON(
				BASE_URL + "api/spart-prod/show/" + this.value,
				function (response) {
					$("#nama_" + new_chq_no).val(response.data[0].sparepart_prod_nm);
					$("#harga_" + new_chq_no).val(response.data[0].sparepart_prod_hrg);
					changeSubtotal();
				}
			);
		});

		$("#qty_" + new_chq_no).on("change", function (e) {
			changeSubtotal();
		});

		function changeSubtotal() {
			getQty = $("#qty_" + new_chq_no).val();
			getSub = $("#harga_" + new_chq_no).val();
			getCount = getQty * getSub;
			$("#subtotal_" + new_chq_no).val(getCount);
			$("#harga_text_" + new_chq_no).val(getSub);
			$("#subtotal_text_" + new_chq_no).val(getCount);
		}
		// $("#subtotal_text_" + new_chq_no).append(formatRupiah(getCount, "Rp. "));
	});
	$("#total_chq").val(new_chq_no);
}

function removeSparepart() {
	var last_chq_no = $("#total_chq").val();
	if (last_chq_no > 1) {
		$("#noUrut_" + last_chq_no).remove();
		$("#new_" + last_chq_no).remove();
		$("#total_chq").val(last_chq_no - 1);
	}
}

// function uid() {
// 	var uuid = "";
// 	var plusDay = "";
// 	var result = "";
// 	for (var i = 0; i < 3; i++)
// 		uuid += Math.floor(Math.random() * 16)
// 			.toString(16)
// 			.toUpperCase();

// 	plusDay = moment().format("YYYYMDDHs");
// 	result = plusDay + uuid;
// 	setupTransId.val(result);
// }

// uid();
