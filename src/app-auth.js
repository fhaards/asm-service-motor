$("#login-form").on("submit", function (e) {
	e.preventDefault();
	var username = $("#username").val();
	var password = $("#password").val();

	if (username.length == "") {
		Swal.fire({
			position: "top-end",
			type: "warning",
			title: "Oops...",
			text: "username Wajib Diisi !",
		});
	} else if (password.length == "") {
		Swal.fire({
			position: "top-end",
			type: "warning",
			title: "Oops...",
			text: "Password Wajib Diisi !",
		});
	} else {
		$.ajax({
			url: BASE_URL + "auth/validation",
			type: "POST",
			data: {
				username: username,
				password: password,
			},
			success: function (response) {
				Swal.fire({
					position: "top-end",
					title: "Validasi",
					text: "Validasi Data",
					timer: 2000,
					showCancelButton: false,
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false,
					didOpen: () => {
						Swal.showLoading();
					},
				}).then(() => {
					if (response == "success") {
						Swal.fire({
							position: "top-end",
							icon: "success",
							title: "Login Berhasil!",
							text: "Redirect",
							timer: 3000,
							showCancelButton: false,
							showConfirmButton: false,
							allowOutsideClick: false,
							allowEscapeKey: false,
						}).then(() => {
							window.location.href = BASE_URL + "dashboard";
						});
					} else {
						Swal.fire({
							position: "top-end",
							icon: "error",
							title: "Login Gagal!",
							text: "Username atau Password Salah",
						});
					}
				});
			},

			error: function (response) {
				Swal.fire({
					position: "top-end",
					icon: "error",
					title: "Opps!",
					text: response,
				});
			},
		});
	}
});
