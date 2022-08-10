var contentName = "penjualan";
var pageName = $("#detail-" + contentName);
var basedApi = BASE_URL + `api/penjualan`;
var thisId = pageName.find(".setup-id").val();
var tableSpart = pageName.find(".table-sparepart");
var dataService = [];
var dataSparepart = [];
var statusTrans;

$.getJSON(basedApi + "/show/" + thisId, function (resp) {
	// console.log(resp.data.data_service);
	statusTrans = resp.data.status;
	tipeTrans = resp.data.trans_tipe;
	var custName = pageName.find(".cust-nm").html(resp.data.cust_nm);
	var custTelp = pageName.find(".cust-tlp").html(resp.data.cust_tlp);
	var transId = pageName.find(".trans_id").html(resp.data.trans_id);
	var getTransTgl = new Date(resp.data.trans_tgl);
	var newGetTransTgl = moment(getTransTgl)
		.locale("id")
		.format("dddd , DD-MM-YYYY");
	var transTgl = pageName.find(".trans_tgl").html(newGetTransTgl);
	var transMont = pageName.find(".montir").html(resp.data.montir);

	if (statusTrans == "Completed") {
		var totalHarga = pageName
			.find(".total_harga")
			.html(formatRupiah(resp.data.total_harga, "Rp. "));
		var uangBayar = pageName
			.find(".uang_bayar")
			.html(formatRupiah(resp.data.uang_bayar, "Rp. "));
		var uangKembali = pageName
			.find(".uang_kembali")
			.html(formatRupiah(resp.data.uang_kembali, "Rp. "));
	}

	/** Data Sparepart */
	dataSparepart.push(resp.data.data_sparepart);
	$.each(dataSparepart, function (index) {
		var thisData2 = dataSparepart[index];
		var optionSpart = "";
		for (let i = 0; i < thisData2.length; i++) {
			optionSpart += `<tr>`;
			optionSpart += `<td class="wd-20p">${thisData2[i].sparepart_nm}</td>`;
			optionSpart += `<td class="wd-5p tx-center">${thisData2[i].sparepart_qty}</td>`;
			optionSpart +=
				`<td class="wd-10p tx-right">` +
				formatRupiah(thisData2[i].sparepart_hrg, "Rp. ") +
				`</td>`;
			optionSpart +=
				`<td class="wd-10p tx-right">` +
				formatRupiah(thisData2[i].sparepart_total_hrg, "Rp. ") +
				`</td>`;
			optionSpart += `</tr>`;
			// option += `<option value="${thisData[i].montir_id}">${thisData[i].montir_nm}</option>`;
		}
		tableSpart.append(optionSpart);
	});
});

function printThis() {
	window.print();
	$(".az-header").hide();
	$(".az-content-title").hide();
	$(".az-content-breadcrumb").hide();
	$(".top-headpages").hide();
	$(this).hide();
}
