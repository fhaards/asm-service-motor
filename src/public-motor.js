var contentName = "motor";
var basedApi = BASE_URL + `api/motor`;

var formAdd = $("#form-add-" + contentName);
var formEdit = $("#form-edit-" + contentName);
var modalAdd = $("#modal-add-" + contentName);
var modalEdit = $("#modal-edit-" + contentName);
var setEditId = modalEdit.find(".this-id");

var thisTable = $("#table-" + contentName).DataTable({
	ajax: {
		url: basedApi,
	},
	columns: [
		{ data: "motor_id", name: "motor_id" },
		{ data: "motor_nm", name: "motor_nm" },
		{ data: "motor_merek", name: "motor_merek" },
		{ data: "", name: "" },
	],
	columnDefs: [
		{
			targets: 3,
			render: function (data, type, row, meta) {
				var getId = row.motor_id;
				var buttons = "";
				buttons += `<div class="d-flex justify-content-center" role="group">`;
				buttons += `<div class="btn-group" role="group">`;
				buttons += `<button class="btn rounded-10 pd-x-25 btn-outline-danger btn-icon deleteBtn" data-table="${contentName}" data-id="${getId}"><span class="bx bx-trash tx-15"></span></button>`;
				buttons += `<button class="btn rounded-10 pd-x-25 btn-dark btn-icon editBtn" data-toggle="modal" data-target="#modal-edit-${contentName}" data-id="${getId}"><span class="bx bx-edit tx-15"></span></button>`;
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
	var edit1 = modalEdit.find(".input-1");
	var edit2 = modalEdit.find(".input-2");
	var oldNm = modalEdit.find(".old_merek");

	$.getJSON(basedApi + "/show/" + editId, function (response) {
		edit1.val(response.data[0].motor_merek);
		edit2.val(response.data[0].motor_nm);
		oldNm.val(response.data[0].motor_merek);
		setEditId.val(editId);
	});
});

formEdit.on("submit", function (e) {
	e.preventDefault();
	var formValues = formEdit.serialize();
	var sendId = setEditId.val();
	$.post(basedApi + `/update/` + sendId, formValues, function (data) {
		var dataResult = JSON.parse(data);
		if (dataResult.statusCode == 200) {
			successMsg("Update Success");
			formEdit.find("input").val("");
			modalEdit.modal("hide");
			thisTable.ajax.reload();
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
			successMsg("Input Success");
			setTimeout(() => {
				formAdd.find("input").val("");
				modalAdd.modal("hide");
				thisTable.ajax.reload();
			}, 1000);
		} else if (dataResult.statusCode == 201) {
			alert("Error occured !");
		}
	});

	$.ajax({
		url: BASE_URL + "_logs/log_activity.json",
		type: "POST",
		data: { name: "hello" },
	});
});

// {
//     targets: 0,
//     render: function (data, type, row, meta) {
//         return meta.row + meta.settings._iDisplayStart + 1;
//     },
// },
// {
//     targets: 1,
//     render: function (data, type, row, meta) {
//         var nmLokasi = row.nm_lokasi;
//         if (nmLokasi.length > 20) {
//             var setNewNmLokasi = nmLokasi.substring(0, 30) + " ...";
//         } else {
//             var setNewNmLokasi = nmLokasi;
//         }

//         var detailUri = BASEURL + contentName + "/detail/" + row.id_lokasi;
//         var location = "";
//         location += `<a href="${detailUri}" class="" >${setNewNmLokasi}</a>`;
//         return location;
//     },
// },
// {
//     targets: 2,
//     render: function (data, type, row, meta) {
//         var alamat = row.alamat_lokasi;
//         if (alamat.length > 20) {
//             return alamat.substring(0, 30) + " ...";
//         } else {
//             return alamat;
//         }
//     },
// },
// {
//     targets: 5,
//     render: function (data, type, row, meta) {
//         var createdAt = new Date(row.created_at);
//         return moment(createdAt).format("YYYY / MM / DD -  h : mm");
//     },
// },
