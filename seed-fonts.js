	jQuery(document).ready(function () {

		// Set Url of JSON data from the facebook graph api. make sure callback is set with a '?' to overcome the cross domain problems with JSON

		var url = 'https://graph.facebook.com/' + encodeURIComponent(jQuery(location).attr('href'));

		// Use jQuery getJSON method to fetch the data from the url and then create our unordered list with the relevant data.

		jQuery.getJSON(url, function(json) {

			var fbcount = '';
			var fb_raw_count = '';

			if (typeof json.shares !== 'undefined')
				fb_raw_count = json.shares;

			if( fb_raw_count != '' ) {
				var fb_num_count = parseInt( fb_raw_count );

				if( fb_num_count < 1000 ) {
					fbcount = fb_num_count.toString();
				} else if( ( fb_num_count >= 1000 ) && ( fb_num_count < 10000 ) ) {
					if( (fb_num_count / 1000).toFixed( 1 ) % 1 === 0 ) {
						fbcount = (fb_num_count / 1000).toFixed().toString() + "k";
					} else {
						fbcount = (fb_num_count / 1000).toFixed( 1 ).toString() + "k";
					}
				} else if( fb_num_count >= 10000 ) {
					fbcount = (fb_num_count / 1000).toFixed().toString() + "k";
				}
			}

			// A little animation once fetched
			jQuery('.seed-social .facebook .count').animate( { opacity:0 }, 500 ,function(){
				jQuery('.seed-social .facebook .count').html(fbcount);
			});

			jQuery('.seed-social .facebook .count').animate( { opacity:1 }, 500);
		});

		var isMobile = false; //initiate as false

		// device detection
		if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

		if(!isMobile) {
			var winWidth = 560;
			var winHeight = 600;

			var winTop = (screen.height / 2) - (winHeight / 2);
			var winLeft = (screen.width / 2) - (winWidth / 2);

			jQuery('.seed-social a').click(function (event) {
				event.preventDefault();
				var url = jQuery(this).attr('href');

				window.open(url, 'social', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
			});
		} else {
			jQuery('.seed-social a').click(function (event) {
				if(jQuery(this).attr('href').indexOf('lineit') != -1) {
//					event.preventDefault();

					var url = 'http://line.me/R/msg/text/?LINE%20it%21%0d%0a'+ encodeURIComponent(jQuery(location).attr('href'));

					jQuery(this).attr('href', url);
				}
			});
		}
	});