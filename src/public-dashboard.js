$(function () {
	"use strict";
	var basedApi = BASE_URL + `api/counter`;
	var dashTopCard = $("#dashboard-top-card");

	// STATISTIK
	var currentYear = moment().years();
	var setYear = currentYear;
	var dashStats = $("#dashboard-stats");
	var filterYear = dashStats.find(".get-year");
	var chartLines = $("#chartPendaptan");
	var getValMax = 0;

	loadYear();

	function setupMaximumValue(a) {
		var combineFirstChartLine = [];
		combineFirstChartLine = [...a];
		var getMax = Math.max(...combineFirstChartLine);
		for (let index = 0; index < combineFirstChartLine.length; index++) {
			if (combineFirstChartLine[index] === getMax) {
				getValMax = combineFirstChartLine[index] * 2;
			}
		}
		return getValMax;
	}

	// CHART JS LINE
	function loadChartLine(getYears = "") {
		var setupLabelName = [];
		var statsLine = [];

		if (getYears !== "") {
			setYear = getYears;
		}

		$.ajax({
			type: "ajax",
			url: BASE_URL + `api/statistik/transaksi/${setYear}`,
			async: true,
			dataType: "json",
			beforeSend: function (xhr) {
				setLoader($(".chart-js-line"), "");
			},
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					setupLabelName.push(data[i].bulan);
					statsLine.push(data[i].pendapatan);
				}

				var chart1Max = setupMaximumValue(statsLine);

				new Chart(chartLines, {
					type: "line",
					data: {
						labels: setupLabelName,
						datasets: [
							{
								label: "Total Pendapatan",
								data: statsLine,
								backgroundColor: "#dc2626",
								borderColor: "#dc2626",
								borderWidth: 1,
								fill: false,
							},
						],
					},
					options: {
						maintainAspectRatio: false,
						title: {
							display: true,
							position: "top",
							text: "Total Pendapatan Per Tahun",
							fontSize: 15,
							padding: 20,
							lineHeight: 3,
						},
						legend: {
							display: true,
							position: "bottom",
							labels: {
								fontColor: "#111827",
							},
						},
						tooltips: {
							mode: "index",
							intersect: false,
						},
						scales: {
							yAxes: [
								{
									ticks: {
										beginAtZero: true,
										fontSize: 10,
									},
								},
							],
							xAxes: [
								{
									ticks: {
										beginAtZero: true,
										fontSize: 11,
									},
								},
							],
						},
					},
				});
			},
			error: function (request, status, error) {
				setLoader($(".chart-js-line"), "Request API : " + request.statusText);
			},
		});
	}

	// CHANGE YEARS
	function loadYear() {
		var startOfYear = moment().subtract(10, "years");
		var endOfYear = moment().endOf("year");
		var years = [];
		var year = startOfYear;
		var optionYear = "";
		while (year <= endOfYear) {
			years.push(year.format("YYYY"));
			year = year.clone().add(1, "Y");
		}
		// optionYear += `<option value="${currentYear}">${currentYear}</option>`;
		$.each(years, function (key, value) {
			optionYear += `<option ${years[key] == value ? "selected" : ""}>${
				years[key]
			}</option>`;
		});
		filterYear.html(optionYear);
	}

	filterYear.on("change", function (e) {
		e.preventDefault();
		loadChartLine(this.value);
	});

	loadChartLine();

	$.getJSON(basedApi + "/dashboard", function (resp) {
		var countMotor = dashTopCard
			.find(".count-motor")
			.html(
				`<i class="fa fa-motorcycle text-warning mr-3 "></i> ${resp.count_motor}`
			);
		var countTransaksi = dashTopCard
			.find(".count_transaksi")
			.html(
				`<strong>Hasil dari </strong>( ${resp.count_transaksi}  Transaksi )`
			);

		var countTransAmount = dashTopCard
			.find(".count-transaksi-amount")
			.html(
				'<i class="fa fa-money-bill text-danger mr-3"></i>' +
					formatRupiah(resp.count_transaksi_amount, "Rp. ")
			);

		var countSparePartAmount = dashTopCard
			.find(".count-sparepart-amount")
			.html(
				'<i class="fa fa-cogs text-success mr-3"></i>' +
					formatRupiah(resp.count_sparepart_amount, "Rp. ")
			);

		var countSparepartQty = dashTopCard
			.find(".count_sparepart_qty")
			.html(`<strong>Terjual </strong>( ${resp.count_sparepart_qty}  Produk )`);

		var countMontir = dashTopCard
			.find(".count_montir")
			.html(
				`<i class="fa fa-user-cog text-primary mr-3"></i> ${resp.count_montir}`
			);
	});
});
