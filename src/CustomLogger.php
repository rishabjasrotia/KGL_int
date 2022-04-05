<?php

namespace Drupal\rj_assesment;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

/**
 * Class CustomLogger.
 */
class CustomLogger {
  /**
   * Logger Factory.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(LoggerChannelFactoryInterface $loggerFactory) {
    $this->loggerFactory = $loggerFactory->get('rj_assesment');
  }

  /**
   * Method to log into DB
   */
  public function addLog($value) {
    $this->loggerFactory->info('@value', [
      '@value' => $value,
    ]);
  }
}
