( function( $ ) {
	var getData, gettingPlanets, gettingColors;

	getData = function( key ) {
		return $.ajax( {
			'url': '/wp-admin/admin-ajax.php',
			'data': {
				'action': 'wcgr_get_data',
				'key': key
			}
		} );
	};

	gettingPlanets = getData( 'planets' ).promise();
	gettingColors = getData( 'lightsaber_colors' ).promise();

	$( document ).ready( function() {
		$( '.wcgr, .lightsabers' ).html( '<span class="loading" />' );

		gettingPlanets
			.done( function( response ) {
				var content, header, planets, wcgr;

				try{
					wcgr = JSON.parse( response );
				} catch( e ) {
					wcgr = {};
				}
				header = wcgr.header || 'Why you stuck-up, half-witted, scruffy-looking nerf-herder!';
				planets = wcgr.planets || [];
				content = '<h4>' + header + '</h4>' + '<p>' + planets.join( ', ' ) + '</p>';
				if ( wcgr.display_name ) {
					content = '<h3>Greetings, ' + wcgr.display_name + '!</h3>' + content;
				}

				$( '.wcgr' ).html( $( content ).fadeIn() );
			} )
			.fail( function( error ) {
				console.error( 'Error getting planets: ' + error );
			} )
		;


		gettingColors.done( function( response ) {
			var content, lightsabers, cssColor, color;

			try {
				lightsabers = JSON.parse( response );
			} catch( e ) {}

			if ( lightsabers ) {
				content = '<h3>Lightsaber colors</h3>';
				for ( color in lightsabers ) {
					cssColor = lightsabers[ color ] || color;
					content += '<div style="text-align:center;color:black;background-color:' + cssColor + ';">' + color + '</div>';
				}

				$( '.lightsabers' ).html( $( content ).fadeIn() );
			}

		} );

	} );
} )( jQuery );

( function( $ ) {
	$( document ).ready( function() {
		$( '.hello' )
			.css( {
				'background-color': '#afafaf',
				'padding': 20,
				'height': 200
			} )
			.html( 'lorem ipsum' )
		;
	} );
} )( jQuery );