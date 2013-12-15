$(document).ready(function() {						   
	loadDataTable();
	$('#btn-save').live("click",function() {									 
		if($('#frm-data-table').valid())
		{
			id=$('#cur_id').val();
			saveRecord();
		}
	});
	 $(".closebutton").on("click", function (e) {

        $(this).parents(".modal").modal("hide");
    });
	 
	 jQuery.validator.addMethod("checkUniqueProducer", function( value, element ) {
		var resret = null;
		if(value != "")
		{
			$.ajax({
				   		async: false,
						type:"POST",
						url:'index_ajax.php',
						data: {todo:"checkUniqueProducer", producer:value, id: $('#cur_id').val()},
						dataType:"json",
						success:function (data) {
							if(data.result == "Success")
							{
								resret = false;	
							}
							else
							{
								resret = true;	
							}
						},
						
					});
			return resret;
		}
	},"Producer already exists");
	 
	  jQuery.validator.addMethod("checkUniqueRegion", function( value, element ) {
		var resret = null;
		if(value != "")
		{
			$.ajax({
				   		async: false,
						type:"POST",
						url:'index_ajax.php',
						data: {todo:"checkUniqueRegion", region:value, id: $('#cur_id').val()},
						dataType:"json",
						success:function (data) {
							if(data.result == "Success")
							{
								resret = false;	
							}
							else
							{
								resret = true;	
							}
						},
						
					});
			return resret;
		}
	},"Region already exists");
	 
	
	$('#frm-data-table').validate({
        rules: {
			debug: true,
			producer:
			{
				required: true,
				checkUniqueProducer: true,
			},
			region:
			{
				required: true,
				checkUniqueRegion: true,
			},
		},
        messages: {
			producer:
			{
				required: "please enter producer",
			},        			
			region:
			{
				required: "please enter Region",
			},
		}
    });
});

function loadDataTable()
{
	$.ajax({
        type:"POST",
        url:  'index_ajax.php',
        data:{todo:"loadDataTable",page:$('#page').val()},
        dataType:"html",
        success:function (data) {
			$("#data_table").html(data);
		}
    });
}

function changePerPage(recperpage)
{
	$.ajax({
			type:"POST",
			 url:  'index_ajax.php',
			data:{todo:"changePerPage", recperpage:recperpage},
			dataType:"json",
			success:function (data) {
				if(data.result == "Success")
				{
					$('#page').val('1');
					loadDataTable();
				}
				else
				{
					alert(data.message);	
				}
			},	
		});
}

function showPage(page)
{	
	$('#page').val(page);
	loadDataTable();
}
	
function  editField(id)
{
	 $("label.error").hide();
	$(".error").removeClass("error");
	$('#title').html('Edit Record');
	$('#producer').val($('#producer_'+id).val());
	$('#name').val($('#name_'+id).val());
	$('#region').val($('#region_'+id).val());
	$('#cuvee').val($('#cuvee_'+id).val());
	$('#color').val($('#color_'+id).val());
	$('#cur_id').val(id);
	$('#modalEditTable').modal('show');		
}
function saveRecord()
{
	$.ajax(
        {
            type:"POST",
           url:  'index_ajax.php',
            data:{todo:"saveRecord", id:$('#cur_id').val(), producer: $.trim($('#producer').val()), name:$.trim($('#name').val()),region:$.trim($('#region').val()),cuvee:$.trim($('#cuvee').val()),color:$.trim($('#color').val())},
            dataType:"json",
            success:function (data) {
				if(data.result == "Success")
				{
					 $('#modalEditTable').modal('hide');	
					 loadDataTable();
				}
            },
            
        }
    );		
}

function deleteField(id)
{
	
	if (confirm('Are you sure you want to delete it')) {
		$.ajax(
        {
            type:"POST",
           url:  'index_ajax.php',
            data:{todo:"deleteRecord", id:id},
            dataType:"json",
            success:function (data) {
				if(data.result == "Success")
				{
					 loadDataTable();
				}
            },
            
        }
    );
	}
	
}
