$(function(){
	$('.last-previous-date').removeClass('available last'); 
	$(document).on('click','[data-event]',function(){
		var date = $(this).data('event');
		var $this = $(this);
		
		var from = localStorage.getItem("first");
		if(from !== null){
			if(from === date){
				alert('Sorry you can not select same date at least one day');
				return false;
			}else if(from > date){
                               
				alert('Checkout date must be greater than checkin date');
                                localStorage.removeItem("first");
				return false;
			}else{
            
            	var id = $('.propertys_id').val();
				$this.addClass('request-to');	
				$.getJSON("checking-booking.php?from="+from+"&to="+date+"&id="+id, function(data){

					if(data.status === 0){

						alert(data.message);

						localStorage.removeItem('first');

						$('.calendar-day').removeClass('request-from');
                                                $('.calendar-day').removeClass('request-to');

					}else{

						var date1 = date1 = from.split('-'),date1 = date1[0]+'/'+date1[1]+'/'+date1[2]; //for safari

						var date2 = date.split('-'),date2 = date2[0]+'/'+date2[1]+'/'+date2[2];//for safari

						var array = getDateArray(new Date(date1), new Date(date2));//for safari

					

						for(var i = 0; i < array.length; i++) {

							console.log(formatDate(array[i]));

							$('.calendar-day').removeClass('request-from');
							$('.'+formatDate(array[i])).addClass('request-to');						

						}

						//

							openModal(from,date);

					}
					localStorage.removeItem("first")
				});

						

			}

			
		}else{
			
			$('.calendar-day').removeClass('request-from');
			$('.calendar-day').removeClass('request-to');
			$this.addClass('request-from');
			//$('.d1').val(date);
                        localStorage.setItem("first",date);
			
		}
	});
	
	//if the booking start and end date is same
	$("table.calendar tr").find('td.first').each(function(index){
		if($(this).prev().attr('class') == 'calendar-day booked '){
			$(this).css({'background-color':'orange','cursor':'pointer'});
			$(this).removeClass('first');
			$(this).removeClass('unavailable');
			$(this).attr('title','Previous booking completed and new booking has started');
			$(this).find('div').css({'color':'#fff'});
			$(this).find('a').css({'color':'#fff'});
		}
	});
	
	//change the months of calendar
	jQuery(document).on('click','#precal,#nextcal',function(e){
		e.preventDefault();
		
		var url = $(this).attr('href');
		var str = "<div class='containers'>";
			str += "<div class='loader'>";
			str += "<div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--text'></div>";
			str += "</div>";
			str += "</div>";
			
		jQuery.ajax({ 
			url:url,
			type:'GET',
			dataType:"html",
			cache:false,
			beforeSend: function(){
				jQuery('#availablityCalendar').html(str);
			},
			success:function(div){
				jQuery('#availablityCalendar').html(div);
			}
			});
	});
});

//$(document).on('submit','#book-property-form',function(e){
//$.post('quote.php',$(this).serialize(),function(d){
//window.location.href="quote.php";
//})
//})

function showPopup(start,end){
	//var date1 = start.split('/'),date1 = date1[0]+'-'+date1[1]+'-'+date1[2]; //for safari
	//var date2 = end.split('/'),date2 = date2[0]+'-'+date2[1]+'-'+date2[2];//for safari
	$('.modal .startdate').val(start);
	$('.modal .enddate').val(end);
	$('#myModal').modal('show');
	
}

function getDateArray(start, end){
    var arr = new Array();
    var dt = new Date(start);
    while (dt <= end) {
       arr.push(new Date(dt));
       dt.setDate(dt.getDate() + 1);
    }
    return arr;
}

function formatDate(d) {
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function openModal(start,end) {
	//var date1 = start.split('/'),date1 = date1[0]+'-'+date1[1]+'-'+date1[2]; //for safari
	//var date2 = end.split('/'),date2 = date2[0]+'-'+date2[1]+'-'+date2[2];//for safari
	$('.modal .startdate').val(start);
	$('.modal .enddate').val(end);
  document.getElementById('myCalendar').style.display = "block";
}

function closeModal() {
	$('.calendar-day').removeClass('request-to');
  	document.getElementById('myCalendar').style.display = "none";
}