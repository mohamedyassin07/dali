(function($){

	function initialize_field( $field ) {
		$('.dali-dimensions__buttons a', $field).on('click',function(e){
			e.preventDefault();
			var $this = $(this);

			$field.find('.dali-dimensions__device').removeClass('dali-dimensions__device--active');
			$field.find('.' + $this.attr('rel')).addClass('dali-dimensions__device--active');
			$field.find('.dali-dimensions__buttons a').removeClass('btn--active');
			$this.toggleClass('btn--active');
		});

		$('.input-top', $field ).on('keyup',function(e){
			var $this = $(this);

			var $is_linked = $this.parent().parent().parent().find('.btn--linker').hasClass('btn--active');

			if ( true == $is_linked ) {
				handleTopChange($this);
			}
		})

		$('.dali-dimensions__linker .btn--linker', $field).on('click',function(e){
			e.preventDefault();
			var $this = $(this);
			var $is_active = $this.hasClass('btn--active');

			if ( true == $is_active) {
				// Unlink.
				makeUnlinked( $this );
				$this.parent().find('.input-linked').val('0');
				copyLinkedValue( $this );
			} else {
				// Link.
				makeLinked( $this );
				$this.parent().find('.input-linked').val('1');
				copyLinkedValue( $this );
			}

			$this.toggleClass('btn--active');
		});

		function handleTopChange($this) {
			var $value_top = $this.val();

			$this.parent().parent().find('input:not(.input-linked)').val( $value_top );
		}

		function copyLinkedValue( $this ) {
			var $value_top = $this.parent().parent().find('.input-top').val();

			if ( $value_top ) {
				$this.parent().parent().find('input:not(.input-linked)').val( $value_top );
			}
		}

		function makeLinked( $this ) {
			$this.parent().parent().find('.dali-dimensions__texts input:not(.input-top)').prop('readonly', true);
		}

		function makeUnlinked( $this ) {
			$this.parent().parent().find('.dali-dimensions__texts input:not(.input-top)').prop('readonly', false);
		}
	}

	if ( typeof acf.add_action !== 'undefined' ) {
		acf.add_action('ready_field/type=dali_dimensions', initialize_field);
		acf.add_action('append_field/type=dali_dimensions', initialize_field);
	}

})(jQuery);
