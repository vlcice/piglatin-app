<?php

require_once __DIR__.'/vendor/autoload.php';

use Vlcice\PigLatin\Translator\Translator;

const TEMPLATE_PATH = 'templates';

try {
  $loader = new Twig_Loader_Filesystem(TEMPLATE_PATH);
  $twig = new Twig_Environment($loader);
  $template = $twig->loadTemplate('index.twig');
} catch (Exception $e) {
  die ('Twig loader error:'.$e->getMessage());
}

$translator = new Translator();
$translator->translate((string) $_POST['input']);

echo $template->render( [
  'errorMessage' => $translator->getErrorMessage(),
  'translation' => $translator->getTranslation(),
  'input' => $translator->getInput(),
] );


?>
