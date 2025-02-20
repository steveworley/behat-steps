<?php

namespace IntegratedExperts\BehatSteps\D7;

/**
 * Trait MediaTrait.
 */
trait MediaTrait {

  /**
   * Attaches file to media field with specified id|name|label|value.
   *
   * @code
   * Example: When I attach "bwayne_profile.png" to "Featured image" media field
   * @endcode
   *
   * @When /^(?:|I )attach the file "(?P<path>[^"]*)" to "(?P<field>(?:[^"]|\\")*)" media field$/
   */
  public function mediaAttachFileToField($field, $path) {
    $original_path = $path;
    // Get fixture file path.
    if ($this->getMinkParameter('files_path')) {
      $full_path = rtrim(realpath($this->getMinkParameter('files_path')), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $path;
      if (is_file($full_path)) {
        $path = $full_path;
      }
    }

    global $user;
    $user = $this->getUserManager()->getCurrentUser();
    $data = file_get_contents($path);
    $file = file_save_data($data, 'public://' . $original_path, FILE_EXISTS_REPLACE);

    if (!$file) {
      throw new \RuntimeException(sprintf('Unable to save file "%s"', $path));
    }

    $this->getSession()->getPage()->find('css', 'input[name="' . $field . '"]')->setValue($file->fid);
  }

}
