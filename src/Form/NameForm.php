<?php

namespace Drupal\rj_assesment\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\Messenger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\rj_assesment\CustomLogger;

/**
 * Class NameForm.
 * @author Rishab
 */
class NameForm extends FormBase {

  /**
   * Messenger.
   *
   * @var \Drupal\Core\Messenger\Messenger
   */
  protected $messenger;

  /**
   * CustomLogger.
   *
   * @var \Drupal\rj_assesment\CustomLogger
   */
  protected $logger;

  /**
   * {@inheritdoc}
   */
  public function __construct(Messenger $messenger, CustomLogger $logger) {
    $this->messenger = $messenger;
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('messenger'),
      $container->get('rj_assesment.custom_logger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return "rj_assesment_name_form";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user_input = 'The value submitted in assesment is: ' . $form_state ->getValue('name');
    $this->messenger->addMessage($user_input);
    $this->logger->addLog($user_input);
  }

}
