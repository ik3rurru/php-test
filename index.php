<?php 

class TermsAndConditions {
   private $template;
   private $clauses;
   private $sections;
  
    function __construct($template, $dataset) {
        $this->template = $template;         
        $this->clauses = $dataset['clauses']; 
        $this->sections = $dataset['sections']; 
    }

    function generate() {
        $text = $this->template; 

        
        foreach ($this->clauses as $clause) {
            $tag = '[CLAUSE-' . $clause['id'] . ']'; 
            $text = str_replace($tag, $clause['text'], $text); 
        }

      
        foreach ($this->sections as $section) {
           foreach ($section['clauses_ids'] as $caluseids){
            
                foreach ($this->clauses as $clause) {

                    if ($clause['id'] == $caluseids) {
                      
                       
                       $sectiontext .= $clause['text'];
                       
                    }
                
                }
           }
            $tag = '[SECTION-' . $section['id'] . ']';
            $text = str_replace($tag, $sectiontext, $text);
        }

        return $text;
    }


  }
  

$template = "A T&C Document\n\n
			This document is made of plaintext.\n\n
			Is made of [CLAUSE-3].\n\n
			Is made of [CLAUSE-4].\n\n
			Is made of [SECTION-1].\n\n
			Your legals.";


$dataset = [
    'clauses' => [
        ['id' => 1, 'text' => 'The quick brown fox'],
        ['id' => 2, 'text' => 'jumps over the lazy dog'],
        ['id' => 3, 'text' => 'And dies'],
        ['id' => 4, 'text' => 'The white horse is white']
    ],
    'sections' => [
        ['id' => 1, 'clauses_ids' => [1, 2]] 
    ]
];


$document = new TermsAndConditions($template, $dataset);

echo $document->generate();

