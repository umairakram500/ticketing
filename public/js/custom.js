/* Vertical Responsive Menu */
'use strict';
var tid = setInterval( function () {
	if ( document.readyState !== 'complete' ) return;
	clearInterval( tid );
	var querySelector = document.querySelector.bind(document);
	var nav = document.querySelector('.vertical-nav');

	// Minify menu on menu_minifier click
	querySelector('.collapse-menu').onclick = function () {
		nav.classList.toggle('vertical-nav-sm');
		$('.dashboard-wrapper').toggleClass(('dashboard-wrapper-lg'), 200);
		$('footer').toggleClass(('footer-sm'), 200);
		$("i", this).toggleClass("icon-menu2 icon-cross2");
		checkCookie('sidebar_sm');

	};

	// Toggle menu click
	querySelector('.toggle-menu').onclick = function () {
		nav.classList.toggle('vertical-nav-opened');
	};

}, 1000 );

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	console.log('Set Cookie');
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	console.log('get Cookie');
	return "";

}

function delCookie(cname){
	document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function checkCookie(cname) {
	var user = getCookie(cname);
	console.log('check Cookie');
	if (user != "") {
		delCookie('sidebar_sm');
	} else {
		setCookie('sidebar_sm', 'sidebar_sm', 365);
	}
}

// Sidebar Dropdown Menu
$(function () {
	$('.vertical-nav').metisMenu();
});

(function ($, window, document, undefined) {

	var pluginName = "metisMenu",
	defaults = {
		toggle: true
	};

	function Plugin(element, options) {
		this.element = element;
		this.settings = $.extend({}, defaults, options);
		this._defaults = defaults;
		this._name = pluginName;
		this.init();
	}

	Plugin.prototype = {
		init: function () {
			var $this = $(this.element),
			$toggle = this.settings.toggle;

			$this.find('li.active').has('ul').children('ul').addClass('collapse in');
			$this.find('li').not('.active').has('ul').children('ul').addClass('collapse');

			$this.find('li').has('ul').children('a').on('click', function (e) {
				e.preventDefault();

				$(this).parent('li').toggleClass('active').children('ul').collapse('toggle');

				if ($toggle) {
					$(this).parent('li').siblings().removeClass('active').children('ul.in').collapse('hide');
				}
			});
		}
	};

	$.fn[ pluginName ] = function (options) {
		return this.each(function () {
			if (!$.data(this, "plugin_" + pluginName)) {
				$.data(this, "plugin_" + pluginName, new Plugin(this, options));
			}
		});
	};

})(jQuery, window, document);


// scrollUp full options
$(function () {
	$.scrollUp({
		scrollName: 'scrollUp', // Element ID
		scrollDistance: 180, // Distance from top/bottom before showing element (px)
		scrollFrom: 'top', // 'top' or 'bottom'
		scrollSpeed: 300, // Speed back to top (ms)
		easingType: 'linear', // Scroll to top easing (see http://easings.net/)
		animation: 'fade', // Fade, slide, none
		animationSpeed: 200, // Animation in speed (ms)
		scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
		//scrollTarget: false, // Set a custom target element for scrolling to the top
		scrollText: '<i class="icon-rocket"></i>', // Text for element, can contain HTML // Text for element, can contain HTML
		scrollTitle: false, // Set a custom <a> title if required.
		scrollImg: false, // Set true to use image
		activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		zIndex: 2147483647 // Z-Index for the overlay
	});
});

// Material Button
var element, circle, d, x, y;
$(".btn").click(function(e) {
	element = $(this);
	if(element.find(".circless").length == 0)
	element.prepend("<span class='circless'></span>");
	circle = element.find(".circless");
	circle.removeClass("animate");
	if(!circle.height() && !circle.width())
	{
		d = Math.max(element.outerWidth(), element.outerHeight());
		circle.css({height: d, width: d});
	}
	x = e.pageX - element.offset().left - circle.width()/2;
	y = e.pageY - element.offset().top - circle.height()/2;
	
	circle.css({top: y+'px', left: x+'px'}).addClass("animate");
});

// Loading
$(function() {
	$(".loading-wrapper").fadeOut(2000);
});


// Bootstrap Dropdown Hover
$(function(){
	$("#header-actions .dropdown").hover(            
		function() {
			$('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
			$(this).toggleClass('open');              
		},
		function() {
			$('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
			$(this).toggleClass('open');            
		}
	);
});

$(function(){

	$('[data-toggle="tooltip"]').tooltip();

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#stations').multiSelect({ keepOrder: true });
	//delete resource button action
	$("[data-delete]").click(function(){
		const route = $(this).data('delete');
		const token = $('meta[name="csrf-token"]').attr('content');
		const message = $(this).data('message');
		console.log(message != undefined);
		const msg = message != undefined ? message : "Are you sure you want to delete.";
		//console.log(route);
		if(confirm(msg)){
			$.ajax({
				url:route,
				type: 'POST',
				data: {_method: 'delete', _token :token},
				success:function(result){
					if(!status){
						$("[data-delete='"+route+"']").parents(':eq(1)').remove();
						alertify.success( result.msg );
					} else {
						alertify.error( result.msg );
					}
					//alert(result.msg);
				}
			});
		}
	});

	// change status (activate/deactivate) button action
	$("[data-status]").click(function(){
		const route = $(this).data('status');
		const token = $('meta[name="csrf-token"]').attr('content');
		//console.log(route);
		//if(confirm("Are you sure you want to change status.")){
		$.ajax({
			url:route,
			type: 'POST',
			data: { _token :token},
			success:function(result){
				console.log(result);
				if(!result.error){
					var ele = $("[data-status='"+route+"']");
					var goto = ele.data('goto');
					alertify.success( result.msg );
					if(goto != undefined){
						setTimeout(function(){
							window.location.href = goto;
						}, 1000)

					} else {
						ele.parent().prev().text(result.status?'Active':'Deactive');
						ele.attr('title', result.status?'Deactivate':'Activate');
					}
				} else {
					alertify.error( result.msg );
				}
				//alert(result.msg);

			}
		});
		//}
	});

	$( "#datefrom" ).datetimepicker({
		controlType: 'select',
		oneLine: true,
		timeFormat: 'hh:mm tt',
		dateFormat: 'yy-m-d',
		stepMinute: 5,
		minDate: new Date(),
		onSelect: function(selectedDate) {
			$('#dateto').datetimepicker('option', 'minDate', selectedDate);
			console.log(selectedDate);
		}
	});
	$( "#dateto" ).datetimepicker({
		controlType: 'select',
		oneLine: true,
		timeFormat: 'hh:mm tt',
		dateFormat: 'yy-m-d',
		minDate: new Date(),
		stepMinute: 5,

	});

	$('input[data-date]').datepicker({dateFormat: 'yy-mm-dd'});

	$('input[data-check]').each(function(){
		var self = $(this),
				label = self.next(),
				label_text = label.text();

		label.remove();
		self.iCheck({
			checkboxClass: 'icheckbox_line',
			radioClass: 'iradio_line',
			insert: '<div class="icheck_line-icon"></div>' + label_text
		});
	});

	$('input[type="checkbox"]:not(input[type="checkbox"][data-check]), ' +
			'input[type="radio"]:not(input[type="radio"][data-check])').each(function(){
		$(this).iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-red',
			increaseArea: '20%' // optional
		});
	});

	$('table[data-datatable]').DataTable({
		ordering:  false
	});


});

function ajaxSave(url, data)
{
	$.ajax({
		url:url,
		type: 'POST',
		data: data,
		success:function(result){
			//console.log(result);
			if(result.error){
				alertify.error( result.message );
			} else {
				alertify.success( result.message );
			}
		}
	});
}

function toSlug(Text)
{
	return Text
			.toLowerCase()
			.replace(/[^\w ]+/g,'')
			.replace(/ +/g,'-');
}


// for ticket booking and issue
function seatSelect(id){
	var seat = $('.seat-'+id);
	var seat_no = $('.seat_'+id);
	if(seat.is(':checked')){
		if(seat.val() == 'F'){
			seat.prop( "checked", false ).val('');
			seat_no.find('span').remove();
		} else {
			seat.val('F');
			seat_no.find('span').attr('class', 'icon-woman');
		}
	} else {
		seat.prop( "checked", true ).val('M');
		seat_no.append('<span class="icon-man"></span>');
	}
	setSeat();
	//console.log(id, seat.val(), seat.is(':checked'));
}
// for ticket booking and issue
function setSeat(){
	var seats = $('.seats:checked');
	var seat_no = '';

	seats.each(function(i, e){
		seat_no += ','+$(e).data('seat')+$(e).val();

	});
	$('#total_seats').val(seats.length);
	/*var fare = $('#fare').val();
	if($('#disfare').length)
		fare = $('#disfare').val();
	$('#total_fare, #payable_fare').text(seats.length*fare);*/
	$('input[name="seat_numbers"]').val(seat_no.substr(1));
	fareCalculate();
}
function fareCalculate(){
	var fare = $('#fare').val();
	var seats = $('#total_seats').val();
	if($('#disfare').length){
		// fare = $('#disfare').val();
		$('#discount').val( ($('#fare').val()*seats) - ($('#disfare').val()*seats) );
	}
	var discount = $('#discount').val();
	$('#total_fare').text(seats*fare);
	$('#payable_fare').text((seats*fare)-discount);
}
function cancelTicket(url)
{
	var txt;
	var ticketid = prompt("Please enter Booking ID or Ticket ID");
	if (ticketid != null || ticketid != "") {
		url = url+"/"+ticketid;
		console.log(url);
		$.post(url, function(res){
			console.log(res);

			if(res.error){
				alert(res.msg)
			} else {
				var fare = parseFloat(res.ticket.total_fare);
				var discount = parseFloat(res.ticket.discount != null ? res.ticket.discount : 0);
				var deduction = parseFloat(res.deduction);
				var refund = fare - discount - deduction;

				var msg = 'Customer Name : ' + res.ticket.p_name + '\n';
				msg += 'Amount : ' + (fare - discount) +'\n';
				msg += 'Deduction : ' + deduction +'\n';
				msg += 'Refund : ' + refund;
				alert(msg);
			}

		})
	}
	//document.getElementById("demo").innerHTML = txt;
}


function cancelAllTickets(url)
{
	var bookingdate = $('#bookingdate').val();
	var schedule_id = $('#schedules tr.active').data('schedule');
	var schedule_time = $('#schedules tr.active td:nth-child(2)').text();
	var schedule_name = $('#schedules tr.active td:nth-child(3)').text();
	var bookingdate = $('#bookingdate').val();
	if(schedule_id === undefined){
		alert('Schedule not selected');
		return false;
	}
	if(bookingdate === undefined && bookingdate == ''){
		alert('Select booking date');
		return false;
	}

	var data = { bookingdate: bookingdate, schedule: schedule_id }

	var r = confirm("Are you sure?\nCancel all Tickets of Route '"+schedule_name+"' at "+schedule_time+"!");
	if (r == true) {
		$.ajax({
			url : url,
			type : 'get',
			data : data,
			success: function(res){
				getBusSeats($('#schedules tr.active'), busSeatsURI);
				alertify.success(res.msg);
			}
		})
	}
}

function getBusSeats(ele, url)
{
	var schedule = $(ele).data('schedule');
	var route = $(ele).data('route');
	var bookingdate = $('#bookingdate').val();
	$('input[name="route_id"]').val(route);
	$('input[name="schedule_id"]').val(schedule);

	var data = { schedule: schedule, route: route, bookingdate: bookingdate };

	$.ajax({
		url: url,
		data: data,
		type: 'GET',
		success: function(res){
			$('#bus_seats').html(res);
			$('.bus_wrpr .overly').hide();
		}
	});
}

function ticketPrint(url)
{
	var ticketid = prompt("Please enter Ticket ID");
	ticketid = parseInt(ticketid);
	if (ticketid > 0){
		window.location.href = url+'/'+ticketid;
		//alert(ticketid);
	}
}

function issusTicketById()
{
	var txt;
	var ticketid = prompt("Please enter Booking ID");
	ticketid = parseInt(ticketid);
	if (ticketid > 0 && ticketid !== NaN){
		var url = isuseTicketURI+"/"+ticketid;
		//console.log(url);

		$.get(url, function(res){
			console.log(res);

			if(res.error){
				alert(res.msg)
			} else {
				var fare = parseFloat(res.ticket.total_fare);
				var discount = parseFloat(res.ticket.discount != null ? res.ticket.discount : 0);
				//var deduction = parseFloat(res.deduction);
				var charge = fare - discount;

				var msg = 'Please Charge Rs. ' + charge;
				alert(msg);
				window.location.href = ticketPrintURI+'/'+res.ticket.id;
			}

		})
	}
	//document.getElementById("demo").innerHTML = txt;
}

