<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

/**
 * Renders a list element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldZenoptions extends JFormField
{
	
	protected  $type = 'Zenoptions';

	 protected function getInput()
	{
		
		$zgfEnabled = JPluginHelper::isEnabled ( 'system', 'zengridframework' )	;
		if ($zgfEnabled) {
			jimport( 'joomla.filesystem.folder' );
			jimport( 'joomla.filesystem.file' );
		
			$class = ( $this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="inputbox"');
			$display= $this->element[ 'display'] ? $this->element['display']: "";
		
			$values = array('gridcount' => array('0' => 'none','one' => '1','two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9', 'ten' => '10', 'eleven' => '11', 'twelve' => '12'),
						'fonts' => array(
						'------------------- Standard ---------------------' => '--------------------- Standard ---------------------',
						'Cambria, Georgia, Times, Times New Roman, serif' => 'Cambria, Georgia, Times, Times New Roman, serif',
						'Adobe Caslon Pro, Georgia, Garamond, Times, serif' => 'Adobe Caslon Pro, Georgia, Garamond, Times, serif',
						'Courier new, Courier, Andale Mono' => 'Courier new, Courier, Andale Mono',
						'Garamond, ‘Times New Roman’, Times, serif' => 'Garamond, ‘Times New Roman’, Times, serif',
						'Georgia, Times, ‘Times New Roman’, serif' => 'Georgia, Times, ‘Times New Roman’, serif', 
						'GillSans, Calibri, Trebuchet, arial sans-serif' => 'GillSans, Calibri, Trebuchet, arial sans-serif', 
						'sans-serif' => 'Helvetica Neue, Helvetica, Arial, sans-serif',
						'Lucida Grande, Geneva, Helvetica, sans-serif' => 'Lucida Grande, Geneva, Helvetica, sans-serif', 
						'Palatino, ‘Times New Roman’, serif' => 'Palatino, ‘Times New Roman’, serif', 
						'Tahoma, Verdana, Geneva' => 'Tahoma, Verdana, Geneva',
						'Trebuchet ms, Tahoma, Arial, sans-serif' => 'Trebuchet ms, Tahoma, Arial, sans-serif',
						'------------------- Serif ---------------------' => '--------------------- Serif ---------------------',
						'Adamina' => 'Adamina',
						'Alegreya' => 'Alegreya',
						'Alegreya+SC' => 'Alegreya SC',
						'Alice' => 'Alice',
						'Alike' => 'Alike',
						'Alike+Angular' => 'Alike Angular',
						'Almendra' => 'Almendra',
						'Almendra+SC' => 'Almendra SC',
						'Amethysta' => 'Amethysta',
						'Andada' => 'Andada',
						'Arapey' => 'Arapey',
						'Artifika' => 'Artifika',
						'Arvo' => 'Arvo',
						'Balthazar' => 'Balthazar',
						'Belgrano' => 'Belgrano',
						'Bentham' => 'Bentham',
						'Bevan' => 'Bevan',
						'Bitter' => 'Bitter',
						'Brawler' => 'Brawler',
						'Bree+Serif' => 'Bree Serif',
						'Buenard' => 'Buenard',
						'Cambo' => 'Cambo',
						'Cardo' => 'Cardo',
						'Caudex' => 'Caudex',
						'Copse' => 'Copse',
						'Coustard' => 'Coustard',
						'Crete+Round' => 'Crete Round',
						'Crimson+Text' => 'Crimson Text',
						'Droid+Serif' => 'Droid Serif',
						'EB+Garamond' => 'EB Garamond',
						'Enriqueta' => 'Enriqueta',
						'Esteban' => 'Esteban',
						'Fanwood+Text' => 'Fanwood Text',
						'Fjord+One' => 'Fjord One',
						'Gentium+Basic' => 'Gentium Basic',
						'GentiumBook+Basic' => 'Gentium Book Basic',
						'Glegoo' => 'Glegoo',
						'Goudy+Bookletter+1911' => 'Goudy Bookletter 1911',
						'Habibi' => 'Habibi',
						'Holtwood+One+SC' => 'Holtwood One SC',
						'IM+Fell+DW+Pica' => 'IM Fell DW Pica',
						'IM+Fell+DW+Pica+SC' => 'IM Fell DW Pica SC',
						'IM+Fell+Double+Pica' => 'IM Fell Double Pica',
						'IM+Fell+Double+Pica+SC' => 'IM Fell Double Pica SC',
						'IM+Fell+English' => 'IM Fell English',
						'IM+Fell+English+SC' => 'IM Fell English SC',
						'IM+Fell+French+Canon' => 'IM Fell French Canon',
						'IM+Fell+French+Canon+SC' => 'IM Fell French Canon SC',
						'IM+Fell+Great+Primer' => 'IM Fell Great Primer',
						'IM+Fell+Great+Primer+SC' => 'IM Fell Great Primer SC',
						'Inika' => 'Inika',
						'Josefin+Slab' => 'Josefin Slab',
						'Judson' => 'Judson',
						'Junge' => 'Junge',
						'Kameron' => 'Kameron',
						'Kotta+One' => 'Kotta One',
						'Kreon' => 'Kreon',
						'Linden+Hill' => 'Linden Hill',
						'Lora' => 'Lora',
						'Lusitana' => 'Lusitana',
						'Lustria' => 'Lustria',
						'Marko+One' => 'Marko One',
						'Mate' => 'Mate',
						'Mate+SC' => 'Mate SC',
						'Merriweather' => 'Merriweather',
						'Montaga' => 'Montaga',
						'Neuton' => 'Neuton',
						'Noticia+Text' => 'Noticia Text',
						'Old+Standard+TT' => 'Old Standard TT',
						'Ovo' => 'Ovo',
						'PT+Serif' => 'PT Serif',
						'PT+Serif+Caption' => 'PT Serif Caption',
						'Petrona' => 'Petrona',
						'Playfair+Display' => 'Playfair Display',
						'Podkova' => 'Podkova',
						'Poly' => 'Poly',
						'Prata' => 'Prata',
						'Prociono' => 'Prociono',
						'Quattrocento' => 'Quattrocento',
						'Radley' => 'Radley',
						'Rokkitt' => 'Rokkitt',
						'Sorts+Mill+Goudy' => 'Sorts Mill Goudy',
						'Stoke' => 'Stoke',
						'Tienne' => 'Tienne',
						'Tinos' => 'Tinos',
						'Trykker' => 'Trykker',
						'Ultra' => 'Ultra',
						'Unna' => 'Unna',
						'Vidaloka' => 'Vidaloka',
						'Volkhov' => 'Volkhov',
						'Vollkorn' => 'Vollkorn',
						'------------------- Sans Serif -------------------' => '------------------- Sans Serif -------------------',
						'Abel' => 'Abel',
						'Aclonica' => 'Aclonica',
						'Acme' => 'Acme',
						'Actor' => 'Actor',
						'Aldrich' => 'Aldrich',
						'Allerta' => 'Allerta',
						'Allerta+Stencil' => 'Allerta Stencil',
						'Amaranth' => 'Amaranth',
						'Andika' => 'Andika',
						'Anonymous+Pro' => 'Anonymous Pro',
						'Antic' => 'Antic',
						'Anton' => 'Anton',
						'Arimo' => 'Arimo',
						'Armata' => 'Armata',
						'Asap' => 'Asap',
						'Asul' => 'Asul',
						'Basic' => 'Basic',
						'Cabin' => 'Cabin',
						'Cabin+Condensed' => 'Cabin Condensed',
						'Cagliostro' => 'Cagliostro',
						'Candal' => 'Candal',
						'Cantarell' => 'Cantarell',
						'Carme' => 'Carme',
						'Chivo' => 'Chivo',
						'Coda+Caption' => 'Coda Caption',
						'Convergence' => 'Convergence',
						'Cousine' => 'Cousine',
						'Cuprum' => 'Cuprum',
						'Days+One' => 'Days One',
						'Didact+Gothic' => 'Didact Gothic',
						'Dorsa' => 'Dorsa',
						'Droid+Sans' => 'Droid Sans',
						'Droid+Sans+Mono' => 'Droid Sans Mono',
						'Duru+Sans' => 'Duru Sans',
						'Electrolize' => 'Electrolize', 
						'Federo' => 'Federo',
						'Francois+One' => 'Francois One', 
						'Fresca' => 'Fresca',
						'Galdeano' => 'Galdeano',
						'Geo' => 'Geo',
						'Gudea' => 'Gudea',
						'Hammersmith+One' => 'Hammersmith One',
						'Homenaje' => 'Homenaje',
						'Inconsolata' => 'Inconsolata',
						'Inder' => 'Inder',
						'Istok+Web' => 'Istok Web',
						'Jockey+One' => 'Jockey One',
						'Josefin+Sans' => 'Josefin Sans',
						'Jura' => 'Jura',
						'Lato' => 'Lato',
						'Lekton' => 'Lekton',
						'Magra' => 'Magra',
						'Mako' => 'Mako',
						'Marmelad' => 'Marmelad',
						'Marvel' => 'Marvel',
						'Maven+Pro' => 'Maven Pro',
						'Metrophobic' => 'Metrophobic',
						'Michroma' => 'Michroma',
						'Molengo' => 'Molengo',
						'Montserrat' => 'Montserrat', 
						'Muli' => 'Muli',
						'News+Cycle' => 'News Cycle',
						'Nobile' => 'Nobile',
						'Numans' => 'Numans',
						'Nunito' => 'Nunito',
						'Open+Sans' => 'Open Sans',
						'Open+Sans+Condensed' => 'Open Sans Condensed',
						'Orbitron' => 'Orbitron',
						'Oswald' => 'Oswald',
						'Oxygen' => 'Oxygen',
						'PT+Sans' => 'PT Sans',
						'PT+Sans+Caption' => 'PT Sans Caption',
						'PT+Sans+Narrow' => 'PT Sans Narrow',
						'Paytone+One' => 'Paytone One',
						'Philosopher' => 'Philosopher',
						'Play' => 'Play',
						'Puritan' => 'Puritan',
						'Quattrocento+Sans' => 'Quattrocento Sans',
						'Questrial' => 'Questrial',
						'Quicksand' => 'Quicksand',
						'Rationale' => 'Rationale',
						'Rosario' => 'Rosario',
						'Ruda' => 'Ruda',
						'Ruluko' => 'Ruluko',
						'Shanti' => 'Shanti',
						'Sigmar+One' => 'Sigmar One',
						'Signika' => 'Signika',
						'Signika+Negative' => 'Signika Negative',
						'Six+Caps' => 'Six Caps',
						'Snippet' => 'Snippet',
						'Spinnaker' => 'Spinnaker',
						'Syncopate' => 'Syncopate',
						'Telex' => 'Telex',
						'Tenor+Sans' => 'Tenor Sans',
						'Terminal+Dosis' => 'Terminal Dosis',
						'Ubuntu' => 'Ubuntu',
						'Ubuntu+Condensed' => 'Ubuntu Condensed',
						'Ubuntu+Mono' => 'Ubuntu Mono',
						'Varela' => 'Varela',
						'Varela+Round' => 'Varela Round',
						'Viga' => 'Viga',
						'Voltaire' => 'Voltaire',
						'Wire+One' => 'Wire One', 
						'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
						
						
						'------------------- Handwriting -------------------' => '------------------- Handwriting -------------------',
						'Aguafina+Script'=>'Aguafina Script',
						'Aladin'=>'Aladin',
						'Alex+Brush'=>'Alex Brush',
						'Amatic+SC'=>'Amatic SC',
						'Annie+Use+Your+Telescope'=>'Annie Use Your Telescope',
						'Architects+Daughter'=>'Architects Daughter',
						'Arizonia'=>'Arizonia',
						'Bad+Script'=>'Bad Script',
						'Bilbo'=>'Bilbo',
						'Bilbo+Swash+Caps'=>'Bilbo Swash Caps',
						'Bonbon'=>'Bonbon',
						'Calligraffitti'=>'Calligraffitti',
						'Cedarville+Cursive'=>'Cedarville Cursive',
						'Coming+Soon'=>'Coming Soon',
						'Condiment'=>'Condiment',
						'Cookie'=>'Cookie',
						'Covered+By+Your+Grace'=>'Covered By Your Grace',
						'Crafty+Girls'=>'Crafty Girls',
						'Damion'=>'Damion',
						'Dancing+Script'=>'Dancing Script',
						'Dawning+of+a+NewDay'=>'Dawning of a New Day',
						'Delius'=>'Delius',
						'Delius+Swash+Caps'=>'Delius Swash Caps',
						'Delius+Unicase'=>'Delius Unicase',
						'Devonshire'=>'Devonshire',
						'Dr+Sugiyama'=>'Dr Sugiyama',
						'Engagement'=>'Engagement',
						'Fondamento'=>'Fondamento',
						'Give+You+Glory'=>'Give You Glory',
						'Gloria+Hallelujah'=>'Gloria Hallelujah',
						'Gochi+Hand'=>'Gochi Hand',
						'Handlee'=>'Handlee',
						'Herr+Von+Muellerhoff'=>'Herr Von Muellerhoff',
						'Homemade+Apple'=>'Homemade Apple',
						'Indie+Flower'=>'Indie Flower',
						'Italianno'=>'Italianno',
						'Julee'=>'Julee',
						'Just+Another+Hand'=>'Just Another Hand',
						'Just+Me+Again+Down+Here'=>'Just Me Again Down Here',
						'Kristi'=>'Kristi',
						'La+Belle+Aurore'=>'La Belle Aurore',
						'League+Script'=>'League Script',
						'Leckerli+One'=>'Leckerli One',
						'Loved+by+the+King'=>'Loved by the King',
						'Marck+Script'=>'Marck Script',
						'Meddon'=>'Meddon',
						'Merienda+One'=>'Merienda One',
						'Miss+Fajardose'=>'Miss Fajardose',
						'Monsieur+La+Doulaise'=>'Monsieur La Doulaise',
						'Montez'=>'Montez',
						'Mr+Bedfort'=>'Mr Bedfort',
						'Mr+Dafoe'=>'Mr Dafoe',
						'Mr+De+Haviland'=>'Mr De Haviland',
						'Mrs+Saint+Delafield'=>'Mrs Saint Delafield',
						'Mrs+Sheppards'=>'Mrs Sheppards',
						'Neucha'=>'Neucha',
						'Niconne'=>'Niconne',
						'Nothing+You+Could+Do'=>'Nothing You Could Do',
						'Over+the+Rainbow'=>'Over the Rainbow',
						'Pacifico'=>'Pacifico',
						'Patrick+Hand'=>'Patrick Hand',
						'Patua+One'=>'Patua One',
						'Permanent+Marker'=>'Permanent Marker',
						'Pinyon+Script'=>'Pinyon Script',
						'Qwigley'=>'Qwigley',
						'Rancho'=>'Rancho',
						'Redressed'=>'Redressed',
						'Reenie+Beanie'=>'Reenie Beanie',
						'Rochester'=>'Rochester',
						'Rock+Salt'=>'Rock Salt',
						'Rouge+Script'=>'Rouge Script',
						'Ruge+Boogie'=>'Ruge Boogie',
						'Ruthie'=>'Ruthie',
						'Satisfy'=>'Satisfy',
						'School+bell'=>'Schoolbell',
						'Shadows+Into+Light'=>'Shadows Into Light',
						'Short+Stack'=>'Short Stack',
						'Sofia'=>'Sofia',
						'Sue+Ellen+Francisco'=>'Sue Ellen Francisco',
						'Sunshiney'=>'Sunshiney',
						'Swanky+and+Moo+Moo'=>'Swanky and Moo Moo',
						'Tangerine'=>'Tangerine',
						'The+Girl+Next+Door'=>'The Girl Next Door',
						'Vibur'=>'Vibur',
						'Waiting+for+the+Sunrise'=>'Waiting for the Sunrise',
						'Walter+Turncoat'=>'Walter Turncoat',
						'Yellowtail'=>'Yellowtail',
						'Yesteryear'=>'Yesteryear',
						'Zeyada'=>'Zeyada',


						'------------------- Display -------------------' => '------------------- Display -------------------',
						'Abril+Fatface'=>'Abril Fatface',
						'Alfa+Sla+bOne'=>'Alfa Slab One',
						'Allan'=>'Allan',
						'Arbutus'=>'Arbutus',
						'Asset'=>'Asset',
						'Astloch'=>'Astloch',
						'Atomic+Age'=>'Atomic Age',
						'Aubrey'=>'Aubrey',
						'Bangers'=>'Bangers',
						'Baumans'=>'Baumans',
						'Bigshot+One'=>'Bigshot One',
						'Black+Op+sOne'=>'Black Ops One',
						'Boogaloo'=>'Boogaloo',
						'Bowlby+One'=>'Bowlby One',
						'Bowlby+One+SC'=>'Bowlby One SC',
						'Bubblegum+Sans'=>'Bubblegum Sans',
						'Buda'=>'Buda',
						'Butcherman'=>'Butcherman',
						'Cabin+Sketch'=>'Cabin Sketch',
						'Caesar+Dressing'=>'Caesar Dressing',
						'Carter+One'=>'Carter One',
						'CevicheO+ne'=>'Ceviche One',
						'Changa+One'=>'Changa One',
						'Chango'=>'Chango',
						'Chelsea+Market'=>'Chelsea Market',
						'Cherry+Cream+Soda'=>'Cherry Cream Soda',
						'Chewy'=>'Chewy',
						'Chicle'=>'Chicle',
						'Coda'=>'Coda',
						'Comfortaa'=>'Comfortaa',
						'Concert+One'=>'Concert One',
						'Contrail+One'=>'Contrail One',
						'Corben'=>'Corben',
						'Creepster'=>'Creepster',
						'Crushed'=>'Crushed',
						'Diplomata'=>'Diplomata',
						'Diplomata+SC'=>'Diplomata SC',
						'Dynalight'=>'Dynalight',
						'Eater'=>'Eater',
						'Emblema+One'=>'Emblema One',
						'Expletus+Sans'=>'Expletus Sans',
						'Fascinate'=>'Fascinate',
						'Fascinate+Inline'=>'Fascinate Inline',
						'Federant'=>'Federant',
						'Flamenco'=>'Flamenco',
						'Flavors'=>'Flavors',
						'Fontdiner+Swanky'=>'Fontdiner Swanky',
						'Forum'=>'Forum',
						'Fredericka+the+Great'=>'Fredericka the Great',
						'Frijole'=>'Frijole',
						'Fugaz+One'=>'Fugaz One',
						'Geostar'=>'Geostar',
						'Geostar+Fill'=>'Geostar Fill',
						'Germania+One'=>'Germania One',
						'Goblin+One'=>'Goblin One',
						'Gravitas+One'=>'Gravitas One',
						'Gruppo'=>'Gruppo',
						'Iceberg'=>'Iceberg',
						'Iceland'=>'Iceland',
						'Irish+Grover'=>'Irish Grover',
						'Jim+Nightshade'=>'Jim Nightshade',
						'Kaushan+Script'=>'Kaushan Script',
						'Kelly+Slab'=>'Kelly Slab',
						'Kenia'=>'Kenia',
						'Knewave'=>'Knewave',
						'Kranky'=>'Kranky',
						'Lancelot'=>'Lancelot',
						'Lemon'=>'Lemon',
						'Lilita+One'=>'Lilita One',
						'Limelight'=>'Limelight',
						'Lobster'=>'Lobster',
						'Lobster+Two'=>'Lobster Two',
						'Love+Ya+Like+A+Sister'=>'Love Ya Like A Sister',
						'Luckiest+Guy'=>'Luckiest Guy',
						'Macondo'=>'Macondo',
						'Macondo+Swash+Caps'=>'Macondo Swash Caps',
						'Maiden+Orange'=>'Maiden Orange',
						'Medieval+Sharp'=>'MedievalSharp',
						'Medula+One'=>'Medula One',
						'Megrim'=>'Megrim',
						'Metamorphous'=>'Metamorphous',
						'Miltonian'=>'Miltonian',
						'Miltonian+Tattoo'=>'Miltonian Tattoo',
						'Miniver'=>'Miniver',
						'Modern+Antiqua'=>'Modern Antiqua',
						'Monofett'=>'Monofett',
						'Monoton'=>'Monoton',
						'Mountains+of+Christmas'=>'Mountains of Christmas',
						'Nixie+One'=>'Nixie One',
						'Nosifer'=>'Nosifer',
						'Nova+Cut'=>'Nova Cut',
						'Nova+Flat'=>'Nova Flat',
						'Nova+Mono'=>'Nova Mono',
						'Nova+Oval'=>'Nova Oval',
						'Nova+Round'=>'Nova Round',
						'Nova+Script'=>'Nova Script',
						'Nova+Slim'=>'Nova Slim',
						'Nova+Square'=>'Nova Square',
						'Oldenburg'=>'Oldenburg',
						'Original+Surfer'=>'Original Surfer',
						'Overlock'=>'Overlock',
						'Overlock+SC'=>'Overlock SC',
						'Parisienne'=>'Parisienne',
						'Passero+One'=>'Passero One',
						'Passion+One'=>'Passion One',
						'Piedra'=>'Piedra',
						'Plaster'=>'Plaster',
						'Playball'=>'Playball',
						'Poller+One'=>'Poller One',
						'Pompiere'=>'Pompiere',
						'Port+Lligat+Sans'=>'Port Lligat Sans',
						'Port+Lligat+Slab'=>'Port Lligat Slab',
						'Quantico'=>'Quantico',
						'Raleway'=>'Raleway',
						'Rammetto+One'=>'Rammetto One',
						'Ribeye'=>'Ribeye',
						'Ribeye+Marrow'=>'Ribeye Marrow',
						'Righteous'=>'Righteous',
						'RopaSans'=>'Ropa Sans',
						'Ruslan+Display'=>'Ruslan Display',
						'Sail'=>'Sail',
						'Salsa'=>'Salsa',
						'Sancreek'=>'Sancreek',
						'Sansita+One'=>'Sansita One',
						'Sarina'=>'Sarina',
						'Shojumaru'=>'Shojumaru',
						'Sirin+Stencil'=>'Sirin Stencil',
						'Slackey'=>'Slackey',
						'Smokum'=>'Smokum',
						'Smythe'=>'Smythe',
						'Sniglet'=>'Sniglet',
						'Sonsie+One'=>'Sonsie One',
						'Special+Elite'=>'Special Elite',
						'Spicy+Rice'=>'Spicy Rice',
						'Spirax'=>'Spirax',
						'Squada+One'=>'Squada One',
						'Stardos+Stencil'=>'Stardos Stencil',
						'Stint+Ultra+Condensed'=>'Stint Ultra Condensed',
						'Supermercado+One'=>'Supermercado One',
						'Titan+One'=>'Titan One',
						'Trade+Winds'=>'Trade Winds',
						'Trochut'=>'Trochut',
						'Tulpen+One'=>'Tulpen One',
						'Uncial+Antiqua'=>'Uncial Antiqua',
						'UnifrakturCook'=>'UnifrakturCook',
						'Unifraktur+Maguntia'=>'Unifraktur Maguntia',
						'Unkempt'=>'Unkempt',
						'Unlock'=>'Unlock',
						'VT323'=>'VT323',
						'Vast+Shadow'=>'Vast Shadow',
						'Wallpoet'=>'Wallpoet',
						'Wellfleet'=>'Wellfleet',
						'Yeseva+One'=>'Yeseva One'

										),
					'fontoptions' => array('0' => 'ZENFONTOPTION1','1' => 'ZENFONTOPTION2','2' => 'ZENFONTOPTION3','3' => 'ZENFONTOPTION4'),
					'attselector' => array('color' => 'Color','border-color' => 'Border-color','background-color' => 'Background Color'));
		
			$options = array ();
		
			switch ($display){
				case "fontoptions":
					foreach ($values['fontoptions'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}
					break;
				case "fonts":
					foreach ($values['fonts'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}
					break;
				case "gridcount":
					foreach ($values['gridcount'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}
					break;
				case "attselector":
					foreach ($values['attselector'] as $val => $text)
					{
						$options[] = JHTML::_('select.option', $val, JText::_($text));
					}

					break;
				case "listcss":
				
					// Get the path in which to search for file options.
					$path =  JPATH_ROOT.DS.'templates'.DS.Zengrid::getTemplate().DS.'css'.DS;
					if (!is_dir($path)) {
						$path = JPATH_ROOT.'/'.$path;

					}
					$filter			= (string) $this->element['filter'];
					$exclude		= (string) $this->element['exclude'];
					$stripExt		= (string) $this->element['stripext'];
					$hideNone		= (string) $this->element['hide_none'];
					$hideDefault	= (string) $this->element['hide_default'];

					if (is_dir($path)) $files = JFolder::files($path, $filter); 
					else $files = false;
				
					$options[] = JHTML::_('select.option', '-1', '- '.JText::_('No hilite').' -');
					if ( is_array($files) )
					{
						foreach ($files as $file)
						{
							if ($exclude)
							{
								if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $file ))
								{
									continue;
								}
							}
							if ($stripExt)
							{
								$file = JFile::stripExt( $file );
							}
							$options[] = JHTML::_('select.option', $file, $file);
						}
				
					}
					else 
					{
						return 'This theme does not have any hilites currently. You can add some by putting custom css files inside of /templates/'.Zengrid::getTemplate().'/css folder and adding hilite as a prefix to the file.';
					}
					break;
					case "folderlist":
					
						// path to images directory
						$path		= JPATH_ROOT.DS.str_replace('[template]', Zengrid::getTemplate(), $node->attributes('directory'));
					
						$filter		= (string) $this->element['filter'];
						$exclude	= (string) $this->element['exclude'];
						$folders	= JFolder::folders($path, $filter);

						foreach ($folders as $folder)
						{
							if ($exclude)
							{
								if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $folder )) {
									continue;
								}
							}
							$options[] = JHTML::_('select.option', $folder, $folder);
						}

						if (!$node->attributes('hide_none')) {
							array_unshift($options, JHTML::_('select.option', '-1', '- '.JText::_('Do not use').' -'));
						}

						if (!$node->attributes('hide_default')) {
							array_unshift($options, JHTML::_('select.option', '', '- '.JText::_('Use default').' -'));
						}
						break;
						case "filelist":
						
							// path to images directory
							$path		= JPATH_ROOT.DS.str_replace('[template]', Zengrid::getTemplate(), $node->attributes('directory'));
							$filter		= (string) $this->element['filter'];
							$exclude	= (string) $this->element['exclude'];
							$stripExt	= (string) $this->element['stripext'];
							$files		= JFolder::files($path, $filter);

							if (!$node->attributes('hide_none'))
							{
								$options[] = JHTML::_('select.option', '-1', '- '.JText::_('Do not use').' -');
							}

							if (!$node->attributes('hide_default'))
							{
								$options[] = JHTML::_('select.option', '', '- '.JText::_('Use default').' -');
							}

							if ( is_array($files) )
							{
								foreach ($files as $file)
								{
									if ($exclude)
									{
										if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $file ))
										{
											continue;
										}
									}
									if ($stripExt)
									{
										$file = JFile::stripExt( $file );
									}
									$options[] = JHTML::_('select.option', $file, $file);
								}
							}
							return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name);
							break;
							case "logofile":

								$path		= str_replace('[template]', Zengrid::getTemplate(), JPATH_ROOT.Zengrid::getParam('logoLocation').DS);

								$filter		= '\.png$|\.gif$|\.jpg$|\.bmp$|\.ico$';
								$exclude	= (string) $this->element['exclude'];
								$stripExt	= (string) $this->element['stripext'];
								$files		= JFolder::files($path, $filter);

								if ( is_array($files) )
								{
									foreach ($files as $file)
									{
										if ($exclude)
										{
											if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $file ))
											{
												continue;
											}
										}
										if ($stripExt)
										{
											$file = JFile::stripExt( $file );
										}
										$options[] = JHTML::_('select.option', $file, $file);
									}
								}
								return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name);
								break;
								case "logolocation":

									// path to images directory
									$path		= JPATH_ROOT.DS.'images';
									$filter		= (string) $this->element['filter'];
									$exclude	= (string) $this->element['exclude'];
									$folders	= JFolder::listFolderTree($path, $filter);

									$options = array ();
									$options[] = JHTML::_('select.option', '/templates/'.Zengrid::getTemplate().'/images/logo', '/templates/'.Zengrid::getTemplate().'/images/logo');
									foreach ($folders as $folder)
									{
										if ($exclude)
										{
											if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $folder['relname'] )) {
												continue;
											}
										}
										$relname = str_replace('\\', '/', $folder['relname']);
										$options[] = JHTML::_('select.option', $relname, $relname);
									}

									return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', str_replace('[template]', Zengrid::getTemplate(), $value), $control_name.$name);
									break;
				default:
					return;
					break;
			}
		

				return JHTML::_('select.genericlist',  $options, $this->name, $class, 'value', 'text', $this->value, $this->id);
		}
	}
		function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
		{
			$output = '<label id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'"';
			if ($description) {
				$output .= ' class="hasTip" title="'.JText::_($label).'::'.JText::_(str_replace('[template]', Zengrid::getTemplate(), $description)).'">';
			} else {
				$output .= '>';
			}
			$output .= JText::_( $label ).'</label>';

			return $output;
		
	}
}