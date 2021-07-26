<?php
function minimax2_rel_canonical(){

	if ( is_singular() ) {
		$id = get_queried_object_id();

		if ( 0 === $id ) {
			return;
		}

		$url = wp_get_canonical_url( $id );

		if ( ! empty( $url ) ) {
			echo '<link rel="canonical" href="' . esc_url( $url ) . '" />' . "\n";
		}
	}
	else{
		//add archive canonicals and search canonicals.
	}

}