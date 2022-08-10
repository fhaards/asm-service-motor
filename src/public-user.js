var contentName = "user";
var basedApi = BASE_URL + `api/user`;

var formAdd = $("#form-add-" + contentName);
var formEdit = $("#form-edit-" + contentName);
var modalAdd = $("#modal-add-" + contentName);
var modalEdit = $("#modal-edit-" + contentName);
var setEditId = modalEdit.find(".this-id");
var usernameValue = formAdd.find(".username");
var submitBtn = formAdd.find(`.btn-submit-${contentName}`);
var validateUser = formAdd.find(".validate-username");

// checkin email
submitBtn.prop("disabled", true);
var checkTimer, getEmail;

var thisTable = $("#table-" + contentName).DataTable({
	ajax: {
		url: basedApi,
	},
	columns: [
		{ data: "name", name: "name" },
		{ data: "username", name: "username" },
		{ data: "email", name: "email" },
		{ data: "level", name: "level" },
		{ data: "telp", name: "telp" },
		{ data: "alamat", name: "alamat" },
		{ data: "", name: "" },
	],
	columnDefs: [
		{
			targets: 3,
			render: function (data, type, row, meta) {
				var getLevel = row.level;
				var setNewLev = "";
				if (getLevel == "partman") {
					setNewLev = `<span class="badge badge-secondary">Partman</span>`;
				} else {
					setNewLev = `<span class="badge badge-success">Frontdesk</span>`;
				}

				return setNewLev;
			},
		},
		{
			targets: 4,
			render: function (data, type, row, meta) {
				var usrTelp = row.telp;
				var setNewTelp = "";
				if (usrTelp != null) {
					setNewTelp = usrTelp;
				} else {
					setNewTelp = " - ";
				}

				return setNewTelp;
			},
		},
		{
			targets: 5,
			render: function (data, type, row, meta) {
				var usrAlamat = row.alamat;
				var setNewAlamat = "";
				if (usrAlamat != null) {
					if (usrAlamat.length > 20) {
						setNewAlamat = usrAlamat.substring(0, 30) + " ...";
					} else {
						setNewAlamat = usrAlamat;
					}
				} else {
					setNewAlamat = " - ";
				}

				return setNewAlamat;
			},
		},
		{
			targets: 6,
			render: function (data, type, row, meta) {
				var getId = row.user_id;
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
	var oldPw = modalEdit.find(".old-pass");
	var edit1 = modalEdit.find(".input-1");
	var edit2 = modalEdit.find(".input-2");
	var edit3 = modalEdit.find(".input-3");
	var edit4 = modalEdit.find(".input-4");
	var edit5 = modalEdit.find(".input-5");
	var edit6 = modalEdit.find(".input-6");

	$.getJSON(basedApi + "/show/" + editId, function (response) {
		oldPw.val(response.data[0].password);
		edit1.val(response.data[0].name);
		edit2.val(response.data[0].telp);
		edit3.val(response.data[0].alamat);
		edit4.val(response.data[0].email);
		edit5.val(response.data[0].username);
		edit6.val(response.data[0].level);
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

function delay(callback, ms) {
	var timer = 0;
	return function () {
		var context = this,
			args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			callback.apply(context, args);
		}, ms || 0);
	};
}

usernameValue.keypress(function (e) {
	validateUser.html("Check username ....");
});

usernameValue.keyup(
	delay(function (e) {
		validateUser.html("Check username ....");
		checkUsername(this.value);
	}, 1000)
);

function checkUsername(parse) {
	if (parse.length < 1) {
		validateUser.html("");
		submitBtn.prop("disabled", true);
	} else {
		$.post(basedApi + "/check-username/", { username: parse }, function (data) {
			var dataResult = JSON.parse(data);
			if (dataResult.statusCode == 200) {
				validateUser.html(
					`<i class='fa fa-check text-success'></i> ${dataResult.msg}`
				);
				submitBtn.prop("disabled", false);
			} else {
				validateUser.html(
					`<i class='fa fa-close text-danger'></i> ${dataResult.msg}`
				);
				submitBtn.prop("disabled", true);
			}
		});
	}
}
