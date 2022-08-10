function deleteIdGlobal(deleteId, deleteTable) {
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
			return (window.location.href =
				BASEURL + deleteTable + "/delete/" + deleteId);
		}
	});
}

function successMsg(succMessages) {
	swal.fire({
		icon: "success",
		text: succMessages,
		showConfirmButton: false,
		timer: 1500,
		allowOutsideClick: false,
		allowEscapeKey: false,
	});
}

function setLoader(loadPages, status = "") {
	var contentPages = $(loadPages).children();
	$(loadPages).addClass("loader");
	contentPages.hide();
	if (status !== "") {
		setTimeout(() => {
			$(loadPages).removeClass("loader");
			$(loadPages).append(
				`<div class='d-flex w-100 text-center justify-content-center'>${status}</div>`
			);
		}, 1000);
		contentPages.addClass("d-none");
	} else {
		setTimeout(() => {
			$(loadPages).removeClass("loader");
			contentPages.show();
		}, 1000);
	}
}

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

function clearPrint() {
	return location.reload(true);
}

function startPrint() {
	$(".az-header").hide();
	$(".az-content-title").hide();
	$(".az-content-breadcrumb").hide();
	$(".cetak-btn").hide();
}
