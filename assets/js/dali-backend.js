/*------------------------ 
Backend related javascript
variable object : dali
    test ->  dali.plugin_name
------------------------*/
jQuery(function() {

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
			let type = field.get('type');
			let key = field.get('key');
			let name = field.get('name');
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
        this.name = formatSeed(parseInt(new Date().getTime() / 1000, 10), 8);

});