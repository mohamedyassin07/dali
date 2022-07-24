/*------------------------ 
Backend related javascript
variable object : dali
    test ->  dali.plugin_name
------------------------*/
jQuery(function() {

	jQuery(document).on('click', 'tbody#the-list #front_page_actions', function(e) {
		e.preventDefault();

		let currnt = jQuery(this);
		let id = currnt.data('id');
		let title = currnt.closest('td.page-title').find('.row-title').text();
		alert('تأكيد اختيار صفحة   [ ' +  title +  ' ]   كصفحة  رئيسية ؟');

		jQuery.ajax({
			url : ajax_wpx.ajax_url,
			type: 'POST',
			data:{
				action: 'dali_front_page', 
				id: id
			},
			beforeSend: function() {},
            complete: function(){},
			success: function( response ){				
				if( response.success === true ) {
					window.location.reload();
				}					
				console.log( response.success );
			},
			error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
		});
	});
	
	jQuery(document).on('click', '.acf-fc-layout-controls a.acf-icon[data-name="duplicate-layout"]', function(e) {
		let $contentBlock = jQuery(this).closest('.layout');
        getContentBlockData($contentBlock);
	    // console.log(JSON.stringify(data));	
	});

	let getContentBlockData = function(parent) {
		let data = [];
		$fields = acf.findFields({
			parent: parent,
		});
		if ($fields.size() <= 0) {
			return data;
		}
		for (let i = 0; i < $fields.size(); i++) {
			let $element = jQuery($fields[i]);
			let field = acf.getField($element);
			let type  = field.get('type');
			let key   = field.get('key');
			let name  = field.get('name');
			let value = null;
			if( name === '_id' ){
                field = acf.getField($element);
                let uniqid =  formatSeed(parseInt(new Date().getTime() / 1000, 10), 8);
                field.$input().val(uniqid);
          }
		}
		// return data;
	}
  
       var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10).toString(16); // to hex str
        if (reqWidth < seed.length) {
            // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) {
            // so short we pad
            return Array(1 + (reqWidth - seed.length)).join('0') + seed;
        }
        return seed;
        };

});

jQuery(document).ready(function($) {
	if (typeof(acf) == 'undefined') {
	  return;
	}
	$('input#acf-field_62a0707f55552').val('');
	$('input#acf-field_62a0707f44442').val('');
	$('input#acf-field_62a0707fff442').val('');
	    let section_ids = [];
	    let columns_ids = [];
	    let widget_ids = [];
	    // add id with delete row in acf .
		$('body').on('click', '.acf-field-repeater[data-key="field_acf_rows"] a.acf-icon.-minus', function( e ){

			acf.add_action('remove', function( $el ){	       

				if( !$el.prevObject.hasClass( "acf-clone" ) ){ 

			    let section_id = $el.find(".acf-field[data-name='section_id']").find(".acf-input input").val();

					if( typeof(section_id) != 'undefined' ){

					   if (!section_ids.includes(section_id)) {
							section_ids.push(section_id);
							$('input#acf-field_62a0707f55552').val(section_ids);
						} 
						
					}		

					console.log(section_ids);

				}	 

			});	
		
		});
	    $('body').on('click', '.acf-field-repeater[data-name="columns"] a.acf-icon.-minus', function( e ){

			acf.add_action('remove', function( $el ){	       

				if( !$el.prevObject.hasClass( "acf-clone" ) ){ 

				let columns_id = $el.find(".acf-field[data-name='columns_id']").find(".acf-input input").val();

						if( typeof(columns_id) != 'undefined' ){
							if (!columns_ids.includes(columns_id)) {
									columns_ids.push(columns_id);
									$('input#acf-field_62a0707f44442').val(columns_ids);
								}
							
						}
					console.log(columns_ids);
				}	 

			});	
		
		});
		
		$('body').on('click', '.acf-field-flexible-content[data-name="elements"] a.acf-icon.-minus', function( e ){

			acf.add_action('remove', function( $el ){	       

				if( !$el.prevObject.hasClass( "acf-clone" ) ){ 

				let widget_id = $el.closest('.layout').find(".acf-field[data-name='_id']").find(".acf-input input").val();
			
					if( typeof(widget_id) != 'undefined' ){
						if (!widget_ids.includes(widget_id)) {
							widget_ids.push(widget_id);
						   $('input#acf-field_62a0707fff442').val(widget_ids);
						}
						
					}
					console.log(widget_id);
				}	 

			});	
		
		});


		
		
  });