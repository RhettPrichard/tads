<?php
  /**
    *
    * @file
    * Contains \Drupal\tads_question\QuestionController.
    */
    
    namespace Drupal\tads_question;
    
    use Drupal\Core\Controller\ControllerBase;
    
    class QuestionController extends ControllerBase {
      public function content() {
        return array(
          '#type' => 'markup',
          '#markup' => $this->t('Hello, World!'),
        );
      }
    }