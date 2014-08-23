$(document).ready(function() {
	$('.side a').on('click', function(e)  {
		var currentAttrValue = $(this).attr('href');

		if (currentAttrValue == '#pane1') {
			$('#pane1-content1').parent('li').siblings().removeClass('active');
			$('#pane1-content1').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane2') {
			$('#pane2-content1').parent('li').siblings().removeClass('active');
			$('#pane2-content1').parent('li').addClass('active');
			$('#pane2-content2').parent('li').addClass('active');
			$('#pane2-content3').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane3') {
			$('#pane3-content1').parent('li').siblings().removeClass('active');
			$('#pane3-content1').parent('li').addClass('active');
			$('#pane3-content2').parent('li').addClass('active');
		}
		else if (currentAttrValue == '#pane4') {
			$('#pane4-content1').parent('li').siblings().removeClass('active');
			$('#pane4-content1').parent('li').addClass('active');
		}

		e.preventDefault();
	})

	$("#pane1-content1").load('Visualizations/user_stats_vs_time/user_stats_vs_time.html');
	$("#pane2-content1").load('Visualizations/BI_n_req_pur_VS_time/BI_n_req_pur_VS_time.html');
	$("#pane2-content2").load('Visualizations/BI_avg_VS_time/BI_avg_VS_time.html');
	$("#pane2-content3").load('Visualizations/BI_rev_VS_time/BI_rev_VS_time.html');
	$("#pane3-content1").load('Visualizations/tweet_tally_vs_time/tweet_tally_vs_time.html');
	$("#pane3-content2").load('Visualizations/average_sentiment_vs_time/average_sentiment_vs_time.html');
})