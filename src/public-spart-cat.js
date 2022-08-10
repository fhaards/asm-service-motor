var contentName = "spart-cat";
var basedApi = BASE_URL + `api/spart-cat`;

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
		{ data: "sparepart_cat_id", name: "sparepart_cat_id" },
		{ data: "sparepart_cat_code", name: "sparepart_cat_code" },
		{ data: "sparepart_cat_nm", name: "sparepart_cat_nm" },
		{ data: "sparepart_total", name: "sparepart_total" },
		{ data: "", name: "" },
	],
	columnDefs: [
		{
			targets: 4,
			render: function (data, type, row, meta) {
				var getId = row.sparepart_cat_id;
				var countP = row.sparepart_total;
				var buttons = "";
				buttons += `<div class="d-flex justify-content-center" role="group">`;
				buttons += `<div class="btn-group" role="group">`;
				if (countP < 1) {
					buttons += `<button class="btn rounded-10 pd-x-25 btn-outline-danger btn-icon deleteBtn" data-table="${contentName}" data-id="${getId}"><span class="bx bx-trash tx-15"></span></button>`;
				}
				buttons += `<button class="btn rounded-10 pd-x-25 btn-dark btn-icon editBtn" data-toggle="modal" data-target="#modal-edit-${contentName}" data-id="${getId}"><span class="bx bx-edit tx-15"></span></button>`;
				buttons += `</div>`;
				buttons += `</div>`;
				return buttons;
			},
		},
	],
	pageLength: 10,
	order: [[3, "asc"]],
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

	$.getJSON(basedApi + "/show/" + editId, function (response) {
		edit1.val(response.data[0].sparepart_cat_code);
		edit2.val(response.data[0].sparepart_cat_nm);
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
