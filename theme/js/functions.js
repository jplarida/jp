function isEmpty(fields) {
    flag = false;
    for (i = 0; i < fields.length; i++) {
        if ($("#" + fields[i]).val() == "") {
            flag = true;
        }
    }

    return flag;
}

function addProducts(pro_id) {
	name 			= 	$("#pname").val();
    pasin 			= 	$("#pasin").val();
	var fields 	= 	new Array("name", "pasin");
	
	if(typeof pro_id === 'undefined')		{
		pro_id	=	0;
	}else {
		name 		= 	$("#epname").val();
   		pasin 		= 	$("#epasin").val();
		var fields 	= 	new Array("epname", "epasin");
	}
	
    
	var flag	=	true;
	
   
	
    //if (isEmpty(fields) == true) {
       // $('#errorr').html('All fields are required.');
        //flag	=	false;
    //} else {

	
        $.ajax({
            data: {
                name: name,
                pasin: pasin,
				pro_id:pro_id
            },
            type: "post",
            cache: false,
			dataType: 'json',
			async: false,
            url: "api/add-products.php",
            success: function(data) {
				console.log(data);
				if(pro_id != 0)	{
					if (data.flag == 1) {
						flag	=	false;
						$('#errorr').html('Sorry, this product already exist :(');
					} 
				}else {
					if (data.flag == 1) {
						flag	=	false;
						$('#edit-errorr').html('Sorry, this product already exist :(');
					}
				}
            }
        });
   // }
	return flag;

}
function addSuperUrl(cmd,su_id) {

	var flag	=	true;
	
	if(cmd	== "add")	{
		pro_id 		= 	$("#product_id").val();
		var fields 	= 	new Array("select2_sample5");
		if (isEmpty(fields) == true) {
			$('#errorr').html('All fields are required.');
			return false;
		}
	}else {
		pro_id 		= 	$("#eproduct_id").val();
		var fields 	= 	new Array("select2_sample_modal_5");
		if (isEmpty(fields) == true) {
			$('#edit-errorr').html('All fields are required.');
			return false;
		}
	}
	
	$.ajax({
		data: {
			pro_id:pro_id,
			cmd:cmd,
			su_id:su_id
		},
		type: "post",
		cache: false,
		dataType: 'json',
		async: false,
		url: "api/super-url.php",
		success: function(data) {
			console.log(data);
			if(cmd == "add")	{
				if (data.flag == 1) {
					flag	=	false;
					$('#errorr').html('Sorry, super url of this product is already  exist :(');
				} 
			}else {
				if (data.flag == 1) {
					flag	=	false;
					$('#edit-errorr').html('Sorry, super url of this product is already  exist :(');
				}
			}
		}
	});
	return flag;

}
function addInventoryHealth(cmd,ih_id) {
	return;
	var flag	=	true;
	
	if(cmd	== "add")	{
		
		pro_id 		= 	$("#product_id").val();
		
		var fields 	= 	new Array("select2_sample5");
		if (isEmpty(fields) == true) {
			
			$('#errorr').html('All fields are required.');
			return false;
		}
	}else {
		pro_id 		= 	$("#eproduct_id").val();
		var fields 	= 	new Array("select2_sample_modal_5");
		if (isEmpty(fields) == true) {
			$('#edit-errorr').html('All fields are required.');
			return false;
		}
	}
	
	
	$.ajax({
		data: {
			pro_id:pro_id,
			cmd:cmd,
			ih_id:ih_id
		},
		type: "post",
		cache: false,
		dataType: 'json',
		async: false,
		url: "api/inventory-health.php",
		success: function(data) {
			console.log("test");
			console.log(data);
			if(cmd == "add")	{
				if (data.flag == 1) {
					flag	=	false;
					$('#errorr').html('Sorry, super url of this product is already  exist :(');
				} 
			}else {
				if (data.flag == 1) {
					flag	=	false;
					$('#edit-errorr').html('Sorry, super url of this product is already  exist :(');
				}
			}
		}
	});
	//return false;
	return flag;

}
function addSellerRank(cmd,sr_id) {

	var flag	=	true;
	
	if(cmd	== "add")	{
		pro_id 		= 	$("#product_id").val();
		var fields 	= 	new Array("select2_sample5");
		if (isEmpty(fields) == true) {
			$('#errorr').html('All fields are required.');
			return false;
		}
	}else {
		pro_id 		= 	$("#eproduct_id").val();
		var fields 	= 	new Array("select2_sample_modal_5");
		if (isEmpty(fields) == true) {
			$('#edit-errorr').html('All fields are required.');
			return false;
		}
	}
	
	$.ajax({
		data: {
			pro_id:pro_id,
			cmd:cmd,
			sr_id:sr_id
		},
		type: "post",
		cache: false,
		dataType: 'json',
		async: false,
		url: "api/seller-rank.php",
		success: function(data) {
			console.log(data);
			if(cmd == "add")	{
				if (data.flag == 1) {
					flag	=	false;
					$('#errorr').html('Sorry, super url of this product is already  exist :(');
				} 
			}else {
				if (data.flag == 1) {
					flag	=	false;
					$('#edit-errorr').html('Sorry, super url of this product is already  exist :(');
				}
			}
		}
	});
	return flag;

}
function addRankTracker(cmd,rt_id) {

	var flag	=	true;
	if(cmd	== "add")	{
		pro_id 		= 	$("#product_id").val();
		var fields 	= 	new Array("select2_sample5");
		if (isEmpty(fields) == true) {
			$('#errorr').html('All fields are required.');
			return false;
		}
	}else {
		pro_id 		= 	$("#eproduct_id").val();
		var fields 	= 	new Array("select2_sample_modal_5");
		if (isEmpty(fields) == true) {
			$('#edit-errorr').html('All fields are required.');
			return false;
		}
	}
	console.log("test");
	$.ajax({
		data: {
			pro_id:pro_id,
			cmd:cmd,
			rt_id:rt_id
		},
		type: "post",
		cache: false,
		dataType: 'json',
		async: false,
		url: "api/rank-tracker.php",
		success: function(data) {
			
			console.log(data);
			if(cmd == "add")	{
				if (data.flag == 1) {
					flag	=	false;
					$('#errorr').html('Sorry, Rank Tracker of this product is already  exist :(');
				} 
			}else {
				if (data.flag == 1) {
					flag	=	false;
					$('#edit-errorr').html('Sorry, Rank Tracker of this product is already  exist :(');
				}
			}
		}
	});
	return flag;

}
function clickDetails(id) {
	$.ajax({
		data: {
			id: id
		},
		type: "post",
		url: "api/click-details.php",
		success: function(data) {
			console.log(data);

		}
	});
} 
function showSUDetail(dom)	{
	if ( $("#"+dom).is(':visible') )	{
		$("#"+dom).hide();
	}else {
		$("#"+dom).show();
	}
}
function showRankDetails(dom)	{
	$("#"+dom).toggle();
	$("#"+dom).focus();
}
function deleteRecord(dom, id, table,msg)	{
	$.ajax({
		data: {
			id: id,
			table:table
		},
		type: "post",
		url: SITE_URL+"api/delete.php",
		success: function(data) {
			$("#"+dom).html(msg);
			$("#"+dom).hide(1000);

		}
	});
}
function addRTKeyword(rt_id)	{
	
	$("#usermsg"+rt_id).fadeOut();
	val		=	$("#key_valye"+rt_id).val();
	if(val	==	"")	{
		console.log("Enter some value");
		return;
	}
	$.ajax({
		data: {
			rt_id:rt_id,
			val:val
		},
		type: "post",
		dataType: 'json',
		url: SITE_URL+"api/add-rt-keyword.php",
		success: function(data) {
			id		=		data.id;
			if(id == 0)	{
				$("#usermsg"+rt_id).fadeIn();
			}else {
				st	=	'<tr id="keyword_'+id+'">';
				st  +=  '<td class="numeric">&gt;&nbsp;<strong><a href="#form_modal20" data-toggle="modal">'+val+'</a></strong></td>';
				st	+=	'<td>--</td><td>--</td>';
				st	+=	'<td>';
				st	+=	'<a onclick="deleteRecord(\'keyword_'+id+'\',\''+id+'\',\'super_url_detail\',\'<td colspan=4>Keyword is deleted sucessfully</td>\');" href="javascript:void(0);">';
				st	+= '<span class="label label-sm label-info">Delete</span></a></td></tr>';
				
				$("#key_area"+rt_id).before(st);
				$("#key_valye"+rt_id).val('');
				$("#key_valye"+rt_id).focus();
			}

		}
	});
}


function addSUKeyword(rt_id)	{
	
	val		=	$("#key_valye"+rt_id).val();
	if(val	==	"")	{
		console.log("Enter some value");
		return;
	}
	$.ajax({
		data: {
			rt_id:rt_id,
			val:val
		},
		type: "post",
		dataType: 'json',
		url: "api/add-su-keyword.php",
		success: function(data) {
			//console.log(data);
			id		=		data.id;
			
			st	=	'<tr id="keyword_'+id+'">';
            st  +=  '<td class="numeric">&gt;&nbsp;<strong><a href="#form_modal20" data-toggle="modal">'+val+'</a></strong></td>';
			st	+=	'<td>--</td><td>--</td>';
			st	+=	'<td>';
			st	+=	'<a onclick="deleteRecord(\'keyword_'+id+'\',\''+id+'\',\'rank_tracker_keywords\',\'<td colspan=4>Keyword is deleted sucessfully</td>\');" href="javascript:void(0);">';
			st	+= '<span class="label label-sm label-info">Delete</span></a></td></tr>';
			
			$("#key_area").before(st);
			$("#key_valye"+rt_id).val('');
			$("#key_valye"+rt_id).focus();

		}
	});
}

function goBack(pid){
	

	
	$.ajax({
		data: {
			pid:pid
		},
		type: "post",
	
		url: SITE_URL+"api/sale-dashbord.php?p="+pid,
		success: function(data) {
			//$("#orders").hide();
	 
			$("#sdash").html(data);
			$("#sdash").fadeIn(350);
			

		}
	});
	}

function orderDetail(order_id)	{
	
	$.ajax({
		data: {
			order_id:order_id
		},
		type: "post",
	
		url: SITE_URL+"api/show-orders.php",
		success: function(data) {
			//$("#orders").hide();
		 $('#oid').html('<i class="fa fa-angle-right"></i>'+order_id+''); 
			$("#order-details").html(data);
			$("#order-details").fadeIn(350);
			

		}
	});
}
