var contentName = "spart-prod";
var basedApi = BASE_URL + `api/spart-prod`;
var basedApi2 = BASE_URL + `api/spart-cat`;

var formAdd = $("#form-add-" + contentName);
var formEdit = $("#form-edit-" + contentName);
var modalAdd = $("#modal-add-" + contentName);
var selCat = modalAdd.find(".category");
var modalEdit = $("#modal-edit-" + contentName);
var setEditId = modalEdit.find(".this-id");
var selCatEdit = modalEdit.find(".category");

/** Reports */
var modalReport = $(`#modal-report-${contentName}`);
var getDateSpec = modalReport
	.find(".pilih-tanggal-spec")
	.val(moment().format("YYYY-MM-DD"));
var pilihBulan = modalReport.find(".pilih-bulan");
var pilihBulanBtn = modalReport.find(".pilih-bulan-btn");

/** FILTERING */
var filterData = $(`#filter-${contentName}`);
var setFilterCategory = filterData.find(".filter-category");
var setFilterStok = filterData.find(".filter-stok");
var setFIlterDates = filterData
	.find(".filter-date")
	.val(moment().format("YYYY-MM-DD"));
var clearFilterDates = filterData.find(".clear-dates");

var thisTable = $("#table-" + contentName).DataTable({
	ajax: {
		url: basedApi,
	},

	columns: [
		{ data: "sparepart_prod_id", name: "sparepart_prod_id" },
		{ data: "sparepart_prod_nm", name: "sparepart_prod_nm" },
		{ data: "sparepart_cat_nm", name: "sparepart_cat_nm" },
		{ data: "sparepart_prod_hrg", name: "sparepart_prod_hrg" },
		{ data: "sparepart_prod_stock", name: "sparepart_prod_stock" },
		{ data: "created_at", name: "created_at" },
		{ data: "sparepart_total_in", name: "sparepart_total_in" },
		{ data: "", name: "" },
	],
	columnDefs: [
		{
			targets: 0,
			render: function (data, type, row, meta) {
				var getStock = row.sparepart_prod_stock;
				var getIdStock = row.sparepart_prod_id;
				return getIdStock + getStock;
			},
		},
		{
			targets: 3,
			render: function (data, type, row, meta) {
				var getHrg = row.sparepart_prod_hrg;
				return formatRupiah(getHrg, "Rp. ");
			},
		},
		{
			targets: 4,
			render: function (data, type, row, meta) {
				var getStock = row.sparepart_prod_stock;
				var prodId = row.sparepart_prod_id;
				var classStock = "btn-success";
				if (getStock == 0) {
					var classStock = "btn-danger";
				}
				var formStock = "";
				var thisStock = `<span class="d-none">${getStock}</span>`;
				formStock += `<form id="form-edit-stock-">`;
				formStock += `<div class="btn-group" role="group">`;
				formStock += `<div><input type="text" class="form-control wd-50-f editStockInput-${prodId}" name="new_stock" value="${getStock}"></div>`;
				formStock += `<button type="submit" class="btn rounded-10 pd-x-25 ${classStock} btn-icon editStock" data-id="${prodId}"><i class="bx bx-refresh tx-15"></i></button>`;
				formStock += `</div>`;
				formStock += `</form>`;
				return thisStock + formStock;
			},
		},
		{
			targets: 5,
			render: function (data, type, row, meta) {
				var getTransTgl = new Date(row.created_at);
				var getTransUp = new Date(row.updated_at);
				var newGetTransUp;
				var hiddenDate = moment(getTransTgl).format("DD/MM/YYYY");
				var hiddenDateVal = `<span class='d-none'>${hiddenDate}</span>`;
				var newGetTransTgl = moment(getTransTgl)
					.locale("id")
					.format("DD-MM-YYYY, HH:mm");

				if (row.updated_at == null) {
					newGetTransUp = "-";
				} else {
					newGetTransUp = moment(getTransUp)
						.locale("id")
						.format("DD-MM-YYYY , HH:mm");
				}

				return `${hiddenDateVal} <div class=''>${newGetTransTgl} <br> Updated at : <br> ${newGetTransUp}</div>`;
				// return hiddenDateVal + " " + newGetTransTgl;
			},
		},
		{
			targets: 7,
			render: function (data, type, row, meta) {
				var disabled = "";
				var getId = row.sparepart_prod_id;
				var countP = row.sparepart_total_in;
				var buttons = "";
				buttons += `<div class="d-flex justify-content-center" role="group">`;
				buttons += `<div class="btn-group" role="group">`;
				if (countP > 0) {
					disabled = "disabled";
				}
				buttons += `<button class="btn rounded-10 pd-x-25 btn-outline-danger btn-icon deleteBtn" data-table="${contentName}" data-id="${getId}" ${disabled}><span class="bx bx-trash tx-15"></span></button>`;
				buttons += `<button class="btn rounded-10 pd-x-25 btn-dark btn-icon editBtn" data-toggle="modal" data-target="#modal-edit-${contentName}" data-id="${getId}"><span class="bx bx-edit tx-15"></span></button>`;
				buttons += `</div>`;
				buttons += `</div>`;
				return buttons;
			},
		},
	],
	pageLength: 10,
	responsive: true,
	order: [[4, "desc"]],
	language: {
		searchPlaceholder: "Search...",
		sSearch: "",
		lengthMenu: "_MENU_ items/page",
	},
	createdRow: function (row, data, dataIndex) {
		if (data.sparepart_prod_stock == "0") {
			$(row).addClass("bg-danger-light");
		}
	},
});

const filterCategory = () => {
	$.getJSON(basedApi2, function (response) {
		var optCat = "";
		var fetchSparepart = response.data;
		optCat += `<option value="All">-- Pilih Kategori -- </option>`;
		$.each(fetchSparepart, function (index, val) {
			optCat += `<option value="${fetchSparepart[index].sparepart_cat_nm}">${fetchSparepart[index].sparepart_cat_nm}</option>`;
		});
		setFilterCategory.append(optCat);
	});
	setFilterCategory.select2({});
	setFilterCategory.on("change", function (e) {
		e.preventDefault();
		var getValStatus = $(this).val();
		if (getValStatus === "All") {
			thisTable.columns(2).search("").draw();
		} else {
			thisTable.columns(2).search(getValStatus).draw();
		}
	});
};

filterCategory();

/** FILTERING RESULTS */
setFIlterDates.change(function (e) {
	e.preventDefault();
	var dateVal = this.value;
	var newDate = moment(dateVal).format("DD/MM/YYYY");
	thisTable.columns(5).search(newDate).draw();
});

// setFilterStok.change(function (e) {
// 	e.preventDefault();
// 	if (this.value === 0) {
// 		thisTable.columns(4).search(0).draw();
// 	} else {
// 		thisTable.columns(4).search("").draw();
// 	}
// });

clearFilterDates.on("click", function (e) {
	e.preventDefault();
	setFIlterDates.val("");
	thisTable.columns(3).search("").draw();
});

// DELETE STOCK
thisTable.on("click", ".editStock", function (e) {
	e.preventDefault();
	var stockId = $(this).data("id");
	var stockQty = thisTable.$(`.editStockInput-${stockId}`).val();
	// var formValues = thisTable.$(`.form-edit-stock-${stockId}`).serialize();
	$.post(
		basedApi + `/update-stock/` + stockId,
		{ new_stock: stockQty },
		function (data) {
			var dataResult = JSON.parse(data);
			if (dataResult.statusCode == 200) {
				successMsg("Update Success");
				setTimeout(() => {
					thisTable.ajax.reload();
				}, 1000);
			} else if (dataResult.statusCode == 201) {
				alert("Error occured !");
			}
		}
	);
	console.log(stockQty);
});

// DELETE
thisTable.on("click", ".deleteBtn", function (e) {
	e.preventDefault();
	var deleteId = $(this).data("id");
	Swal.fire({
		title: "Apakah anda yakin ?",
		text: "Data mungkin tidak akan kembali!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#ef4444",
		cancelButtonColor: "#cbd5e1",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: basedApi + "/delete/" + deleteId,
				type: "POST",
				cache: false,
				data: {
					id: deleteId,
				},
				success: function (dataResult) {
					var dataResult = JSON.parse(dataResult);
					if (dataResult.statusCode == 200) {
						successMsg("Deleted Success");
					}
					thisTable.ajax.reload();
				},
			});
		}
	});
});

// UPDATE
thisTable.on("click", ".editBtn", function (e) {
	e.preventDefault();
	var editId = $(this).data("id");
	var spanId = modalEdit.find(".span-id");
	var edit1 = modalEdit.find(".input-1");
	var edit2 = modalEdit.find(".input-2");
	var edit3 = modalEdit.find(".input-3");

	$.getJSON(basedApi + "/show/" + editId, function (response) {
		spanId.html(editId);
		edit1.val(response.data[0].sparepart_prod_nm);
		edit2.val(response.data[0].sparepart_prod_hrg);
		edit3.val(response.data[0].sparepart_prod_desc);
		setEditId.val(editId);
		return loadCategory(response.data[0].category);
	});
});

// UPDATE DATA
thisTable.on("click", ".editBtn", function (e) {
	e.preventDefault();
	var editId = $(this).data("id");
	var spanId = modalEdit.find(".span-id");
	var edit1 = modalEdit.find(".input-1");
	var edit2 = modalEdit.find(".input-2");
	var edit3 = modalEdit.find(".input-3");

	$.getJSON(basedApi + "/show/" + editId, function (response) {
		spanId.html(editId);
		edit1.val(response.data[0].sparepart_prod_nm);
		edit2.val(response.data[0].sparepart_prod_hrg);
		edit3.val(response.data[0].sparepart_prod_desc);
		setEditId.val(editId);
		return loadCategory(response.data[0].category);
	});
});

formEdit.on("submit", function (e) {
	e.preventDefault();
	var formValues = formEdit.serialize();
	var sendId = setEditId.val();
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
	var formValues = formAdd.serialize();
	$.post(basedApi + `/add`, formValues, function (data) {
		var dataResult = JSON.parse(data);
		if (dataResult.statusCode == 200) {
			modalAdd.modal("hide");
			successMsg("Update Success");
			setTimeout(() => {
				formAdd.find("input").val("");
				thisTable.ajax.reload();
			}, 1000);
		} else if (dataResult.statusCode == 201) {
			alert("Error occured !");
		}
	});
});

function loadCategory(getId = "") {
	$.getJSON(BASE_URL + "api/spart-cat", function (data) {
		$.each(data, function (index) {
			var thisData2 = data[index];
			var option2 = "";
			for (let x = 0; x < thisData2.length; x++) {
				option2 += `<option value="${thisData2[x].sparepart_cat_id}">${thisData2[x].sparepart_cat_nm}</option>`;
			}
			selCatEdit.html(option2);
		});
		selCatEdit.val(getId);
	});
}

$.getJSON(BASE_URL + "api/spart-cat", function (data) {
	$.each(data, function (index) {
		var thisData = data[index];
		var option = "";
		for (let i = 0; i < thisData.length; i++) {
			option += `<option value="${thisData[i].sparepart_cat_id}">${thisData[i].sparepart_cat_nm}</option>`;
		}
		selCat.append(option);
	});
});

function cetakTglSpec() {
	return window.open(
		BASE_URL + "reports/sparepart-by-date/" + getDateSpec.val(),
		"_blank"
	);
}
