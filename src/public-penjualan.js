var contentName = "penjualan";
var basedApi = BASE_URL + `api/penjualan`;

/** Reports */
var modalReport = $(`#modal-report-${contentName}`);
var getDateSpec = modalReport
	.find(".pilih-tanggal-spec")
	.val(moment().format("YYYY-MM-DD"));
var pilihBulan = modalReport.find(".pilih-bulan");
var pilihBulanBtn = modalReport.find(".pilih-bulan-btn");

/** Change Status */
var modalStatus = $(`#modal-status-${contentName}`);
var formStatus = $("#form-status-" + contentName);
var setEditId = formStatus.find(".this-id");

/** FILTERING */
var filterData = $(`#filter-${contentName}`);
var setFilterStatus = filterData.find(".filter-status");
var setFilterTotal = filterData.find(".filter-total");
var setFIlterDates = filterData
	.find(".filter-date")
	.val(moment().format("YYYY-MM-DD"));

cetakPilihBulan();

var thisTable = $("#table-" + contentName).DataTable({
	ajax: {
		url: basedApi + "/show",
	},
	columns: [
		{ data: "trans_id", name: "trans_id" },
		{ data: "trans_tgl", name: "trans_tgl" },
		{ data: "cust_nm", name: "cust_nm" },
		{ data: "cust_tlp", name: "cust_tlp" },
		{ data: "total_harga", name: "total_harga" },
		{ data: "status", name: "status" },
		{ data: "", name: "" },
	],
	columnDefs: [
		{
			targets: 1,
			render: function (data, type, row, meta) {
				var getTransTgl = new Date(row.trans_tgl);
				var hiddenDate = moment(getTransTgl).format("DD/MM/YYYY");
				var hiddenDateVal = `<span class='d-none'>${hiddenDate}</span>`;
				var newGetTransTgl = moment(getTransTgl)
					.locale("id")
					.format("dddd , DD-MM-YYYY");
				return hiddenDateVal + " " + newGetTransTgl;
			},
		},
		{
			targets: 2,
			render: function (data, type, row, meta) {
				var custName = row.cust_nm;
				if (custName.length > 20) {
					var setNewCustName = custName.substring(0, 30) + " ...";
				} else {
					var setNewCustName = custName;
				}
				return setNewCustName;
			},
		},
		{
			targets: 4,
			render: function (data, type, row, meta) {
				var getHrg = row.total_harga;
				return formatRupiah(getHrg, "Rp. ");
			},
		},
		{
			targets: 5,
			render: function (data, type, row, meta) {
				var getStatus = row.status;
				var setNewStatus = "";
				if (getStatus == "Pending") {
					setNewStatus = `<span class="badge badge-primary"><span class="bx bx-time mr-1"></span> ${getStatus} </span>`;
				} else {
					setNewStatus = `<span class="badge badge-success"><span class="bx bx-check mr-1"></span> ${getStatus} </span>`;
				}

				return setNewStatus;
			},
		},
		{
			targets: 6,
			render: function (data, type, row, meta) {
				var getId = row.trans_id;
				var getType = row.trans_tipe;
				var buttons = "";
				buttons += `<div class="d-flex justify-content-center" role="group">`;
				buttons += `<div class="btn-group" role="group">`;
				if (row.status == "Pending") {
					buttons += `<button class="btn rounded-10 p-1  btn-success btn-icon text-white changeStatusBtn" data-toggle="modal" data-target="#modal-status-${contentName}" data-id="${getId}"><span class="bx bx-refresh tx-15"></span></button>`;
					buttons += `<button class="btn rounded-10 p-1  btn-outline-danger btn-icon deleteBtn" data-table="${contentName}" data-id="${getId}"><span class="bx bx-trash tx-15"></span></button>`;
				} else {
					buttons += `<button class="btn rounded-10 p-1 btn-dark btn-icon text-white detailBtn" data-tipe="${getType}" data-id="${getId}"><span class="bx bx-detail tx-15"></span></button>`;
				}
				// buttons += `<button class="btn rounded-10 pd-x-25 btn-dark btn-icon text-white reportsBtn" data-id="${getId}"><span class="bx bx-printer tx-15"></span></button>`;

				buttons += `</div>`;
				buttons += `</div>`;
				return buttons;
			},
		},
	],
	pageLength: 10,
	responsive: true,
	language: {
		searchPlaceholder: "Search...",
		sSearch: "",
		lengthMenu: "_MENU_ items/page",
	},
	order: [[5, "desc"]],
	createdRow: function (row, data, dataIndex) {
		if (data.status == "Pending") {
			$(row).addClass("bg-primary-light");
		} else {
			$(row).addClass("bg-success-light");
		}
	},
});

/** FILTERING RESULTS */
setFIlterDates.change(function (e) {
	e.preventDefault();
	var dateVal = this.value;
	var newDate = moment(dateVal).format("DD/MM/YYYY");
	thisTable.columns(1).search(newDate).draw();
});

function clearDates() {
	setFIlterDates.val("");
	return thisTable.columns(1).search("").draw();
}

setFilterStatus.change(function (e) {
	e.preventDefault();
	var getValStatus = $(this).val();
	if (getValStatus === "All") {
		thisTable.columns(5).search("").draw();
	} else {
		thisTable.columns(5).search(getValStatus).draw();
	}
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

// PEMBAYARAN
thisTable.on("click", ".changeStatusBtn", function (e) {
	e.preventDefault();
	var editId = $(this).data("id");
	var edit1 = formStatus.find(".total_harga");
	var uangBayar = formStatus.find(".uang_bayar");
	var edit1Display = formStatus.find(".total_harga_display");
	var transIDisplay = formStatus.find(".trans_id_display");
	var nominal = 0;

	$.getJSON(basedApi + "/show/" + editId, function (response) {
		nominal = response.data.total_harga;
		edit1.val(nominal);
		uangBayar.val(nominal);
		uangBayar.attr("min", nominal);
		edit1Display.html(formatRupiah(nominal, "Rp. "));
		transIDisplay.html(response.data.trans_id);
		setEditId.val(editId);
	});
});

formStatus.on("submit", function (e) {
	e.preventDefault();
	var formValues = formStatus.serialize();
	var sendId = setEditId.val();

	Swal.fire({
		title: "Apakah anda yakin ?",
		text: "Status penjualan tidak dapat diubah kembali",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#ef4444",
		cancelButtonColor: "#cbd5e1",
		confirmButtonText: "Bayar",
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				basedApi + `/update-status/` + sendId,
				formValues,
				function (data) {
					var dataResult = JSON.parse(data);
					if (dataResult.statusCode == 200) {
						modalStatus.modal("hide");
						successMsg("Update Success");
						setTimeout(() => {
							formStatus.find("input").val("");
							thisTable.ajax.reload();
						}, 1000);
					} else if (dataResult.statusCode == 201) {
						alert("Error occured !");
					}
				}
			);
		}
	});
});

// DETAIL
thisTable.on("click", ".detailBtn", function (e) {
	e.preventDefault();
	var editId = $(this).data("id");
	var tipeId = $(this).data("tipe");
	if (tipeId == "3") {
		return (window.location.href = BASE_URL + "penjualan/detail/" + editId);
	} else {
		return (window.location.href = BASE_URL + "transaksi/detail/" + editId);
	}
});

function cetakTglSpec() {
	return window.open(
		BASE_URL + "reports/penjualan-by-date/" + getDateSpec.val(),
		"_blank"
	);
}

function cetakPilihBulan() {
	var getMonths = moment.months();
	var optBulan = "";
	for (let gm = 0; gm < getMonths.length; gm++) {
		const valMonth = getMonths[gm];
		var getMonthNumber = moment().month(valMonth).format("M");
		optBulan += `<option value='${getMonthNumber}'>${valMonth}</option>`;
		// console.log(getMonthNumber);
	}
	pilihBulan.append(optBulan);
	pilihBulanBtn.on("click", function () {
		return window.open(
			BASE_URL + "reports/penjualan-by-month/" + pilihBulan.val(),
			"_blank"
		);
	});
}
