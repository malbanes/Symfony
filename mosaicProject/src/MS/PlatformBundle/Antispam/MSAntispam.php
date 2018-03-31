<?php
// src/MS/PlatformBundle/Antispam/MSAntispam.php

namespace MS\PlatformBundle\Antispam;

class MSAntispam
{
  /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  private $mailer;
  private $locale;
  private $minLength;

  public function _construct(\Swift_Mailer $mailer, $locale, $minLength)
  {
	$this->mailer = $mailer;
	$this->locale = $locale;
	$this->minlength = (int) $minlength;
  }

  public function isSpam($text)
  {
    return strlen($text) < $this->minlegth;
  }
}
