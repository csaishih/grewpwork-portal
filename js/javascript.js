$(document).ready(function() {
	function resetpane1 () {
		$('#pane-user-mini-1').slideUp();
	}

	function resetpane2 () {
		$('#pane-bi-mini-1').slideUp();
		$('#pane-bi-mini-2').slideUp();
		$('#pane-bi-mini-3').slideUp();	
	}

	function resetpane3 () {
		$('#pane-movie-mini-1').slideUp();
		$('#pane-movie-mini-2').slideUp();
	}

	function resetpane4() {
		$('#pane-entity-mini-1').slideUp();
	}

	function showpane1() {
		$('#pane-user-mini-1').slideToggle();
	}

	function showpane2() {
		$('#pane-bi-mini-1').slideToggle();
		$('#pane-bi-mini-2').slideToggle();
		$('#pane-bi-mini-3').slideToggle();
	}

	function showpane3() {
		$('#pane-movie-mini-1').slideToggle();
		$('#pane-movie-mini-2').slideToggle();
	}

	function showpane4() {
		$('#pane-entity-mini-1').slideToggle();
	}

	resetpane2();
	resetpane3();
	resetpane4();

	$('.side .bigboss a').on('click', function(e) {
		var currentAttrValue = $(this).attr('href');
		$(this).parent('li').addClass('active').siblings().removeClass('active').removeClass('show');
		if (currentAttrValue == '#pane1') {
			resetpane2();
			resetpane3();
			resetpane4();
			$('#pane-user-mini-1').parent('li').addClass('show');
			showpane1();
		}
		else if (currentAttrValue == '#pane2') {
			resetpane1();
			resetpane3();
			resetpane4();
			$('#pane-bi-mini-1').parent('li').addClass('show');
			$('#pane-bi-mini-2').parent('li').addClass('show');
			$('#pane-bi-mini-3').parent('li').addClass('show');
			showpane2();
		}
		else if (currentAttrValue == '#pane3') {
			resetpane1();
			resetpane2();
			resetpane4();
			$('#pane-movie-mini-1').parent('li').addClass('show');
			$('#pane-movie-mini-2').parent('li').addClass('show');
			showpane3();
		}
		else if (currentAttrValue == '#pane4') {
			resetpane1();
			resetpane2();
			resetpane3();
			$('#pane-entity-mini-1').parent('li').addClass('show');
			showpane4();
		}
		e.preventDefault();
	})

	$('.side .miniboss a').on('click', function(e) {
		var currentAttrValue = $(this).attr('href');
		$(this).parent('li').addClass('mini-active').siblings().removeClass('mini-active');
		if (currentAttrValue == '#pane1-content1') {
			$('#pane1-content1').parent('li').siblings().removeClass('active');
			$('#pane1-content1').parent('li').addClass('active');

		}
		else if (currentAttrValue == '#pane2-content1') {
			$('#pane2-content1').parent('li').siblings().removeClass('active');
			$('#pane2-content1').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane2-content2') {
			$('#pane2-content2').parent('li').siblings().removeClass('active');
			$('#pane2-content2').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane2-content3') {
			$('#pane2-content3').parent('li').siblings().removeClass('active');
			$('#pane2-content3').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane3-content1') {
			$('#pane3-content1').parent('li').siblings().removeClass('active');
			$('#pane3-content1').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane3-content2') {
			$('#pane3-content2').parent('li').siblings().removeClass('active');
			$('#pane3-content2').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane4-content1') {
			$('#pane4-content1').parent('li').siblings().removeClass('active');
			$('#pane4-content1').parent('li').addClass('active');
		}
	})

	$("#pane1-content1").load('Visualizations/user_stats_vs_time/user_stats_vs_time.html');
	$("#pane2-content1").load('Visualizations/BI_n_req_pur_VS_time/BI_n_req_pur_VS_time.html');
	$("#pane2-content2").load('Visualizations/BI_avg_VS_time/BI_avg_VS_time.html');
	$("#pane2-content3").load('Visualizations/BI_rev_VS_time/BI_rev_VS_time.html');
	$("#pane3-content1").load('Visualizations/tweet_tally_vs_time/tweet_tally_vs_time.html');
	$("#pane3-content2").load('Visualizations/average_sentiment_vs_time/average_sentiment_vs_time.html');
	$("#pane4-content1").load('Visualizations/bubble_cloud/bubble_cloud.html');
})