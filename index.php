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

         // Replace CLAUSE tags
        foreach ($this->clauses as $clause) {
            $tag = '[CLAUSE-' . $clause['id'] . ']'; 
            $text = str_replace($tag, $clause['text'], $text); 
        }

        // Replace SECTION tags
        $sectiontext = "";
        foreach ($this->sections as $section) {
           foreach ($section['clauses_ids'] as $caluseids){
                foreach ($this->clauses as $clause) {
                    // Check IDs matched to the dataset
                    if ($clause['id'] == $caluseids) {
                       $sectiontext .= $clause['text'] ." ";
                    }
                    
                }
           }
            $tag = '[SECTION-' . $section['id'] . ']';
            $text = str_replace($tag, $sectiontext, $text);
        }

        return $text;
    }

  }
  
$template = "A T&C Document\n\nThis document is made of plaintext.\n\nIs made of [CLAUSE-3].\n\nIs made of [CLAUSE-4].\n\nIs made of [SECTION-1].\n\nYour legals.";


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

