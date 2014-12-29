<?php

class ACNewspeak {
   
   var $verbs;
   var $prepositions;
   var $subjects;
   var $adverbs;
   var $nominal_groups;

	function __construct($path = 'fragments/') {
      
		$this->verbs = file($path.'verbs.txt');
      $this->prepositions = file($path.'prepositions.txt');
      $this->subjects = file($path.'subjects.txt');
      $this->adverbs = file($path.'adverbs.txt');
      $this->nominal_groups = file($path.'nominal_groups.txt');
      
	}

	public function generate_newspeak($sentence=1) {
      
      shuffle( $this->prepositions );
      shuffle( $this->nominal_groups );
      shuffle( $this->subjects );
      shuffle( $this->verbs );
      shuffle( $this->adverbs );

      $newspeak = '';

      for($i=0; $i < $sentence; $i++) {
         $newspeak .= ' '.$this->generate_newspeak_sentence($i);
      }

      return '“'.trim($newspeak).'”';

	}
   
   public function generate_newspeak_sentence($i=0) {
      
      $dependent_clause = $this->prepositions[$i].' '.$this->nominal_groups[$i];
   
      $hide_adverb = rand(0,3);
      if( mb_substr($this->verbs[$i], -1, 1, "UTF-8") == 'à' || mb_substr($this->verbs[$i], -2, 2, "UTF-8") == 'de' ) {
         $hide_adverb = true;
      }
      $adverb = '';
      if( !$hide_adverb ) {
         $adverb = ' '.$this->adverbs[$i];
      }

      $independent_clause = $this->subjects[$i].' '.$this->verbs[$i].$adverb.' '.$this->nominal_groups[($i+1)*2];

      $newspeak_form = rand(0,1);
      if( $newspeak_form )
         $newspeak = $dependent_clause.', '.$independent_clause;
      else
         $newspeak = $independent_clause.', '.$dependent_clause;

      $newspeak = str_replace(' de les', ' des', $newspeak);
      $newspeak = str_replace(' de des', ' des', $newspeak);
      $newspeak = str_replace(' de le', ' du', $newspeak);
      $newspeak = str_replace(' de un', ' d’un', $newspeak);
      $newspeak = str_replace(' à les', ' aux', $newspeak);
      $newspeak = str_replace(' à le', ' au', $newspeak);
      $newspeak = str_replace('oe', '&oelig;', $newspeak);
      
      //TODO fix: non breaking spaces after prepositions
      $newspeak = preg_replace('%( |&nbsp;)(à|le|les|la|au|de|du|des|et|sup>|un|une|par|ce|ces|cette|en>) %i', '$1$2&nbsp;', $newspeak);
      $newspeak = preg_replace('%( |&nbsp;)(à|le|les|la|au|de|du|des|et|sup>|un|une|par|ce|ces|cette|en>) %i', '$1$2&nbsp;', $newspeak); 

      $newspeak = mb_ucfirst($newspeak).'.';

      return $newspeak;
   
   }

}


if (!function_exists('mb_ucfirst') && function_exists('mb_substr')) {
   
   function mb_ucfirst($string) {
      $string = mb_strtoupper( mb_substr($string, 0, 1, "UTF-8"), "UTF-8" ) . mb_substr($string, 1, strlen($string), "UTF-8");
      return $string;
   }
   
}

?>