<?php
/**
 * Provides a 'Hello' Block
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 * )
 */

namespace Drupal\tads_question\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Block\BlockPluginInterface;

class HelloBlock extends BlockBase implements BlockPluginInterface {
  /**
   * {@inheritdoc}
   */
  public function build() {
    
    $config = $this->getConfiguration();
    
    if (!empty($config['name']))
    {
      $name = $config['name'];
    }
    else
    {
      $name = $this->t('to no one');
    }
    
    return array(
      '#markup' => $this->t('Hello @name!', array(
          '@name' => $name,
        )
      ),
    );
  }
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    
    $config = $this->getConfiguration();
    
    $form['hello_block_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => isset($config['name']) ? $config['name'] : ''
      );
      
    return $form;
  }
  public function blockSubmit($form, FormStateInterface $form_state)
  {
    $this->setConfigurationValue('name', $form_state->getValue('hello_block_name'));
  }
  
  public function defaultConfiguration()
  {
    $default_config = \Drupal::config('tads_question.settings');
    return array('name' => $default_config->get('tads_question.name'));
    
  }
}
