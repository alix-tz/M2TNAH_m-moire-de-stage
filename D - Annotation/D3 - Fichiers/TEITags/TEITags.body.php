<?php

/**
 * Copyright (C) 2013 Richard Davis
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License Version 2, as
* published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
*
* @package MediaWiki
* @subpackage Extensions
* @author Richard Davis <r.davis@ulcc.ac.uk>
* @author Ben Parish <b.parish@ulcc.ac.uk>
* @copyright 2013 Richard Davis
*/

# Alert the user that this is not a valid entry point to MediaWiki if they try to access the special pages file directly.
if ( !defined( 'MEDIAWIKI' ) ) {
	echo <<<EOT
To install my extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/TEITags/TEITags.php" );
EOT;
	exit( 1 );
}

class TEITagsHooks {

	public function ParserFirstCallInit ( Parser $parser ){
		global $wgOut;

		$parser->setHook( 'tei'    , array( $this , 'RenderTei' ) );
		$parser->setHook( 'lb'     , array( $this , 'RenderLb' ));
		$parser->setHook( 'pb'     , array( $this , 'RenderPb' ));
		$parser->setHook( 'del'    , array( $this , 'RenderDel' ));
		$parser->setHook( 'add'    , array( $this , 'RenderAdd' ));
		$parser->setHook( 'gap'    , array( $this , 'RenderGap' ));
		$parser->setHook( 'unclear', array( $this , 'RenderUnclear' ));
		$parser->setHook( 'note'   , array( $this , 'RenderNote' ));
		$parser->setHook( 'hi'     , array( $this , 'RenderHi' ));
		$parser->setHook( 'head'   , array( $this , 'RenderHead' ));
		$parser->setHook( 'sic'    , array( $this , 'RenderSic' ));
		$parser->setHook( 'foreign', array( $this , 'RenderForeign' ));
		
		//Ajouts de balises TEI
		$parser->setHook( 'persName', array( $this , 'RenderPersName' ));
		$parser->setHook( 'placeName',array( $this , 'RenderPlaceName' ));	
		$parser->setHook( 'term' , array( $this , 'RenderTerm' ));
		$parser->setHook( 'roleName' , array( $this , 'RenderRoleName' ));
		$parser->setHook( 'surname' , array( $this , 'RenderSurname' ));
		$parser->setHook( 'measure' , array( $this , 'RenderMeasure' ));
		$parser->setHook( 'num' , array( $this , 'RenderNum' ));
		$parser->setHook( 'rs' , array( $this , 'RenderRs' ));
		$parser->setHook( 'forename' , array( $this , 'RenderForename' ));	
		$parser->setHook( 'date' , array( $this , 'RenderDate' ));

		//Ajouts de balises non-TEI pour le guide d'annotation : "TU_"
		$parser->setHook( 'TU_adresse' , array( $this , 'RenderTU_Adresse' ));
		$parser->setHook( 'TU_date' , array( $this , 'RenderTU_Date' ));
		$parser->setHook( 'TU_document' , array( $this , 'RenderTU_Document' ));
		$parser->setHook( 'TU_duree' , array( $this , 'RenderTU_Duree' ));
		$parser->setHook( 'TU_heure' , array( $this , 'RenderTU_Heure' ));
		$parser->setHook( 'TU_incertitude' , array( $this , 'RenderTU_Incertitude' ));
		$parser->setHook( 'TU_montant' , array( $this , 'RenderTU_Montant' ));
		$parser->setHook( 'TU_occupation' , array( $this , 'RenderTU_Occupation' ));
		$parser->setHook( 'TU_organization' , array( $this , 'RenderTU_Organization' ));
		$parser->setHook( 'TU_personne' , array( $this , 'RenderTU_Personne' ));
		$parser->setHook( 'TU_place' , array( $this , 'RenderTU_Place' ));
		$parser->setHook( 'TU_produit' , array( $this , 'RenderTU_Produit' ));
		$parser->setHook( 'TU_remuneration' , array( $this , 'RenderTU_Remuneration' ));
		$parser->setHook( 'TU_statutMatrimonial' , array( $this , 'RenderTU_StatutMatrimonial' ));
		$parser->setHook( 'TU_tache' , array( $this , 'RenderTU_Tache' ));
		$parser->setHook( 'TU_typeRemuneration' , array( $this , 'RenderTU_TypeRemuneration' ));
		$parser->setHook( 'TU_statut' , array( $this , 'RenderTU_statut' ));
		$parser->setHook( 'TU_quantite' , array( $this , 'RenderTU_quantite' ));

		$wgOut->addModules( 'ext.TEITags' );

		return true;

	}

	public function RenderTU_quantite(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_quantite', $HookArgs );
	}

	public function RenderTU_statut(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_statut', $HookArgs );
	}

	public function RenderTU_TypeRemuneration(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_typeRemuneration', $HookArgs );
	}

	public function RenderTU_Tache(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_tache', $HookArgs );
	}

	public function RenderTU_StatutMatrimonial(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_statutMatrimonial', $HookArgs );
	}

	public function RenderTU_Remuneration(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_remuneration', $HookArgs );
	}

	public function RenderTU_Produit(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_produit', $HookArgs );
	}

	public function RenderTU_Place(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_place', $HookArgs );
	}

	public function RenderTU_Personne(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_personne', $HookArgs );
	}

	public function RenderTU_Organization(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_organization', $HookArgs );
	}

	public function RenderTU_Occupation(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_occupation', $HookArgs );
	}

	public function RenderTU_Montant(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_montant', $HookArgs );
	}

	public function RenderTU_Incertitude(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_incertitude', $HookArgs );
	}

	public function RenderTU_Heure(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_heure', $HookArgs );
	}

	public function RenderTU_Duree(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_duree', $HookArgs );
	}

	public function RenderTU_Document(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_document', $HookArgs );
	}

	public function RenderTU_Date(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_date', $HookArgs );
	}

	public function RenderTU_Adresse(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'TU_adresse', $HookArgs );
	}


	public function RenderDate(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'date', $HookArgs );
	}

	public function RenderRoleName(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'roleName', $HookArgs );	
	}

	public function RenderForename(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'forename', $HookArgs );	
	
	}
	public function RenderNum(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'num', $HookArgs );	
	}

	public function RenderRs(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'rs', $HookArgs );	
	}

	public function RenderMeasure(){
		$HookArgs = func_get_args();	
		return $this->TEITagsRenderer( 'measure', $HookArgs );	
	}

	public function RenderSurname(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'surname', $HookArgs );	
	}

	public function RenderPlaceName(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'placeName', $HookArgs );	
	}

	public function RenderTerm(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'term', $HookArgs );	
	}	
	
	public function RenderPersName(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'persName', $HookArgs );	
	}


	public function RenderTei(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'tei', $HookArgs );
	}

	public function RenderLb(){
		return '<br/>';
	}

	public function RenderPb(){
		return '<br/>---<em>page break</em>---<br/>';
	}

	public function RenderDel(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'del', $HookArgs );
	}

	public function RenderAdd(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'add', $HookArgs );
	}

	public function RenderGap(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'gap', $HookArgs );
	}

	public function RenderUnclear(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'unclear', $HookArgs );
	}

	public function RenderNote(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'note', $HookArgs );
	}

	public function RenderHi(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'hi', $HookArgs );
	}

	public function RenderHead(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'head', $HookArgs );
	}

	public function RenderSic(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'sic', $HookArgs );
	}

	public function RenderForeign(){
		$HookArgs = func_get_args();
		return $this->TEITagsRenderer( 'foreign', $HookArgs );
	}

	private function TEITagsRenderer ( $tag, $HookArgs ){

		$input  = $HookArgs[0];
		$args   = $HookArgs[1];
		$parser = $HookArgs[2];
		$frame  = $HookArgs[3];

		$output = '';

		if( $tag != 'gap' ){
			$output = $parser->recursiveTagParse( $input, $frame );
#			$output = htmlspecialchars( $output );
		}

		if( $tag == 'hi' ){
			$render = $args['rend'];
			$tag 	.= ' ' . $render;
		}

		return '<span class="tei-' . $tag . '" title="' . $tag .'">' . $output . '</span>';
	}

}
