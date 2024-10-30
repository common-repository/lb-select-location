<?php

/**
 * This class allow to populate the select tag with values set 
 * @author Luca Bonaldo <info@lucabonaldo.it>
 * @package LB-Select-Location
 */
class Select_Load {

  /**
   * 
   * @var int|string 
   */
  var $form_id;

  /**
   *
   * @var int|string 
   */
  var $regione_id;

  /**
   *
   * @var int|string 
   */
  var $provincia_id;

  /**
   *
   * @var int|string 
   */
  var $comune_id;

  /**
   * This function construct initialize of class members 
   */
  public function __construct() {
    $this->form_id = $this->regione_id = $this->provincia_id = $this->comune_id = '';
  }

  /**
   * This function to set value of class members and activate the wordpress action wp_footer 
   * <code>
   * Example:
   * <?php
   * // the value of these variables to be can picked up whatever source
   * $form_id = "myform";
   * $regione_id = "myregione";
   * $provincia_id = "myprovincia";
   * $comune_id = "mycomune";
   * $opt = new Select_Load();
   * $opt->populate($form_id, $regione_id, $provincia_id, $comune_id);
   * ?>
   * </code>
   * @param int|string $form_id
   * @param int|string $regione_id
   * @param int|string $provincia_id
   * @param int|string $comune_id
   */
  public function populate($form_id, $regione_id, $provincia_id, $comune_id) {

    $this->form_id = $form_id;
    $this->regione_id = $regione_id;
    $this->provincia_id = $provincia_id;
    $this->comune_id = $comune_id;

    add_action('wp_footer', array(&$this, 'script'));
    add_action('admin_footer_text', array(&$this, 'script'));
  }

  /**
   * This function to print the script js that allow to set value in select tag 
   */
  public function script() {
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
    //        console.log('<?php echo $this->form_id ?>');
    //        console.log('<?php echo $this->regione_id ?>');
    //        console.log('<?php echo $this->provincia_id ?>');
    //        console.log('<?php echo $this->comune_id ?>');
        sl_init_with_values('<?php echo $this->form_id ?>', '<?php echo $this->regione_id ?>', '<?php echo $this->provincia_id ?>', '<?php echo $this->comune_id ?>');
      });
    </script>
    <?php
  }

}
?>